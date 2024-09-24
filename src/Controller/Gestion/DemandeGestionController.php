<?php

namespace App\Controller\Gestion;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gestion/demandes')]
class DemandeGestionController extends AbstractController
{
    #[Route('/', name: 'app_gestion_demande_index')]
    public function index(DemandeRepository $demandeRepository): Response
    {
        return $this->render('gestion/demande/index.html.twig', [
            'titre' => 'Gestion des demandes',
            'demandes' => $demandeRepository->findAll(),
        ]);
    }
    #[Route('/{id}', name: 'app_gestion_demande_show', methods: ['GET'])]
    public function show(Demande $demande,EntityManagerInterface $entityManager): Response
    {
        return $this->render('gestion/demande/show.html.twig', [
            'demande' => $demande,
            // 'titre' => $demande['titre'],
            // 'demandes' => $demandes,
            // 'situations' => $situations,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gestion_demande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Demande $demande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion_demande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gestion/demande/edit.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gestion_demande_delete', methods: ['POST'])]
    public function delete(Request $request, Demande $demande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($demande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gestion_demande_index', [], Response::HTTP_SEE_OTHER);
    }
}
