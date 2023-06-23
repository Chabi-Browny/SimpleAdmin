<?php

namespace App\Controller;

use App\Controller\Prototype\BasicController;
use App\Repository\ContactRepository;
use App\Service\PaginationService;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends BasicController
{
    public function init()
    {
        $this->setPageTitle('Üzenetek');
    }

    // S.D.G.! :)
    #[Route('/messages/{page}', name: 'messages_list', requirements: ['page' => '\d+'])]
    public function index(Request $request, ContactRepository $contactRepo, int $page = 1): Response
    {
        $sizeValue = 0;
        $queryStr = $request->getQueryString();

        if ($queryStr !== null)
        {
            $sizeValue = (int) explode('=', $queryStr)[1];
        }

        $paginator = new PaginationService($contactRepo, $this->generateUrl('messages_list'), $page, $sizeValue);
        $contactList = $paginator->getCurrentContent();


        return $this->render('messages/index.html.twig', [
            'list' => !empty($contactList) ? $contactList : [],
            'pagination' => $paginator->renderPagination(),
            'pageSizer' => $paginator->renderPageSizer()
        ]);
    }

}
