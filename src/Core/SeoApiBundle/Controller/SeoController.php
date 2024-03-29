<?php

namespace App\Core\SeoApiBundle\Controller;

use App\Core\SeoApiBundle\SeoApi\SeoApiProviderFactory;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SeoController constructor.
     * @param SeoApiProviderFactory $seoApiProviderFactory
     * @param LoggerInterface $logger
     */
    public function __construct(SeoApiProviderFactory $seoApiProviderFactory, LoggerInterface $logger)
    {
        $this->seoApiProviderFactory = $seoApiProviderFactory;
        $this->logger = $logger;
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-task", methods={"POST"})
     * @param Request $request
     * @param $seoApiProvider
     * @param $apiProcessor
     * @return JsonResponse
     */
    public function createSeoTask(Request $request, $seoApiProvider, $apiProcessor)
    {
        $newTaskInfo = json_decode($request->getContent(), true);

        try {
            $this->seoApiProviderFactory->getSeoApiProvider($seoApiProvider)->getApiProcessor($apiProcessor)->createTask($newTaskInfo['taskForm']);
            $response = ['success' => true, 'message' => 'Success!'];
        } catch (\InvalidArgumentException $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage() . $e->getTraceAsString());
            $response = ['success' => false, 'message' => 'Something went wrong! Please try again.'];
        }

        return new JsonResponse($response);
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-task/{id}", methods={"GET"})
     * @param $seoApiProvider
     * @param $apiProcessor
     * @param $id
     * @throws \Exception
     */
    public function getSeoTask($seoApiProvider, $apiProcessor, $id)
    {
        $this->seoApiProviderFactory->getSeoApiProvider($seoApiProvider)->getApiProcessor($apiProcessor)->getTaskData($id);
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-tasks", methods={"GET"})
     * @param $seoApiProvider
     * @param $apiProcessor
     * @return JsonResponse
     * @throws \Exception
     */
    public function getSeoTasks($seoApiProvider, $apiProcessor)
    {
        return new JsonResponse($this->seoApiProviderFactory
            ->getSeoApiProvider($seoApiProvider)
            ->getApiProcessor($apiProcessor)
            ->getTasks());
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/form", methods={"GET"})
     * @param $seoApiProvider
     * @param $apiProcessor
     * @return JsonResponse
     * @throws \Exception
     */
    public function getSeoTaskForm($seoApiProvider, $apiProcessor)
    {
        return new JsonResponse($this->seoApiProviderFactory
            ->getSeoApiProvider($seoApiProvider)
            ->getApiProcessor($apiProcessor)
            ->getTaskForm());
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-task/{id}/sync", methods={"POST"})
     * @param $seoApiProvider
     * @param $apiProcessor
     * @param $id
     * @return JsonResponse
     */
    public function syncTask($seoApiProvider, $apiProcessor, $id)
    {
        try {
            $this->seoApiProviderFactory->getSeoApiProvider($seoApiProvider)->getApiProcessor($apiProcessor)->syncTask($id);
            $response = ['success' => true, 'message' => 'Success!'];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage() . $e->getTraceAsString());
            $response = ['success' => false, 'message' => 'Something went wrong, please try again later'];
        }
        return new JsonResponse($response);
    }

    /**
     * @Route(path="/seo-api/{seoApiProvider}/{apiProcessor}/seo-task/recive-postback", methods={"POST"})
     * @param $seoApiProvider
     * @param $apiProcessor
     * @param Request $request
     * @throws \Exception
     */
    public function receivePostback($seoApiProvider, $apiProcessor, Request $request)
    {
        $newTaskInfo = json_decode($request->getContent(), true);
        $this->seoApiProviderFactory->getSeoApiProvider($seoApiProvider)->getApiProcessor($apiProcessor)->processPostback($newTaskInfo);
    }
}
