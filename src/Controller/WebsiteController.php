<?php

namespace App\Controller;

use App\Entity\Website;
use App\Form\WebsiteType;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/website')]
class WebsiteController extends AbstractController
{
    #[Route('/', name: 'app_website_index', methods: ['GET'])]
    public function index(WebsiteRepository $websiteRepository): Response
    {
        return $this->render('website/index.html.twig', [
            'websites' => $websiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_website_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $website = new Website();
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($website);
            $entityManager->flush();

            return $this->redirectToRoute('app_website_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('website/new.html.twig', [
            'website' => $website,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_website_show', methods: ['GET'])]
    public function show(Website $website): Response
    {
        return $this->render('website/show.html.twig', [
            'website' => $website,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_website_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Website $website, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_website_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('website/edit.html.twig', [
            'website' => $website,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_website_delete', methods: ['POST'])]
    public function delete(Request $request, Website $website, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$website->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($website);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_website_index', [], Response::HTTP_SEE_OTHER);
    }
}
