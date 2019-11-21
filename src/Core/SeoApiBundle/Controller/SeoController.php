<?php

namespace App\Core\SeoApiBundle\Controller;

use App\Core\SeoApiBundle\SeoApi\SeoApiProviderFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SeoController
 * @package App\SeoBundle\Controller
 */
class SeoController extends AbstractController
{
    /**
     * @var SeoApiProviderFactory
     */
    private $seoApiProviderFactory;

    /**
     * SeoController constructor.
     * @param SeoApiProviderFactory $seoApiProviderFactory
     */
    public function __construct(SeoApiProviderFactory $seoApiProviderFactory)
    {
        $this->seoApiProviderFactory = $seoApiProviderFactory;
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-task", methods={"POST"})
     * @param Request $request
     * @param $seoApiProvider
     * @param $apiProcessor
     */
    public function createSeoTask(Request $request, $seoApiProvider, $apiProcessor)
    {
        $newTaskInfo = json_decode($request->getContent()['taskForm'], true);
        $newTaskInfo = null;
        $this->seoApiProviderFactory->getSeoApiProvider($seoApiProvider)->getApiProcessor($apiProcessor)->createTask($newTaskInfo);
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-task/{id}", methods={"GET"})
     * @param $seoApiName
     * @param $id
     */
    public function getSeoTask($seoApiName, $id)
    {
        $this->seoApiProviderFactory->getSeoApiProvider($seoApiName)->getApiProcessor($id);
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-tasks", methods={"GET"})
     * @param $seoApiName
     * @param $id
     */
    public function getSeoTasks($seoApiName, $id)
    {
        $this->seoApiProviderFactory->getSeoApiProvider($seoApiName)->getApiProcessor($id);
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/form", methods={"GET"})
     * @param $seoApiProvider
     * @param $apiProcessor
     */
    public function getSeoTaskForm($seoApiProvider, $apiProcessor)
    {
        $this->seoApiProviderFactory->getSeoApiProvider($seoApiProvider)->getApiProcessor($apiProcessor)->getTaskForm();
    }
}
