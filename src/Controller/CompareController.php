<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompareController extends AbstractController
{
    /**
     * @Route("/compare", name="app_compare")
     */
    public function compare() : Response
    {
        return $this->render('compare\compare.html.twig', [
            'controller_name', 'CompareController',
        ]);
    }
}