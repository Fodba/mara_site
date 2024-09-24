<?php

namespace App\Controller;

use App\Entity\Header;
use App\Form\HeaderType;
use App\Repository\HeaderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/header')]
class HeaderController extends AbstractController
{
    #[Route('/', name: 'app_header_index', methods: ['GET'])]
    public function index(HeaderRepository $headerRepository): Response
    {
        return $this->render('header/index.html.twig', [
            'headers' => $headerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_header_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $header = new Header();
        $form = $this->createForm(HeaderType::class, $header);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($header);
            $entityManager->flush();

            return $this->redirectToRoute('app_header_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('header/new.html.twig', [
            'header' => $header,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_header_show', methods: ['GET'])]
    public function show(Header $header): Response
    {
        return $this->render('header/show.html.twig', [
            'header' => $header,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_header_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Header $header, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HeaderType::class, $header);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_header_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('header/edit.html.twig', [
            'header' => $header,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_header_delete', methods: ['POST'])]
    public function delete(Request $request, Header $header, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$header->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($header);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_header_index', [], Response::HTTP_SEE_OTHER);
    }
}
