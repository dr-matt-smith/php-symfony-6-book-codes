<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends AbstractController
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        $template = 'default/index.html.twig';
        $args = [
        ];
        return $this->render($template, $args);
    }

    #[Route('/pinkblue', name: 'pinkblue')]
    public function pinkblue(): Response
    {
        $colors = [
            'foreground' => 'blue', 'background' => 'pink'
        ];

        // store colours in session variable 'colours'
        $session = $this->requestStack->getSession();
        $session->set('colors', $colors);

        return $this->redirectToRoute('app_default');
    }

    #[Route('/clear', name: 'default_colors')]
    public function defaultColors(): Response
    {
        $session = $this->requestStack->getSession();
        $session->clear();

        return $this->redirectToRoute('app_default');
    }
}
