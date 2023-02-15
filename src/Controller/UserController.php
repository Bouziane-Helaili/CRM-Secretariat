<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserFile;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {

        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            // 'users' => $userRepository->findBy(["email"=>"bouziane@hotmail.fr"]),
        ]);
    }

    #[Route('/employe', name: 'app_employe_index', methods: ['GET'])]   
    
    public function indexEmploye(ManagerRegistry $doctrine, UserRepository $userRepository): Response
    {
        if ($this->isGranted("ROLE_ADMIN")) {
            return $this->render('user/index.html.twig', [
                'users' => $userRepository->findAll()            ]);
        }elseif($this->isGranted("ROLE_USER")){
            $user = $userRepository->findByRoles('["ROLE_USER"]');
            return $this->render('user/index.html.twig', [
                'users' => $user
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        };
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository,  UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $userFile = new UserFile();
        $user->addUserFile($userFile);
        $user->setIsFirstLogin(true);
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                '123456'
            )
        );



        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        // dd($user->getRoles());
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
