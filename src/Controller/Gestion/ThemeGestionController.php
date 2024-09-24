<?php

namespace App\Controller\Gestion;

use App\Entity\Theme;
use App\Form\ThemeType;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gestion/themes')]
class ThemeGestionController extends AbstractController
{
    #[Route('/', name: 'app_gestion_theme_index')]
    public function index(ThemeRepository $themeRepository): Response
    {
        return $this->render('gestion/theme/index.html.twig', [
            'titre' => 'Gestion des thèmes',
            'themes' => $themeRepository->findAll(),
        ]);
    }
    

    #[Route('/{id}', name: 'app_gestion_theme_show', methods: ['GET'])]
    public function show(Theme $theme,EntityManagerInterface $entityManager): Response
    {
        return $this->render('gestion/theme/show.html.twig', [
            'theme' => $theme,
            // 'titre' => $theme['titre'],
            // 'demandes' => $demandes,
            // 'situations' => $situations,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gestion_theme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Theme $theme, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion_theme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gestion/theme/edit.html.twig', [
            'theme' => $theme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gestion_theme_delete', methods: ['POST'])]
    public function delete(Request $request, Theme $theme, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theme->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($theme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gestion_theme_index', [], Response::HTTP_SEE_OTHER);
    }
}
