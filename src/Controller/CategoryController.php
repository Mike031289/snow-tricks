<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route(path: 'tricks/nouveau-groupe', name: 'add-group',  methods: ['GET', 'POST'])]
    public function addCategory(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('homepage');
        }

        return $this->render('category/addCategory.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
