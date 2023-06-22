<?php
namespace App\Controller;

use App\Controller\Prototype\BasicController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;

class LoginController extends BasicController
{
    /**/
    public function init()
    {
        $this->setPageTitle('Belépés');
    }

    #[Route('/login', name: 'form_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $retVal = null;

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($this->checkUserLogged())
        {
            $retVal = $this->redirectToRoute('dashboard');
        }
        else
        {
            $retVal = $this->render('login/index.html.twig', [
                'last_username' => $lastUsername ?? null,
                'error'         => $error ?? null,
            ]);
        }

        return $retVal;
    }

    /**/
    #[Route('/logout', name: 'app_logout')]
    public function logout(Security $security)
    {
        $security->logout();

        return $this->redirectToRoute('form_login');
    }
}