<?php

namespace App\API\DataForSeoBundle\Client;

use App\API\DataForSeoBundle\Client\DataForSeoClient;
use App\Core\SeoApiBundle\SeoApi\SeoApiProcessorInterface;

/**
 * Class DataForSeoApiProcessor
 * @package App\API\DataForSeoBundle\SeoBundle\DataForSeo\Client
 */
class DataForSeoApiProcessor implements SeoApiProcessorInterface
{
    const API_NAME = 'data-for-seo';
    const RANK_TASK_POST_URL = '/v2/rnk_tasks_post';
    const RANK_TASK_GET_URL = 'v2/rnk_tasks_get';

    /**
     * @var DataForSeoClient $dataForSeoClient
     */
    private $dataForSeoClient;

    /**
     * @return string
     */
    public static function getSeoApiName()
    {
        return self::API_NAME;
    }

    /**
     * DataForSeoApiProcessor constructor.
     * @param DataForSeoClient $dataForSeoClient
     */
    public function __construct(DataForSeoClient $dataForSeoClient)
    {
        $this->dataForSeoClient = $dataForSeoClient;
    }

    /**
     * @param $newTaskInfo
     * @return mixed|void
     */
    public function createRankTask($newTaskInfo)
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
    public function getRankTaskData($taskId)
    {
        dd($taskId);
        $this->dataForSeoClient->get(self::RANK_TASK_GET_URL);
    }

}
