<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 * @Vich\Uploadable
 */
class Images
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
    private $imagesName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $imagesSize;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="products_image_articles", fileNameProperty="imagesName", size="imagesSize")
     *
     * @var File
     */
    private $imageFile;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagesName(): ?string
    {
        return $this->imagesName ?? 'dddd';
    }

    public function setImagesName(?string $imagesName = null): self
    {
        $this->imagesName = $imagesName;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getImagesSize(): ?int
    {
        return $this->imagesSize;
    }

    public function setImagesSize(?int $imagesSize = null): self
    {
        $this->imagesSize = $imagesSize;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            //$this->setImagesName('rrrr');

            // on provoque l'upload
            $this->updateAt = new \DateTimeImmutable();
        }
    }
    /*
    public function __toString()
    {
        return $this->imagesName ;
    }*/
}
