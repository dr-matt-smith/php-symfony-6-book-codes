<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Use App\Util\ExampleRepository;

class DefaultController extends AbstractController
{
    #[Route('/call', name: 'findByTest')]
    public function call(): Response
    {
        // illustrate how __call works
        $exampleRepository = new ExampleRepository();

        $html = "<pre>";
        $html .=  "----- calling findAll() -----\n";
        $html .= $exampleRepository->findAll();

        $html .=  "\n\n----- calling findAllByProperty() -----\n";
        $html .= $exampleRepository->findByName('matt', 'smith');

        $html .=  "\n----- calling findAllByProperty() -----\n";
        $html .= $exampleRepository->findByProperty99('needle in haystack');

        $html .=  "\n----- calling badMethodName() -----\n";
        $html .= $exampleRepository->badMethodName('matt', 'smith');

        return new Response($html);
    }

    #[Route('/default', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
