<?php
// src/Controller/HomeController.php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\Repository\PictureRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route(path: "/tricks", name: "homepage")]
    public function index(Request $request, TrickRepository $trickRepository, PictureRepository $pictureRepository): Response
    {
        // Get the page number from the request
        $page = $request->query->getInt('page', 1);

        // Number of items per page
        $limit = 3;

        // Retrieve paginated tricks
        $tricks = $trickRepository->findPaginatedTricksOrderByCreationDate($page, $limit);

        // Calculate the total number of pages
        $maxPage = ceil($tricks->count() / $limit);

        // Retrieve the latest pictures for each trick
        $latestPictures = $pictureRepository->findLatestPicturesForTrick();

        return $this->render('home.html.twig', [
            'tricks'         => $tricks,
            'latestPictures' => $latestPictures,
            'maxPage'        => $maxPage,
            'currentPage'    => $page // Pass the current page number to the template
        ]);
    }
}