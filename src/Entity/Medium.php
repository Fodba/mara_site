<?php

namespace App\Entity;

use App\Repository\MediumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediumRepository::class)]
class Medium
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $photo_texte = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $biographie = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $pratique = null;

    /**
     * @var Collection<int, Header>
     */
    #[ORM\OneToMany(targetEntity: Header::class, mappedBy: 'medium', orphanRemoval: true)]
    private Collection $headers;

    public function __construct()
    {
        $this->headers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhotoTexte(): ?string
    {
        return $this->photo_texte;
    }

    public function setPhotoTexte(string $photo_texte): static
    {
        $this->photo_texte = $photo_texte;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(string $biographie): static
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getPratique(): ?string
    {
        return $this->pratique;
    }

    public function setPratique(string $pratique): static
    {
        $this->pratique = $pratique;

        return $this;
    }

    /**
     * @return Collection<int, Header>
     */
    public function getHeaders(): Collection
    {
        return $this->headers;
    }

    public function addHeader(Header $header): static
    {
        if (!$this->headers->contains($header)) {
            $this->headers->add($header);
            $header->setMedium($this);
        }

        return $this;
    }

    public function removeHeader(Header $header): static
    {
        if ($this->headers->removeElement($header)) {
            // set the owning side to null (unless already changed)
            if ($header->getMedium() === $this) {
                $header->setMedium(null);
            }
        }

        return $this;
    }
}
