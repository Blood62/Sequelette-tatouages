<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalerieRepository")
 * @Vich\Uploadable()
 */
class Galerie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=155)
     */
    private $auteur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptif;


    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes={"image/jpeg", "image/jpg", "image/png"})
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="filename")
     *
     */
    private $imageFile;

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Galerie
     */
    public function setFilename(?string $filename): Galerie
    {
        $this->filename = $filename;
        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }


    /**
     * @ORM\Column(type="datetime")
     * @var null|DateTime
     */
    private $updated_at;

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    /**
     * @param File|null $imageFile
     *
     * @throws Exception
     */
    public function setImageFile( ?File $imageFile ): void {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile){
            $this->updated_at = new DateTime('now');
        }
        //return $this;
    }




}
