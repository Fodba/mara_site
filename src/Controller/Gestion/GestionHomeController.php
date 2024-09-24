<?php

namespace App\Controller\Gestion;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MediumRepository;
use App\Repository\HeaderRepository;

class GestionHomeController extends AbstractController
{
    #[Route('/gestion', name: 'app_gestion')]
    public function index(MediumRepository $mediumRepository, HeaderRepository $headerRepository): Response
    {
        $mediums = $mediumRepository->findAll();
        if (count($mediums)>0){
            $medium = $mediums[0];
        }
        else{
            $medium = null;
        }
        return $this->render('gestion/base.html.twig', [
            'controller_name' => 'GestionHomeController',
            'medium' => $medium,
            'headers' => $headerRepository->findAll(),
        ]);
    }
}
