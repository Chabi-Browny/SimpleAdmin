<?php

namespace App\Controller;

use App\Controller\Prototype\BasicController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends BasicController
{
    /**/
    public function init()
    {
        $this->setPageTitle('Vezérlőpult');
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
