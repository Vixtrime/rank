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
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DataForSeoRankApiProcessor constructor.
     * @param DataForSeoClient $dataForSeoClient
     * @param DataForSeoRankFormType $formType
     * @param FormService $formService
     * @param DataForSeoLocationService $locationService
     * @param DataForSeoSearchEngineService $dataForSeoSearchEngineService
     * @param DataForSeoRankTaskRepository $dataForSeoRankTaskRepository
     * @param DataForSeoKeyRepository $dataForSeoKeyRepository
     * @param LoggerInterface $logger
     */
    public function __construct
    (
        DataForSeoClient $dataForSeoClient,
        DataForSeoRankFormType $formType,
        FormService $formService,
        DataForSeoLocationService $locationService,
        DataForSeoSearchEngineService $dataForSeoSearchEngineService,
        DataForSeoRankTaskRepository $dataForSeoRankTaskRepository,
        DataForSeoKeyRepository $dataForSeoKeyRepository,
        LoggerInterface $logger
    )
    {
        $this->dataForSeoClient = $dataForSeoClient;
        $this->dataForSeoRankForm = $formType;
        $this->formService = $formService;
        $this->locationService = $locationService;
        $this->dataForSeoSearchEngineService = $dataForSeoSearchEngineService;
        $this->rankTaskRepository = $dataForSeoRankTaskRepository;
        $this->dataForSeoKeyRepository = $dataForSeoKeyRepository;
        $this->logger = $logger;
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
                    [$token =>
                        [
                            "priority" => $rankTask->getPriority(),
                            "site" => $rankTask->getSite(),
                            "se_id" => $rankTask->getSe()->getSeId(),
                            "loc_id" => $rankTask->getLoc()->getLocId(),
                            "key" => $form->getNormData()['key'],
                        ]
                    ]
                ]);

                if ($postResult['status'] == "ok") {

                    $resultData = $postResult['results'][$token];

                    $keyword = $this->dataForSeoKeyRepository->createKey($resultData['key_id'], $resultData['post_key']);
                    $this->dataForSeoKeyRepository->saveKey($keyword);

                    $rankTask->setApiId($resultData['task_id']);
                    $rankTask->setKey($keyword)->setStatus(0);
                    $this->rankTaskRepository->save($rankTask);

                } else {
                    $this->logger->error('API error.' . $postResult['results'][$token]['error']['message'] . '; Key: ' . $form->getNormData()['key']);
                    throw new \InvalidArgumentException('API error.' . $postResult['results'][$token]['error']['message']);
                }
            }
        } else {
            //TODO Handle form errors no front-end part
//            dd($this->formService->getFormErrors($form));
            throw new \InvalidArgumentException('Incorrect form data.');
        }
    }

    /**
     * @param $taskId
     * @return mixed|void
     */
    public function getTaskData($taskId)
    {
        return $this->dataForSeoClient->get(self::RANK_TASK_GET_URL . '/' . $taskId);
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
                    ->setStatus(1);

                $this->rankTaskRepository->save($task);

            } else {
                throw new \Exception('No results for current task, please try again later');
            }
        } else {
            throw new \Exception('No task found by this identifier');
        }
    }
}
