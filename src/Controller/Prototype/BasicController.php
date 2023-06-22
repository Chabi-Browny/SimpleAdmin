<?php

namespace App\Controller\Prototype;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of BasicController - This is a extension of the AbstractController
 * @author Csaba Banrabás Barcsa
 */
class BasicController extends AbstractController
{
    protected $pageTile = '';

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

    public function getUserInfos()
    {
        $userInfo = $this->getUser();

        return [
            'uId' => $userInfo->getId(),
            'roles' => $userInfo->getRoles(),
            'uname' => $userInfo->getUserName(),
        ];
    }

    public function checkUserLogged()
    {
        return $this->getUser() !== null;
    }

    /**/
    public function render(string $view, array $viewData = [], $response = null): Response
    {
        $params = array_merge(
            $viewData,
            [
                'isLogged' => $this->checkUserLogged(),
                'pageTitle'     => $this->pageTile,
            ]
        );
        return parent::render($view, $params, $response);
    }
}
