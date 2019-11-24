<?php

namespace App\API\DataForSeoBundle\Client;

use App\API\DataForSeoBundle\Client\DataForSeoClient;
use App\API\DataForSeoBundle\Form\DataForSeoRankFormType;
use App\API\DataForSeoBundle\Repository\DataForSeoKeyRepository;
use App\API\DataForSeoBundle\Repository\DataForSeoRankTaskRepository;
use App\API\DataForSeoBundle\Services\DataForSeoLocationService;
use App\API\DataForSeoBundle\Services\DataForSeoSearchEngineService;
use App\Core\BaseBundle\Helpers\FormService;
use App\Core\SeoApiBundle\SeoApi\SeoApiProcessorInterface;

/**
 * Class DataForSeoRankApiProcessor
 * @package App\API\DataForSeoBundle\SeoBundle\DataForSeo\Client
 */
class DataForSeoRankApiProcessor implements SeoApiProcessorInterface
{
    const API_PROCESSOR_NAME = 'rank';
    const RANK_TASK_POST_URL = '/v2/rnk_tasks_post';
    const RANK_TASK_GET_URL = 'v2/rnk_tasks_get';

    /**
     * @var DataForSeoClient $dataForSeoClient
     */
    private $dataForSeoClient;

    /**
     * @var DataForSeoRankFormType
     */
    private $dataForSeoRankForm;

    /**
     * @var FormService
     */
    private $formService;

    /**
     * @var
     */
    private $locationService;

    /**
     * @var DataForSeoSearchEngineService
     */
    private $dataForSeoSearchEngineService;

    /**
     * @var DataForSeoRankTaskRepository
     */
    private $rankTaskRepository;

    /**
     * @var DataForSeoKeyRepository
     */
    private $dataForSeoKeyRepository;

    /**
     * DataForSeoRankApiProcessor constructor.
     * @param DataForSeoClient $dataForSeoClient
     * @param DataForSeoRankFormType $formType
     * @param FormService $formService
     * @param DataForSeoLocationService $locationService
     * @param DataForSeoSearchEngineService $dataForSeoSearchEngineService
     * @param DataForSeoRankTaskRepository $dataForSeoRankTaskRepository
     * @param DataForSeoKeyRepository $dataForSeoKeyRepository
     */
    public function __construct
    (
        DataForSeoClient $dataForSeoClient,
        DataForSeoRankFormType $formType,
        FormService $formService,
        DataForSeoLocationService $locationService,
        DataForSeoSearchEngineService $dataForSeoSearchEngineService,
        DataForSeoRankTaskRepository $dataForSeoRankTaskRepository,
        DataForSeoKeyRepository $dataForSeoKeyRepository
    )
    {
        $this->dataForSeoClient = $dataForSeoClient;
        $this->dataForSeoRankForm = $formType;
        $this->formService = $formService;
        $this->locationService = $locationService;
        $this->dataForSeoSearchEngineService = $dataForSeoSearchEngineService;
        $this->rankTaskRepository = $dataForSeoRankTaskRepository;
        $this->dataForSeoKeyRepository = $dataForSeoKeyRepository;
    }

    /**
     * @return string
     */
    public static function getApiProcessorName(): string
    {
        return self::API_PROCESSOR_NAME;
    }

    /**
     * @param $newTaskInfo
     * @return mixed|void
     */
    public function createTask($newTaskInfo)
    {
        $form = $this->formService->createForm(DataForSeoRankFormType::class);
        $form->submit($newTaskInfo);
        $form->isValid();

        if ($form->isValid()) {

            $se = $this->dataForSeoSearchEngineService->getSearchEngineById($form->getNormData()['se']);

            $loc = $this->locationService->getLocationById($form->getNormData()['loc']);

            if ($se != null && $loc != null) {

                $token = mt_rand(0, 30000000);
                $priority = 1;

                $rankTask = $this->rankTaskRepository->createRankTask($token, $priority, $form->getNormData()['site'], $se, $loc);

                $postResult = $this->dataForSeoClient->post('/v2/rnk_tasks_post', ['data' =>
                    ['t1o2k3e3n5' =>
                        [
                            "priority" => $rankTask->getPriority(),
                            "site" => $rankTask->getSite(),
                            "se_id" => $rankTask->getSe()->getSeId(),
                            "loc_id" => $rankTask->getLoc()->getLocId(),
                            "key" => $form->getNormData()['key']
                        ]
                    ]
                ]);

                if ($postResult['status'] == "ok") {

                    $rankTask->setApiId($postResult['results']['t1o2k3e3n5']['task_id']);

                    $keyword = $this->dataForSeoKeyRepository
                        ->createKey($postResult['results']['t1o2k3e3n5']['key_id'],
                            $postResult['results']['t1o2k3e3n5']['post_key']);
                    $this->dataForSeoKeyRepository->saveKey($keyword);

                    $rankTask->setKey($keyword)->setStatus(0);
                    $this->rankTaskRepository->save($rankTask);

                } else {

                }
            }
        } else {
            throw new \InvalidArgumentException('Incorrect form data.');
        }
    }

    /**
     * @param $taskId
     * @return mixed|void
     */
    public function getTaskData($taskId)
    {
        dd($this->dataForSeoClient->get(self::RANK_TASK_GET_URL . '/' . $taskId));
    }


    public function getTaskForm()
    {
        $taskForm = $this->formService->createForm(DataForSeoRankFormType::class);

        $form['formSchema'] = $this->formService->getFormFields($taskForm);
        $form['formData']['loc'] = $this->locationService->getLocationsData();
        $form['formData']['se'] = $this->dataForSeoSearchEngineService->getSearchEnginesInFormFormat();
        return $form;
    }

    public function getTasks()
    {
        return $this->rankTaskRepository->getTasks();
    }

    /**
     * @param $taskId
     * @return mixed|void
     */
    public function syncTask($taskId)
    {
        $task = $this->rankTaskRepository->findOneBy(['id' => $taskId]);

        if ($task) {
            $taskDataFromApi = $this->dataForSeoClient->get(self::RANK_TASK_GET_URL . '/' . $task->getApiId());

            if ($taskDataFromApi['status'] == 'ok' && $taskDataFromApi['results_count'] > 0) {
                $taskData = $taskDataFromApi['results']['organic'][0];

                $task->setResultPosition($taskData['result_position'])
                    ->setResultUrl($taskData['result_url'])
                    ->setResultPosition($taskData['result_position'])
                    ->setResultTitle($taskData['result_title'])
                    ->setResultSnippet($taskData['result_snippet'])
                    ->setResultsCount($taskData['results_count'])
                    ->setResultSeCheckUrl($taskData['result_se_check_url'])
                    ->setResultExtra($taskData['result_extra'])
                    ->setStatus(1)
                    ->setResultDatetime($taskData['result_datetime']);

                $this->rankTaskRepository->save($task);

            }
        }
    }

    public function updateTask($taskId)
    {

    }


}
