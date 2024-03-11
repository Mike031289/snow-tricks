<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserSignInType;
use App\Form\PasswordresetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(path: '/register', name: 'inscription')]
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('snow-tricks');
        }

        return $this->render('user/signUp.html.twig', [
            'signUpForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/login', name: 'connexion')]
    public function login(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserSignInType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('snow-tricks');
        }

        return $this->render('user/signIn.html.twig', [
            'signInForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/passwordReset', name: 'password-reset')]
    public function passwordReset(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(PasswordresetType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('snow-tricks');
        }

        return $this->render('user/passwordReset.html.twig', [
            'signInForm' => $form->createView(),
        ]);
    }
}
