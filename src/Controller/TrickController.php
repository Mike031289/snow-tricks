<?php
// src/Controller/TrickController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Trick;
use App\Entity\Picture;
use App\Entity\Video;
use App\Entity\Comment;
use App\Form\TrickType;
use App\Form\CommentType;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\PictureRepository;
use App\Repository\VideoRepository;
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

    // crat new trick
    #[Route(path: 'tricks/ajout-figure', name: 'add-trick', methods: ['GET', 'POST'])]
    public function addTrick(Request $request, EntityManagerInterface $em, TrickRepository $trickRepository): Response
    {
        $createdAt = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $createdAt->format('d/m/Y');
        $trick = new Trick();
        $trick->setCreatedAt($createdAt);
        $trick->setUpdatedAt($createdAt);
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        $trick = $form->getData();
        if ($form->isSubmitted() && $form->isValid()) {

            // Retrive pictures from form if not null
            if ($form->get('image')->getData() !== null) {

                /** @var UploadedFile[] $files */
                $files = $form->get('image')->getData();

                foreach ($files as $file) {
                    // Access properties of each file
                    $fileName = $trick->getId() . uniqid() . '.' . $file->getClientOriginalExtension();
                    // mooving upload file to the project directory 
                    $filePath = $file->move($this->getParameter('kernel.project_dir') . '/public/media/pictures', $fileName);

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

                // Access properties of each url
                foreach ($urls as $url) {
                    $path = parse_url((string) $url)['path'];

                    $id = substr($path, 1);
                    // Save the video content to your desired directory
                    $videoUrl = "https://www.youtube.com/embed/$id";

                    $video = new Video();
                    $video->setName($videoUrl);
                    $video->setUrl($videoUrl);
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

    // show-trick detail
    #[Route(path: "/trick-detail/{slug}/{id}", name: "show-trick", methods: ['GET', 'POST'])]
    public function showTrick(Request $request, TrickRepository $trickRepository, CommentRepository $commentRepository, CategoryRepository $categoryRepository, PictureRepository $pictureRepository, VideoRepository $videoRepository, EntityManagerInterface $em, int $id): Response
    {
        // get the id of the curent Trick
        $trick = $trickRepository->findById($id);
        if (!$trick) {
            throw $this->createNotFoundException('Trick not found');
        }

        $createdAt = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $createdAt->format('d/m/Y');
        $comment = new Comment();
        $comment->setCreatedAt($createdAt);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Retrive comment from form if not null
            if ($form->get('content')->getData() !== null) {
                $content = $form->get('content')->getData();

                $comment->setContent($content);
                // Associate the comment with your trick
                $commentRepository->addCommentToTrick($comment, $trick);
            }

            $this->addFlash('success', 'Commentaire ajouté avec succès');

        }

        // Retrieve related entities (comments, category, pictures, videos)
        // Pass the trick entity and related entities to the Twig template
        return $this->render('trick/showTrick.html.twig', [
            'form'          => $form->createView(),
            'trick'         => $trick,
            'comments'      => $trick->getComments(),
            'category'      => $trick->getCategory(),
            'pictures'      => $trick->getPictures(),
            'videos'        => $trick->getVideos(),
            'latestPicture' => $trick->getPictures()->offsetGet(0),
        ]);
    }
    // show-trick detail
    #[Route(path: "/delete-trick/{id}", name: "delete-trick", methods: ['POST'])]
    public function deleteTrick(Request $request, TrickRepository $trickRepository, int $id): Response
    {

        // get the id of the curent Trick
        $trick = $trickRepository->findById($id);
        if (!$trick) {
            throw $this->createNotFoundException('Trick not found');
        }
        // dd($trick);
        $trickRepository->delete($trick);
        $this->addFlash('success', 'Figure supprimée avec succès !');

        // Si la requête est de type POST, supprimer le trick
        // if ($request->isMethod('POST')) {
        //     $trickRepository->delete($trick);
        //     // $trickRepository->flush();

        //     $this->addFlash('success', 'Figure supprimée avec succès !');
        // }
        // Redirect to home page
        return $this->redirectToRoute('homepage', ['page' => 1], Response::HTTP_SEE_OTHER);

    }

    #[Route(path: "/edite-trick/{id}", name: "edite-trick", methods: ['GET', 'POST'])]
    public function editeTrick(Request $request, TrickRepository $trickRepository, CommentRepository $commentRepository, CategoryRepository $categoryRepository, PictureRepository $pictureRepository, VideoRepository $videoRepository, EntityManagerInterface $em, int $id): Response
    {
        $trick = $trickRepository->findById($id);

        if (!$trick) {
            throw $this->createNotFoundException('Trick not found');
        }

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        // Si la requête est de type POST, modifier le trick
        if ($request->isMethod('POST')) {
            // $updatedAt = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
            // $updatedAt->format('d/m/Y');
            // $trick = new Trick();
            // $trick->setUpdatedAt($updatedAt);
            // $form = $this->createForm(TrickType::class, $trick);
            // $form->handleRequest($request);
            // $trick = $form->getData();
            // if ($form->isSubmitted() && $form->isValid()) {

            //     // Retrive pictures from form if not null
            //     if ($form->get('image')->getData() !== null) {

            //         /** @var UploadedFile[] $files */
            //         $files = $form->get('image')->getData();

            //         foreach ($files as $file) {
            //             // Access properties of each file
            //             $fileName = $trick->getId() . uniqid() . '.' . $file->getClientOriginalExtension();
            //             // mooving upload file to the project directory 
            //             $filePath = $file->move($this->getParameter('kernel.project_dir') . '/public/media/pictures', $fileName);

            //             $picture = new Picture();
            //             $picture->setName($fileName);
            //             $picture->setPath($filePath);
            //             $picture->setTrick($trick);
            //             // Associate the picture with your trick
            //             $trick->addPicture($picture);
            //         }
            //     }

            //     // Retrive videoUrl from form if not null
            //     if ($form->get('videoUrl')->getData() !== null) {

            //         /** @var UploadedFile[] $urls */
            //         $urls = $form->get('videoUrl')->getData();

            //         // Access properties of each url
            //         foreach ($urls as $url) {
            //             $path = parse_url((string) $url)['path'];

            //             $id = substr($path, 1);
            //             // Save the video content to your desired directory
            //             $videoUrl = "https://www.youtube.com/embed/$id";

            //             $video = new Video();
            //             $video->setName($videoUrl);
            //             $video->setUrl($videoUrl);
            //             $video->setTrick($trick);
            //             // Associate the video with your trick
            //             $trick->addVideo($video);

            //         }
            //     }
            $trickRepository->update($trick);

            $this->addFlash('success', 'Figure modifié avec succès !');
            return $this->redirectToRoute('homepage');
        }

        // Rendre le formulaire et les informations du trick
        return $this->render('trick/editeTrick.html.twig', [
            'form'          => $form->createView(),
            'trick'         => $trick,
            'comments'      => $trick->getComments(),
            'category'      => $trick->getCategory(),
            'pictures'      => $trick->getPictures(),
            'videos'        => $trick->getVideos(),
            'latestPicture' => $trick->getPictures()->offsetGet(0),
        ]);
    }

}
