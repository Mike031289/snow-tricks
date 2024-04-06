<?php 
// src/Controller/TrickController.php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    #[Route(path: 'tricks/ajout-figure', name: 'add-trick', methods: ['GET', 'POST'])]
    public function addTrick(Request $request, EntityManagerInterface $em, TrickRepository $trickRepository): Response
    {
        // $createdAt   = new \DateTimeImmutable();
        $trick = new Trick();
        $trick->setCreatedAt(new \DateTimeImmutable());
        $trick->setUpdatedAt(new \DateTimeImmutable());
        $form  = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // retrive trick from form
            $trick = $form->getData();
            // Récupérer la date de création réelle de l'entité Trick
            $createdAt = $trick->getCreatedAt();
            $pictures = $trick->getPictures();
            $videos = $trick->getVideos();

            // Handle media files
            foreach ($pictures as $picture) {
                // Handle each picture file here (upload, etc.)
            }

            foreach ($videos as $video) {

                // Handle each video link here (validation, etc.)
            }

            $this->trickRepository->add($trick);

            $this->addFlash('success', 'Votre Figure a bien été ajouté');

            // Redirect to home page
            return $this->redirectToRoute('homepage', ['page' => 1], Response::HTTP_SEE_OTHER);

        }

        return $this->render('trick/addTrick.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/nouvelle-figure', name: 'new-trick', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $trick = new Trick();
        $form  = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle media files
            $pictures = $trick->getPictures();
            foreach ($pictures as $picture) {
                // Handle each picture file here (upload, etc.)
            }

            $videos = $trick->getVideos();
            foreach ($videos as $video) {
                // Handle each video link here (validation, etc.)
            }

            // Persist the Trick entity
            $this->trickRepository->add($trick);

            // Redirect to home page
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
