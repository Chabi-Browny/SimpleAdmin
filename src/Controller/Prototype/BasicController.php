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

    /**
     * Description - set the current page title
     * @param string $pageTitle
     */
    public function setPageTitle(string $pageTitle)
    {
        $this->pageTile = $pageTitle;
    }

    /**
     * Description - Get the logged in user some info
     * @return array|null
     */
    public function getLoggedUserInfos(): ?array
    {
        $retVal = null;
        $userInfo = $this->getUser();

        if ($userInfo !== null)
        {
            $retVal = [
                'uId' => $userInfo->getId(),
                'roles' => $userInfo->getRoles(),
                'uname' => $userInfo->getUserName(),
            ];
        }

        return $retVal;
    }

    /**
     * Description - check the user is logged in
     * but this built in examination is more convenient --> is_granted('IS_AUTHENTICATED')
     * @return bool
     */
    public function checkUserLogged(): bool
    {
        return $this->getUser() !== null;
    }

    /**
     * Description - get all role of the users
     * @return type
     */
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

    /**
     * Description - check the specific user is root admin
     * @param array $userRolesToCheck
     * @return type
     */
    public function hasRootAdminRight(array $userRolesToCheck)
    {
        return in_array('ROLE_ROOT_ADMIN', $userRolesToCheck);
    }

    /**
     * Description - extended Render functionality
     * @param string $view
     * @param array $viewData
     * @param type $response
     * @return Response
     */
    public function render(string $view, array $viewData = [], $response = null): Response
    {
        $extraParams =
        [
            'isLogged' => $this->checkUserLogged(),
            'pageTitle'     => $this->pageTile,
            'userName' => $this->getLoggedUserInfos() !== null ? $this->getLoggedUserInfos()['uname'] : '',
        ];

        $params = array_merge( $viewData, $extraParams );

        return parent::render($view, $params, $response);
    }
}
