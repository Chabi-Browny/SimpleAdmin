<?php

namespace App\Controller;

use App\Controller\Prototype\BasicController;
use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use App\Service\PaginationService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/users')]
class UsersController extends BasicController
{
    /**/
    public function init()
    {
        $this->setPageTitle('Felhasználók');
    }

    #[Route('/{page}', name: 'app_users_index', methods: ['GET'], requirements: ['page' => '\d+'])]
    public function index(Request $request, UsersRepository $usersRepository, int $page = 1): Response
    {
        $sizeValue = 0;
        $queryStr = $request->getQueryString();

        if ($queryStr !== null)
        {
            $sizeValue = (int) explode('=', $queryStr)[1];
        }

        $paginator = new PaginationService($usersRepository, $this->generateUrl('app_users_index'), $page, $sizeValue);
        $userList = $paginator->getCurrentContent();

        return $this->render('users/index.html.twig', [
            'users' => !empty($userList) ? $userList : [],
            'pagination' => $paginator->renderPagination(),
            'pageSizer' => $paginator->renderPageSizer()
        ]);
    }

    #[Route('/new', name: 'app_users_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsersRepository $usersRepository): Response
    {
        $user = new Users();
        $user->setRoles($this->getUserRoles());

        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $usersRepository->save($user, true);

            return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('users/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_users_show', methods: ['GET'])]
    public function show(Users $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_users_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Users $user, UsersRepository $usersRepository): Response
    {
        $user->setRoles($this->getUserRoles());

        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->save($user, true);

            return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_users_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ROOT_ADMIN', message: 'Csak a root admin törölhet.')]
    public function delete(Request $request, Users $user, UsersRepository $usersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $usersRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }

}