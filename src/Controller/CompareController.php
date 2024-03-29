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
    public function add() : Response
    {
        return $this->render('compare\compare.html.twig', [
            'controller_name', 'CompareController',
        ]);
    }

    /**
     * @Route("/compare/remove", name="app_compare_remove")
     */
    public function remove() : Response
    {
        return $this->render('compare\compare.html.twig', [
            'controller_name', 'CompareController',
        ]);
    }

}