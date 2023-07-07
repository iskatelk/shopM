<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends AbstractController
{
    public function register() : Response
    {
        return $this->render('register/register.html.twig', [
            'controller_name', 'RegisterController',
        ]);
    }
}