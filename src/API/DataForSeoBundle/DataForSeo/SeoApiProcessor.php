<?php


namespace App\API\DataForSeoBundle\DataForSeo;


class SeoApiProcessor
{
//
////    private $restClient;
////
////
////    public function __construct(RestClient $restClient)
////    {
////        $this->restClient = $restClient;
////    }
//
//
//    public function testFunc()
//    {
//        try {
////            $client = new DataForSeoClient('https://api.dataforseo.com/', null, 'challenger22@rankactive.info', 'v0B4XUN4f');
//        } catch (RestClientException $e) {
//            echo "\n";
//            print "HTTP code: {$e->getHttpCode()}\n";
//            print "Error code: {$e->getCode()}\n";
//            print "Message: {$e->getMessage()}\n";
//            print  $e->getTraceAsString();
//            echo "\n";
//            exit();
//        }
//
////        $post_array = array();
////        $my_unq_id = mt_rand(0, 30000000);
//
////        $post_array[$my_unq_id] = array(
////            "priority" => 1,
////            "site" => "dataforseo.com",
////            "url" => "https://www.google.co.uk/search?q=seo%20data%20api&hl=en&gl=GB&uule=w+CAIQIFISCXXeIa8LoNhHEZkq1d1aOpZS"
////        );
////
////        $post_array[$my_unq_id] = array(
////            "priority" => 1,
////            "site" => "dataforseo.com",
////            "se_id" => 22,
////            "loc_id" => 1006886,
////            "key" => mb_convert_encoding("sadfsdf", "UTF-8")
////            //,"postback_url" => "http://your-domain.com/postback_url_example.php" //see postback_url_example.php script
////        );
//
////        if (count($post_array) > 0) {
//        try {
//            // POST /v2/rnk_tasks_post/$tasks_data
//            // $tasks_data must by array with key 'data'
////                $task_post_result = $client->post('/v2/rnk_tasks_post', array('data' => $post_array));
////            $task_post_result = $client->get('/v2/rnk_tasks_get/12647428611');
////                $loc_get_result = $client->get('v2/cmn_locations');
////                $response = json_decode($loc_get_result, true);
////                foreach ($response['results'] as &$result) {
////                    if ($result['loc_type'] != 'region' && ($result['loc_type'] != 'US' || $result['loc_type'] != 'USA')) {
////                        unset($result);
////                    }
////                }
////                var_dump($response); die;
////            dd($task_post_result);
//            //do something with post results
//
//            $post_array = array();
//        } catch (RestClientException $e) {
//            echo "\n";
//            print "HTTP code: {$e->getHttpCode()}\n";
//            print "Error code: {$e->getCode()}\n";
//            print "Message: {$e->getMessage()}\n";
//            print  $e->getTraceAsString();
//            echo "\n";
//        }
//    }
//    }
}