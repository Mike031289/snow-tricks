<?php

namespace App\Controller;

use App\Entity\PasswordReset;
use App\Form\PasswordresetType;
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
        $form = $this->createForm(PasswordresetType::class, $passwordReset);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('snow-tricks');
        }

        return $this->render('user/passwordReset.html.twig', [
            'loginForm' => $form->createView(),
        ]);
    }
}
