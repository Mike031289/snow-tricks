<?php
// src/Controller/TrickController.php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Service\FileService;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    private $fileService;
    private $trickRepository;

    public function __construct(FileService $fileService, TrickRepository $trickRepository)
    {
        $this->fileService = $fileService;
        $this->trickRepository = $trickRepository;
    }

    #[Route(path: '/ajout-figure', name: 'add-trick', methods: ['GET', 'POST'])]
    public function addTrick(Request $request): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get picture and video files
            $newPictureFile = $form->get('picture')->getData();
            $newVideoFile = $form->get('video')->getData();

            // Upload files and get uploaded file names using FileService
            $pictureFileName = $this->fileService->uploadFile($newPictureFile);
            $videoFileName = $this->fileService->uploadFile($newVideoFile);

            // Set file names to corresponding properties of Trick entity
            $trick->setPicture($pictureFileName);
            $trick->setVideo($videoFileName);

            // Call the add method of TrickRepository to persist the Trick entity
            $this->trickRepository->add($trick);

            // Redirect to home page
            return $this->redirectToRoute('home');
        }

        return $this->render('trick/addTrick.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path:"/page-figure", name:"show-trick")]
    public function showTrick(): Response
    {
        return $this->render('trick/showTrick.html.twig');
    }
}
