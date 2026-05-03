<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ShopDetailController extends AbstractController
{
    #[Route('/shop/detail', name: 'app_shop_detail')]
    public function index(): Response
    {
        return $this->render('shop_detail/index.html.twig', [
            'controller_name' => 'ShopDetailController',
        ]);
    }
}
