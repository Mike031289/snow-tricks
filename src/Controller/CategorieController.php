<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route(path: '/nouveau-groupe', name: 'add-group',  methods: ['GET', 'POST'])]
    public function addCategorie(Request $request): Response
    {
        $categorie = new Categorie();
        $categorieForm = $this->createForm(CategorieType::class, $categorie);

        $categorieForm->handleRequest($request);

        if ($categorieForm->isSubmitted() && $categorieForm->isValid()) {

            return $this->redirectToRoute('homepage');
        }

        return $this->render('categorie/addCategorie.html.twig', [
            'categorieForm' => $categorieForm->createView(),
        ]);
    }

}
