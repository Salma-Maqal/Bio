<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;

final class CategoryController extends AbstractController
{
    #[Route('/admin/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {

        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/category/new', name: 'app_category_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);  
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', ' Votre catégorie a été créée avec succès!');
            return $this->redirectToRoute('app_category');

            
        }
        return $this->render('category/new.html.twig', [
    'form' => $form->createView(), ]);
  }

    #[Route('/admin/category/{id}/update', name: 'app_category_update')]
    public function update(Request $request, EntityManagerInterface $entityManager, Category $category): Response
    {
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', ' Votre catégorie a été mise à jour avec succès!');
            return $this->redirectToRoute('app_category');

        }

        return $this->render('category/update.html.twig', [
            'form' => $form->createView(),
            'category' => $category, ]);
    }

#[Route('/admin/category/{id}/delete', name: 'app_category_delete')]
    public function delete( EntityManagerInterface $entityManager, Category $category): Response
    {
        $entityManager->remove($category);
        $entityManager->flush();
        $this->addFlash('danger', ' Votre catégorie a été supprimée !');    
        return $this->redirectToRoute('app_category');
        
    }




}