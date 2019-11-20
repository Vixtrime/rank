<?php


namespace App\Core\SeoApiBundle\SeoApi;


interface SeoApiProcessorInterface
{
    /**
     * @param $newTaskInfo
     * @return mixed
     */
    public function createRankTask($newTaskInfo);

    /**
     * @param $taskId int|string
     * @return mixed
     */
    public function getRankTaskData($taskId);
}