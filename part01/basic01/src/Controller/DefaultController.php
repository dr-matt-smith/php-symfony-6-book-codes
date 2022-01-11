<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'default')]
    public function index(): Response
    {
        return new Response('Welcome to your new controller!');
//        return $this->render('default/index.html.twig', [
//            'controller_name' => 'DefaultController',
//        ]);
    }
}