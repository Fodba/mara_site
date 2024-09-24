<?php

namespace App\Controller\Gestion;

use App\Entity\Situation;
use App\Form\SituationType;
use App\Repository\SituationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gestion/situations')]
class SituationGestionController extends AbstractController
{
    #[Route('/', name: 'app_gestion_situation_index')]
    public function index(SituationRepository $situationRepository): Response
    {
        return $this->render('gestion/situation/index.html.twig', [
            'titre' => 'Gestion des situations',
            'situations' => $situationRepository->findAll(),
        ]);
    }
    
    #[Route('/{id}', name: 'app_gestion_situation_show', methods: ['GET'])]
    public function show(Situation $situation,EntityManagerInterface $entityManager): Response
    {
        return $this->render('gestion/situation/show.html.twig', [
            'situation' => $situation,
            // 'titre' => $situation['titre'],
            // 'situations' => $situations,
            // 'situations' => $situations,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gestion_situation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Situation $situation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SituationType::class, $situation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion_situation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gestion/situation/edit.html.twig', [
            'situation' => $situation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gestion_situation_delete', methods: ['POST'])]
    public function delete(Request $request, Situation $situation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$situation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($situation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gestion_situation_index', [], Response::HTTP_SEE_OTHER);
    }
}
