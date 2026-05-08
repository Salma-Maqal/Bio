<?php

namespace App\Controller\Admin;
use App\Entity\User; 

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/admin/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
        
    #[Route('/admin/user/{id}/remove', name: 'app_user_remove')]
    public function editorRoleRemove(EntityManagerInterface $entityManager, User $user): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();
        $this->addFlash('danger', 'Utilisateur supprimé avec succès.');
        return $this->redirectToRoute('app_user');}
}
