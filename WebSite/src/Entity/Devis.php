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
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 * @Vich\Uploadable()
 */
class Devis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }


    /**
     * @param DateTime|null $updated_at
     */
    public function setUpdatedAt(?DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }


    /**
     * @param string|null $filename
     * @return Devis
     */
    public function setFilename(?string $filename): Devis
    {
        $this->filename = $filename;
        return $this;
    }


    /**
     * @ORM\Column(type="integer")
     */
    private $Temp;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Corp", inversedBy="devis")
     */
    private $PartieCorp;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Commentaire;

    /**
     * Devis constructor.
     * @throws Exception
     */
    public function __construct()
{
    $this->updated_at= new DateTime('now');
}

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return int|null
     */
    public function getTemp(): ?int
    {
        return $this->Temp;
    }


    /**
     * @param int $Temp
     * @return $this
     */
    public function setTemp(int $Temp): self
    {
        $this->Temp = $Temp;

        return $this;
    }


    /**
     * @return Corp|null
     */
    public function getPartieCorp(): ?Corp
    {
        return $this->PartieCorp;
    }


    /**
     * @param Corp|null $PartieCorp
     * @return $this
     */
    public function setPartieCorp(?Corp $PartieCorp): self
    {
        $this->PartieCorp = $PartieCorp;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }


    /**
     * @param string|null $Commentaire
     * @return $this
     */
    public function setCommentaire(?string $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }


    /**
     * @ORM\Column(type="datetime")
     * @var null|DateTime
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TarifHoraire", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Tarifhoraire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact;


    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    /**
     * @param File|null $imageFile
     * @throws Exception
     */
    public function setImageFile(?File $imageFile ): void {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile){
            $this->updated_at = new DateTime('now');
        }
        //return $this;
    }


    /**
     * @return TarifHoraire|null
     */
    public function getTarifhoraire(): ?TarifHoraire
    {
        return $this->Tarifhoraire;
    }


    /**
     * @param TarifHoraire|null $Tarifhoraire
     * @return $this
     */
    public function setTarifhoraire(?TarifHoraire $Tarifhoraire): self
    {
        $this->Tarifhoraire = $Tarifhoraire;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }


    /**
     * @param string $contact
     * @return $this
     */
    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }




}
