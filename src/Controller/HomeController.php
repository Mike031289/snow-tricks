<?php
// src/Controller/HomeController.php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    #[Route(path:"/tricks", name:"homepage")]
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAllOrderByCreationDate();
        return $this->render('home.html.twig', ['tricks' => $tricks]);
    }
    
}
