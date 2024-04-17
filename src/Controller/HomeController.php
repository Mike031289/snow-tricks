<?php
// src/Controller/HomeController.php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    #[Route(path:"/tricks", name:"homepage")]
    public function index(TrickRepository $trickRepository, PictureRepository $pictureRepository): Response
    {
        // Fetch the latest picture for each trick
        $latestPictures = $pictureRepository->findLatestPicturesForTrick();
        $tricks = $trickRepository->findAllOrderByCreationDate();
        return $this->render('home.html.twig', ['tricks' => $tricks, 'latestPictures' => $latestPictures]);
    }
    
}
