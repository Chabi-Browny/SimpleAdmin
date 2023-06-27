<?php

namespace App\Controller\Prototype;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

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

    /**/
    public function checkUserLogged(): bool
    {
        return $this->getUser() !== null;
    }

    /**/
    public function getUserRoles()
    {
        $roles = $this->getParameter('security.role_hierarchy.roles');

        $roleList = [];

        foreach($roles as $parentRole => $childRoles)
        {
            if ( !in_array($parentRole, $roleList) )
            {
                $roleList [strtolower($parentRole)]= $parentRole;
            }

            foreach($childRoles as $childRole)
            {
                if (!in_array($childRole, $roleList))
                {
                    $roleList [strtolower($childRole)]= $childRole;
                }
            }
        }

        return $roleList;
    }

    public function isRootAdmin()
    {
        
    }

    /**/
    public function render(string $view, array $viewData = [], $response = null): Response
    {
        $extraParams =
        [
            'isLogged' => $this->checkUserLogged(),
            'pageTitle'     => $this->pageTile,
        ];

        $params = array_merge( $viewData, $extraParams );

        return parent::render($view, $params, $response);
    }
}
