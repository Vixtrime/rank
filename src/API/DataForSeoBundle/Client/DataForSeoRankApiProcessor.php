<?php

namespace App\API\DataForSeoBundle\Client;

use App\API\DataForSeoBundle\Client\DataForSeoClient;
use App\API\DataForSeoBundle\Form\DataForSeoRankFormType;
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
     * DataForSeoRankApiProcessor constructor.
     * @param DataForSeoClient $dataForSeoClient
     * @param DataForSeoRankFormType $formType
     * @param FormService $formService
     */
    public function __construct
    (
        DataForSeoClient $dataForSeoClient,
        DataForSeoRankFormType $formType,
        FormService $formService
    )
    {
        $this->dataForSeoClient = $dataForSeoClient;
        $this->dataForSeoRankForm = $formType;
        $this->formService = $formService;
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
//        dd('hellosdf');

//        $taskId = uniqid();
//        $priority = 1;
//        $site =
//        dd($taskId);

//        $post_  array[$my_unq_id] = array(
//            "priority" => 1,
//            "site" => "dataforseo.com",
//            "se_id" => 22,
//            "loc_id" => 1006886,
//            "key" => mb_convert_encoding("sadfsdf", "UTF-8")
//            //,"postback_url" => "http://your-domain.com/postback_url_example.php" //see postback_url_example.php script
//        );
        $this->dataForSeoClient->post(self::RANK_TASK_POST_URL);
    }

    /**
     * @param $taskId
     * @return mixed|void
     */
    public function getTaskData($taskId)
    {
        dd($taskId);
        $this->dataForSeoClient->get(self::RANK_TASK_GET_URL);
    }


    public function getTaskForm()
    {
        $taskForm = $this->formService->createForm(DataForSeoRankFormType::class);
        return $this->formService->getFormFields($taskForm);
    }


}
