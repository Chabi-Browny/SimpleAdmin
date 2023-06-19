<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ContactController
 *
 * @author Csaba Banrabás Barcsa
 */
class ContactController extends AbstractController
{
    #[Route('/contact')]
    public function contactForm()
    {
        return $this->render('public/contactFrom.html.twig', [
            'pageTitle' => 'Üdv a Kapcsolat oldalon',
        ]);
    }

    #[Route('/submitContact', name:'submit_contact', methods: ["POST"] )]
    public function submitForm(Request $request)
    {
        
    }

}
