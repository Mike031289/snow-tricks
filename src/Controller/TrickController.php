<?php
// src/Controller/TrickController.php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Entity\Media;
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
    public function addTrick(Request $request, TrickRepository $trickRepository): Response
    {
        $trick = new Trick();
        $media = Media::class;
        $form  = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle multiple media files
            $trick = $form->getData();
            // dd($trick);
            $pictures = $trick->getPictures();
            // dd($pictures);

            foreach ($pictures as $picture) {
            dd($picture);

                // Handle each media file (you can upload them, etc.)
            }

            // Persist the Trick entity
            $trickRepository->persist($trick);
            $trickRepository->flush();

            // Redirect to home page
            return $this->redirectToRoute('home');
        }

        return $this->render('trick/addTrick.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    public function new(Request $request, TrickRepository $trickRepository): Response
    {
        $trick = new Trick();
        $form  = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer les fichiers d'images
            foreach ($trick->getPictures() as $picture) {
                // Traiter chaque fichier d'image ici (téléchargement, enregistrement en base de données, etc.)
            }

            // Gérer les liens vidéo
            foreach ($trick->getVideos() as $video) {
                // Traiter chaque lien vidéo ici (validation, enregistrement en base de données, etc.)
            }

            // Enregistrer le Trick en base de données
            // $entityManager = $this->getDoctrine()->getManager();
            $trickRepository->persist($trick);
            $trickRepository->flush();

            // Rediriger l'utilisateur vers une autre page, par exemple la page d'accueil
            return $this->redirectToRoute('home');
        }

        return $this->render('trick/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path:"/page-figure", name:"show-trick")]
    public function showTrick(): Response
    {
        return $this->render('trick/showTrick.html.twig');
    }
}
