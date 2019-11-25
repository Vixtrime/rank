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
     * @param $taskId int|string
     * @return mixed
     */
    public function getTaskData($taskId);

    /**
     * @return array
     */
    public function getTaskForm();

    /**
     * @return array
     */
    public function getTasks();

    /**
     * @param $taskId
     * @return mixed
     */
    public function syncTask($taskId);
}
