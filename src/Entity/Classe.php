<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Esprit", mappedBy="classe")
     */
    private $esprits;

    public function __construct()
    {
        $this->esprits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

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
    public function __toString()
    {
      return $this->name;
    }

    /**
     * @return Collection|Esprit[]
     */
    public function getEsprits(): Collection
    {
        return $this->esprits;
    }

    public function addEsprit(Esprit $esprit): self
    {
        if (!$this->esprits->contains($esprit)) {
            $this->esprits[] = $esprit;
            $esprit->setClasses($this);
        }

        return $this;
    }

    public function removeEsprit(Esprit $esprit): self
    {
        if ($this->esprits->contains($esprit)) {
            $this->esprits->removeElement($esprit);
            // set the owning side to null (unless already changed)
            if ($esprit->getClasses() === $this) {
                $esprit->setClasses(null);
            }
        }

        return $this;
    }
}
