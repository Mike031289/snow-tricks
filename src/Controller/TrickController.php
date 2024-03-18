<?php
// src/Controller/TrickController.php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Group;
use App\Entity\Trick;
use App\Form\TrickType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{

    // add new Trick with media
    #[Route(path: '/ajout-figure', name: 'add-trick')]
    public function addTrick(Request $request): Response
    {
        $trick = new Trick();
        $addTrickForm = $this->createForm(TrickType::class, $trick);

        $addTrickForm->handleRequest($request);

        if ($addTrickForm->isSubmitted() && $addTrickForm->isValid()) {

            return $this->redirectToRoute('home');
        }

        return $this->render('trick/addTrick.html.twig', [
            'addTrickForm' => $addTrickForm->createView(),
        ]);
    }

    // show Trick with medias and comment
    #[Route(path:"/page-figure", name:"show-trick")]
    public function showTrick(): Response
    {
        return $this->render('trick/showTrick.html.twig');
    }
   
}