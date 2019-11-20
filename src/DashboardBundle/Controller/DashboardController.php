<?php

namespace App\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\DashboardBundle\Controller
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
//        $this->seoApiProcessor->testFunc();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}