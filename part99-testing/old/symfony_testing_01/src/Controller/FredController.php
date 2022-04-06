<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FredController extends AbstractController
{
    #[Route('/fred', name: 'app_fred')]
    public function index(): Response
    {

        return $this->render('fred/index.html.twig', [
            'controller_name' => 'FredController',
        ]);
    }
}
