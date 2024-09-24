<?php

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Website;
use App\Repository\WebsiteRepository;
use App\Entity\Theme;
use App\Repository\ThemeRepository;
use App\Entity\Medium;
use App\Repository\MediumRepository;

class DatabaseService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getWebsite(): array
    {
        // Effectuez votre requête ici pour récupérer les données
        // par exemple, récupérez les 10 derniers articles du blog
        // $repositoryW = $this->entityManager->getRepository(Website::class);
        // $website = $repositoryW->findBy([], ['name' => 'DESC'], 1);
        $repositoryT = $this->entityManager->getRepository(Theme::class);
        $themes = $repositoryT->findBy([], ['nom' => 'DESC'], 5);
        $repositoryM = $this->entityManager->getRepository(Medium::class);
        $mediums = $repositoryM->findBy([], ['nom' => 'DESC'], 1);
        // dd($medium);
        if (count($mediums)>0){
            $medium = $mediums[0];
        }
        else{
            $medium = null;
        }

        return [
            // 'website' => $website[0],
            'medium' => $medium,
            'themes' => $themes,
        ];
    }

    // public function getWebsite(EntityManagerInterface $entityManager): Website
    // {
    //     $websites = $websiteRepository->findAll();
    //     return $websites[0];
        
    //     // These methods also return the default entity manager, but it's preferred
    //     // to get it by injecting EntityManagerInterface in the action method
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $entityManager = $this->getDoctrine()->getManager('default');
    //     $entityManager = $this->get('doctrine.orm.default_entity_manager');

    //     // Both of these return the "customer" entity manager
    //     $customerEntityManager = $this->getDoctrine()->getManager('customer');
    //     $customerEntityManager = $this->get('doctrine.orm.customer_entity_manager');
    // }

    
}