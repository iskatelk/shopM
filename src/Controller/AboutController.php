<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about")
     */
    public function about() : Response
    {
        return $this->render('about/about.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
}