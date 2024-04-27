<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $matiere = null;

    private ?float $noteMoy = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: AvisProduit::class)]
    private Collection $avisProduits;

    public function __construct()
    {
        $this->avisProduits = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getNoteMoy(): ?float
    {
        return $this->noteMoy;
    }

    public function setNoteMoy(?float $noteMoy): void
    {
        $this->noteMoy = $noteMoy;
    }


    /**
     * @return Collection<int, AvisProduit>
     */
    public function getAvisProduits(): Collection
    {
        return $this->avisProduits;
    }

    public function addAvisProduit(AvisProduit $avisProduit): static
    {
        if (!$this->avisProduits->contains($avisProduit)) {
            $this->avisProduits->add($avisProduit);
            $avisProduit->setProduit($this);
        }

        return $this;
    }

    public function removeAvisProduit(AvisProduit $avisProduit): static
    {
        if ($this->avisProduits->removeElement($avisProduit)) {
            // set the owning side to null (unless already changed)
            if ($avisProduit->getProduit() === $this) {
                $avisProduit->setProduit(null);
            }
        }

        return $this;
    }
}
