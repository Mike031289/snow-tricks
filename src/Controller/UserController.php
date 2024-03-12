<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserSignInType;
use App\Entity\PasswordReset;
use App\Form\PasswordresetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route(path: '/inscription', name: 'register')]
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

    #[Route(path: '/password-reset', name: 'passwordreset')]
    public function passwordReset(Request $request): Response
    {
        $passwordReset = new PasswordReset();
        $form = $this->createForm(PasswordresetType::class, $passwordReset);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('snow-tricks');
        }

        return $this->render('user/passwordReset.html.twig', [
            'signInForm' => $form->createView(),
        ]);
    }
}
