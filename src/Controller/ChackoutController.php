<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ChackoutController extends AbstractController
{
    #[Route('/chackout', name: 'app_chackout')]
    public function index(): Response
    {
        return $this->render('chackout/index.html.twig', [
            'controller_name' => 'ChackoutController',
        ]);
    }
}
