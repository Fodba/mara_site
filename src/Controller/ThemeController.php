<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Form\ThemeType;
use App\Repository\ThemeRepository;
use App\Entity\Demande;
use App\Entity\Situation;
use App\Entity\Message;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/theme')]
class ThemeController extends AbstractController
{
    #[Route('/', name: 'app_theme_index', methods: ['GET'])]
    public function index(ThemeRepository $themeRepository): Response
    {
        return $this->render('theme/index.html.twig', [
            'themes' => $themeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_theme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,ThemeRepository $themeRepository): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($theme);
            $entityManager->flush();

            return $this->redirectToRoute('app_theme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('theme/new.html.twig', [
            'theme' => $theme,
            'form' => $form,
            'themes' => $themeRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_theme_show', methods: ['GET'])]
    public function show(Theme $theme,EntityManagerInterface $entityManager): Response
    {
        // 'demandes' => $demandeRepository->findAll();
        // 'demandes' => $demandeRepository->findAll();
        
        $repositoryD = $entityManager->getRepository(Demande::class);
        $demandes = $repositoryD->findBy(['theme' => $theme], [], 5);
        // dd($demandes);
        
        $repositoryS = $entityManager->getRepository(Situation::class);
        $situations = [];
        $repositoryM = $entityManager->getRepository(Message::class);
        foreach ($demandes as $demande){

            // dd($demande);
            $sit = $repositoryS->findBy(['demande' => $demande], ['id'=>'ASC'], 5);
            $situs = [];
            foreach ($sit as $value) {
                // dd($value);
                $messages = $repositoryM->findBy(['situation' => $value], ['id'=>'ASC'], 1);
                // dd($messages);
                $situs[$value->getTexte()] = [
                    'situation' => $value,
                    'message' => $messages,
                ];
                // dd($situs);
            }
            $situations[$demande->getTexte()] = [
                'demande' => $demande,
                'situations' => $situs,
            ];
        }
        // dd($situations);
        // $messages = [];
        // foreach ($situations as $situation){
        //     dd($situation);
        //     $messages[$situation->getIdentifiant()] = [];
        //     foreach ($situation as $sit){

        //         $messages[$situation->getIdentifiant()][$sit->getIdentifiant()] = $repositoryM->findBy(['situation' => $sit], [], 5);
            
        //     }
        // }
        // $messages
        
        
        // $messages = $repositoryM->findBy(['situation' => $situations], [], 5);

        return $this->render('theme/show.html.twig', [
            'theme' => $theme,
            'demandes' => $demandes,
            'situations' => $situations,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_theme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Theme $theme, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_theme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('theme/edit.html.twig', [
            'theme' => $theme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_theme_delete', methods: ['POST'])]
    public function delete(Request $request, Theme $theme, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theme->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($theme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_theme_index', [], Response::HTTP_SEE_OTHER);
    }
}
