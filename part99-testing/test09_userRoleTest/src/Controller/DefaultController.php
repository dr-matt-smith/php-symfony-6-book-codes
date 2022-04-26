<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $template = 'default/homepage.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    #[Route('/uc', name: 'uc')]
    public function useCase(): Response
    {
        $template = 'default/uc.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

}
