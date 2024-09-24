<?php

namespace App\Controller;

use App\Entity\Medium;
use App\Form\MediumType;
use App\Repository\MediumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/medium')]
class MediumController extends AbstractController
{
    #[Route('/', name: 'app_medium_index', methods: ['GET'])]
    public function index(MediumRepository $mediumRepository): Response
    {
        return $this->render('medium/index.html.twig', [
            'media' => $mediumRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_medium_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $medium = new Medium();
        $form = $this->createForm(MediumType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($medium);
            $entityManager->flush();

            return $this->redirectToRoute('app_medium_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medium/new.html.twig', [
            'medium' => $medium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medium_show', methods: ['GET'])]
    public function show(Medium $medium): Response
    {
        return $this->render('medium/show.html.twig', [
            'medium' => $medium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medium_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Medium $medium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MediumType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_medium_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medium/edit.html.twig', [
            'medium' => $medium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medium_delete', methods: ['POST'])]
    public function delete(Request $request, Medium $medium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medium->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($medium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_medium_index', [], Response::HTTP_SEE_OTHER);
    }
}
