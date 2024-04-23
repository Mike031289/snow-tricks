<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginLogoutController extends AbstractController
{
    #[Route(path: 'user/login', name: 'connexion')]
    public function login(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // return $this->redirectToRoute('homepage');
        }

        return $this->render('user/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
