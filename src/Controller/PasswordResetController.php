<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Entity\PasswordReset;
use App\Form\RequestForPasswordresetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PasswordResetController extends AbstractController
{
    #[Route(path: '/password-reset', name: 'passwordreset')]
    public function passwordReset(Request $request): Response
    {
        $passwordReset = new PasswordReset();
        $form = $this->createForm(RequestForPasswordresetType::class, $passwordReset);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('snow-tricks');
        }

        return $this->render('user/requestForPasswordReset.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/reset-password', name: 'resetpassword')]
    public function resetPassword(Request $request): Response
    {
        $passwordReset = new User();
        $form = $this->createForm(ResetPasswordType::class, $passwordReset);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('snow-tricks');
        }

        return $this->render('user/resetPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
