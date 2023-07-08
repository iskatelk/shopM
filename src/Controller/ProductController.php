<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product_show")
     */
    public function show(): Response
    {
        return $this->render('product/product.html.twig', [
            'controller_name', 'ProductController'
        ]);
    }
}