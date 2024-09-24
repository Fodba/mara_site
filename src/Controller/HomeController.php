<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MediumRepository;
use App\Repository\HeaderRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(MediumRepository $mediumRepository, HeaderRepository $headerRepository): Response
    {
        $mediums = $mediumRepository->findAll();
        if (count($mediums)>0){
            $medium = $mediums[0];
        }
        else{
            $medium = null;
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'medium' => $medium,
            'headers' => $headerRepository->findAll(),
        ]);
    }
}
