<?php

namespace App\Controller;

use App\Controller\Prototype\BasicController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BasicController
{
    /**/
    public function init()
    {
        $this->setPageTitle('Főoldal');
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
}
