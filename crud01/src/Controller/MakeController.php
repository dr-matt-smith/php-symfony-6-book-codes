<?php

namespace App\Controller;

use App\Entity\Make;
use App\Form\MakeType;
use App\Repository\MakeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/make')]
class MakeController extends AbstractController
{
    #[Route('/', name: 'make_index', methods: ['GET'])]
    public function index(MakeRepository $makeRepository): Response
    {
        return $this->render('make/index.html.twig', [
            'makes' => $makeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'make_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $make = new Make();
        $form = $this->createForm(MakeType::class, $make);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($make);
            $entityManager->flush();

            return $this->redirectToRoute('make_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('make/new.html.twig', [
            'make' => $make,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'make_show', methods: ['GET'])]
    public function show(Make $make): Response
    {
        return $this->render('make/show.html.twig', [
            'make' => $make,
        ]);
    }

    #[Route('/{id}/edit', name: 'make_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Make $make, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MakeType::class, $make);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('make_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('make/edit.html.twig', [
            'make' => $make,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'make_delete', methods: ['POST'])]
    public function delete(Request $request, Make $make, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$make->getId(), $request->request->get('_token'))) {
            $entityManager->remove($make);
            $entityManager->flush();
        }

        return $this->redirectToRoute('make_index', [], Response::HTTP_SEE_OTHER);
    }
}
