<?php

namespace App\Controller\Prototype;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;

class BasicController extends AbstractController
{
    protected $pageTile;

    public function __construct()
    {
        $this->init();
    }
//    #[Route('/basic', name: 'app_basic')]
//    public function index(): Response
//    {
//        return $this->render('basic/index.html.twig', [
//            'controller_name' => 'BasicController',
//        ]);
//    }

    public function init(){}

    public function setPageTitle(string $pageTitle)
    {
        $this->pageTile = $pageTitle;
    }
}
