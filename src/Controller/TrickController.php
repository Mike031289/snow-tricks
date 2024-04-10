<?php 
// src/Controller/TrickController.php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Picture;
use App\Entity\Video;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    #[Route(path: 'tricks/ajout-figure', name: 'add-trick', methods: ['GET', 'POST'])]
    public function addTrick(Request $request, EntityManagerInterface $em, TrickRepository $trickRepository, SluggerInterface $slugger): Response
    {
        $dateTime = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $formattedDateTime = $dateTime->format('d/m/Y');
        $trick = new Trick();
        $trick->setCreatedAt($dateTime);
        $trick->setUpdatedAt($dateTime);
        $form  = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        $trick = $form->getData();
        if ($form->isSubmitted() && $form->isValid()) {

             // Retrive pictures from form if not null
            if ($form->get('image')->getData() !== null) {

                /** @var UploadedFile[] $files */
                $files = $form->get('image')->getData();

                foreach ($files as $file) {
                    // Access properties of each file
                    $fileName = $trick->getId() .uniqid(). '.' . $file->getClientOriginalExtension();
                    // mooving upload file to the project directory 
                    $filePath = $file->move($this->getParameter('kernel.project_dir').'/public/media/pictures', $fileName);

                    $picture = new Picture();
                    $picture->setName($fileName);
                    $picture->setPath($filePath);
                    $picture->setTrick($trick);
                    // Associate the picture with your trick
                    $trick->addPicture($picture);
                }
            }

             // Retrive videoUrl from form if not null
            if ($form->get('videoUrl')->getData() !== null) {

                /** @var UploadedFile[] $urls */
                $urls = $form->get('videoUrl')->getData();

                foreach ($urls as $videoUrl) {
                    // Access properties of each url
                    // dd($videoUrl);


                    // Save the video content to your desired directory
                    $videos = $videoUrl;
                    // dd($videoPath);

                    $video = new Video();
                    $video->setName($videos);
                    $video->setUrl($videos);
                    $video->setTrick($trick);
                    // Associate the video with your trick
                    $trick->addVideo($video);
                  
                }
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
