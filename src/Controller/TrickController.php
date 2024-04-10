<?php 
// src/Controller/TrickController.php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Picture;
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
        // $createdAt   = new \DateTimeImmutable();
        $trick = new Trick();
        $trick->setCreatedAt(new \DateTimeImmutable());
        $trick->setUpdatedAt(new \DateTimeImmutable());
        $form  = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            /**@var UploadFile $file */
            dd($form->get('image')->getData());



            /**@var UploadUrl $url */
            dd($form->get('videoUrl')->getData());


            
            // Convert uploaded files to Picture entities
            // foreach ($form->get('pictures')->getData() as $uploadedFile) {
            //     $picture = new Picture();
            //     $picture->setPath($uploadedFile); // You need to define a 'setFile' method in your Picture entity to handle uploaded files
            //     $trick->addPicture($picture);
            // }
            // // retrive trick from form
            // $trick = $form->getData();
            // // Récupérer la date de création réelle de l'entité Trick
            // $createdAt = $trick->getCreatedAt();
            // $pictures = $trick->getPictures();
            // $videos = $trick->getVideos();
            // $picture  = $form->get('pictures')->getData();
            // dd($picture);
            // // Inject the SluggerInterface service into your class if you haven't already done so

            // foreach ($pictures as $picture) {
            //     // Handle each picture file here (upload, etc.)
            //     $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            //     // Secure the filename to prevent security issues
            //     $safeFilename = $slugger->slug($originalFilename);
            //     $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

            //     // Check if the destination directory exists, if not, create it
            //     $uploadDir = $this->getParameter('/tricks/public/media/picture/');
            //     if (!file_exists($uploadDir)) {
            //         mkdir($uploadDir, 0777, true);
            //     }

            //     // Move the uploaded file to the destination directory with the correct path
            //     $picture->move(
            //         $uploadDir,
            //         $newFilename
            //     );

            //     // Create a new Picture entity and save the filename
            //     $pictureEntity = new Picture();
            //     $pictureEntity->setName($newFilename);
            //     // Associate the picture with your trick
            //     $trick->addPicture($pictureEntity);
            // }

            // foreach ($videos as $video) {

            //     // Handle each video link here (validation, etc.)
            // }

            // $this->trickRepository->add($trick);

            // $this->addFlash('success', 'Votre Figure a bien été ajouté');

            // // Redirect to home page
            // return $this->redirectToRoute('homepage', ['page' => 1], Response::HTTP_SEE_OTHER);

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
