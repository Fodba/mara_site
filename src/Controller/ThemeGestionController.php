<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ThemeGestionController extends AbstractController
{
    #[Route('/theme/gestion', name: 'app_theme_gestion')]
    public function index(): Response
    {
        return $this->render('theme_gestion/index.html.twig', [
            'controller_name' => 'ThemeGestionController',
        ]);
    }
}
