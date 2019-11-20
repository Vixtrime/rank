<?php

namespace App\Core\SeoApiBundle\Controller;

use App\Core\SeoApiBundle\SeoApi\SeoApiFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SeoController
 * @package App\SeoBundle\Controller
 */
class SeoController extends AbstractController
{
    /**
     * @var SeoApiFactory
     */
    private $seoApiFactory;

    /**
     * SeoController constructor.
     * @param SeoApiFactory $seoApiFactory
     */
    public function __construct(SeoApiFactory $seoApiFactory)
    {
        $this->seoApiFactory = $seoApiFactory;
    }

    /**
     * //TODO GET -> POST
     * @Route(path="/{seoApiName}/seo-task", methods={"POST"})
     * @param Request $request
     * @param $seoApiName
     */
    public function createSeoTask(Request $request, $seoApiName)
    {
//        $newTaskInfo = json_decode($request->getContent()['newTaskInfo'], true);
        $newTaskInfo = null;
        $this->seoApiFactory->getSeoApiProcessor($seoApiName)->createRankTask($newTaskInfo);
    }

    /**
     * @Route(path="/{seoApiName}/seo-task/{id}", methods={"GET"})
     * @param $seoApiName
     * @param $id
     */
    public function getSeoTask($seoApiName, $id)
    {
        $this->seoApiFactory->getSeoApiProcessor($seoApiName)->getRankTaskData($id);
    }

}