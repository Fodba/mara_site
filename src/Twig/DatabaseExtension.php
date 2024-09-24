<?php

// src/Twig/DatabaseExtension.php

namespace App\Twig;

use App\Service\DatabaseService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DatabaseExtension extends AbstractExtension
{
    private $databaseService;

    public function __construct(DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_website', [$this, 'getWebsite']),
        ];
    }

    public function getWebsite(): array
    {
        return $this->databaseService->getWebsite();
    }
    
}