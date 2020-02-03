<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SortRepository")
 */
class Sort
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
     * @ORM\Column(type="text")
     * @ORM\JoinColumn(nullable=false)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Esprit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $esprit;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getEsprit(): ?Esprit
    {
        return $this->esprit;
    }

    public function setEsprit(?Esprit $esprit): self
    {
        $this->esprit = $esprit;

        return $this;
    }
}
