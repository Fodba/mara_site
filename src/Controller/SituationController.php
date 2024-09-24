<?php

namespace App\Controller;

use App\Entity\Situation;
use App\Entity\Demande;
use App\Form\SituationType;
use App\Repository\SituationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;

#[Route('/situation')]
class SituationController extends AbstractController
{
    #[Route('/', name: 'app_situation_index', methods: ['GET'])]
    public function index(SituationRepository $situationRepository): Response
    {
        return $this->render('situation/index.html.twig', [
            'situations' => $situationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_situation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $situation = new Situation();
        $form = $this->createForm(SituationType::class, $situation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($situation);
            $entityManager->flush();

            return $this->redirectToRoute('app_situation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('situation/new.html.twig', [
            'situation' => $situation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_situation_show', methods: ['GET'])]
    public function show(Situation $situation): Response
    {
        return $this->render('situation/show.html.twig', [
            'situation' => $situation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_situation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Situation $situation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SituationType::class, $situation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_situation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('situation/edit.html.twig', [
            'situation' => $situation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_situation_delete', methods: ['POST'])]
    public function delete(Request $request, Situation $situation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$situation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($situation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_situation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/situations/{dentifiant}', name: 'app_getSituation', methods: ['GET'])]
    public function getSituations(Request $request,Demande $demande, EntityManagerInterface $entityManager): Response
    {

        $situations = $repositoryS->findBy(['demande' => $demande], [], 5);
        
        // print($situations);
        // dd($situations);
        // $logger->debug('situations');
        // $logger->debug($situations);
        foreach ($situations as $situation)
        {

        }
        $messages = [];
        foreach ($situations as $situation){
            // dd($situation);
            $messages[$situation->getIdentifiant()] = [];
            foreach ($situation as $sit){

                $messages[$situation->getIdentifiant()][$sit->getIdentifiant()] = $repositoryM->findBy(['situation' => $sit], [], 5);
            
            }
        }

        dd($demande);
        return new Response($messages);


// dd($demande);
            $sit = $repositoryS->findBy(['demande' => $demande], ['id'=>'ASC'], 5);
            $situs = [];
            foreach ($sit as $value) {
                // dd($value);
                $messages = $repositoryM->findBy(['situation' => $value], [], 1)[0];
                // dd($messages);
                $situs[$value->getTexte()] = [
                    // 'situation' => $value,
                    'message' => $messages,
                ];
                // dd($situs);
            }


        if($request->isXmlHttpRequest()) {
            sleep(5);
            return new Response($messages);
        }
        return new Response('<span class="text-danger">Cet appel doit être effectué via AJAX.</span>', Response::HTTP_BAD_REQUEST);
    }
}
