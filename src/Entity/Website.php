<?php

namespace App\Entity;

use App\Repository\WebsiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebsiteRepository::class)]
class Website
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $base_url = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $website_header = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $website_description = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    private ?string $logo_texte = null;

    #[ORM\Column(length: 255)]
    private ?string $admin_email = null;

    #[ORM\Column(length: 255)]
    private ?string $admin_phone = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBaseUrl(): ?string
    {
        return $this->base_url;
    }

    public function setBaseUrl(string $base_url): static
    {
        $this->base_url = $base_url;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWebsiteHeader(): ?string
    {
        return $this->website_header;
    }

    public function setWebsiteHeader(string $website_header): static
    {
        $this->website_header = $website_header;

        return $this;
    }

    public function getWebsiteDescription(): ?string
    {
        return $this->website_description;
    }

    public function setWebsiteDescription(string $website_description): static
    {
        $this->website_description = $website_description;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLogoTexte(): ?string
    {
        return $this->logo_texte;
    }

    public function setLogoTexte(string $logo_texte): static
    {
        $this->logo_texte = $logo_texte;

        return $this;
    }

    public function getAdminEmail(): ?string
    {
        return $this->admin_email;
    }

    public function setAdminEmail(string $admin_email): static
    {
        $this->admin_email = $admin_email;

        return $this;
    }

    public function getAdminPhone(): ?string
    {
        return $this->admin_phone;
    }

    public function setAdminPhone(string $admin_phone): static
    {
        $this->admin_phone = $admin_phone;

        return $this;
    }
}
