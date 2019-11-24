<?php

namespace App\Core\SeoApiBundle\SeoApi;

/**
 * Interface SeoApiProcessorInterface
 * @package App\Core\SeoApiBundle\SeoApi
 */
interface SeoApiProcessorInterface
{
    /**
     * @return string
     */
    public static function getApiProcessorName(): string;

    /**
     * @param $newTaskInfo
     * @return mixed
     */
    public function createTask($newTaskInfo);

    /**
     * @param $taskId
     * @return mixed
     */
    public function updateTask($taskId);

    /**
     * @param $taskId
     * @return mixed
     */
    public function syncTask($taskId);

    /**
     * @param $taskId int|string
     * @return mixed
     */
    public function getTaskData($taskId);


    public function getTaskForm();

    /**
     * @return array
     */
    public function getTasks();


}
