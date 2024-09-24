<?php

namespace App\Entity;

use App\Repository\HeaderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeaderRepository::class)]
class Header
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $texte1 = null;

    #[ORM\Column(length: 255)]
    private ?string $texte2 = null;

    #[ORM\ManyToOne(inversedBy: 'headers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medium $medium = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte1(): ?string
    {
        return $this->texte1;
    }

    public function setTexte1(string $texte1): static
    {
        $this->texte1 = $texte1;

        return $this;
    }

    public function getTexte2(): ?string
    {
        return $this->texte2;
    }

    public function setTexte2(string $texte2): static
    {
        $this->texte2 = $texte2;

        return $this;
    }

    public function getMedium(): ?Medium
    {
        return $this->medium;
    }

    public function setMedium(?Medium $medium): static
    {
        $this->medium = $medium;

        return $this;
    }
}
