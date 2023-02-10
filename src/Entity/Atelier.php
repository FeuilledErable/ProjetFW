<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?User $instructeur = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'ateliers_suivis')]
    private Collection $apprentis;

    public function __construct()
    {
        $this->apprentis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInstructeur(): ?User
    {
        return $this->instructeur;
    }

    public function setInstructeur(?User $instructeur): self
    {
        $this->instructeur = $instructeur;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getApprentis(): Collection
    {
        return $this->apprentis;
    }

    public function addApprenti(User $apprenti): self
    {
        if (!$this->apprentis->contains($apprenti)) {
            $this->apprentis->add($apprenti);
            $apprenti->addAteliersSuivi($this);
        }

        return $this;
    }

    public function removeApprenti(User $apprenti): self
    {
        if ($this->apprentis->removeElement($apprenti)) {
            $apprenti->removeAteliersSuivi($this);
        }

        return $this;
    }
}
