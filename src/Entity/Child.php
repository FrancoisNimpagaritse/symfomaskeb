<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChildRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ChildRepository::class)
 * @Vich\Uploadable
 */
class Child
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date")
     */
    private $dateBith;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstnameFather;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastnameFather;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstnameMother;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastnameMother;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeOfBirth;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $communeOfBirth;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $provinceOfBirth;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresseCommune;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresseZone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresseProvince;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="kid_image", fileNameProperty="photo")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $class;

    /**
     * @ORM\Column(type="date")
     */
    private $dateJoined;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $history;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateBith(): ?\DateTimeInterface
    {
        return $this->dateBith;
    }

    public function setDateBith(\DateTimeInterface $dateBith): self
    {
        $this->dateBith = $dateBith;

        return $this;
    }

    public function getFirstnameFather(): ?string
    {
        return $this->firstnameFather;
    }

    public function setFirstnameFather(string $firstnameFather): self
    {
        $this->firstnameFather = $firstnameFather;

        return $this;
    }

    public function getLastnameFather(): ?string
    {
        return $this->lastnameFather;
    }

    public function setLastnameFather(string $lastnameFather): self
    {
        $this->lastnameFather = $lastnameFather;

        return $this;
    }

    public function getFirstnameMother(): ?string
    {
        return $this->firstnameMother;
    }

    public function setFirstnameMother(string $firstnameMother): self
    {
        $this->firstnameMother = $firstnameMother;

        return $this;
    }

    public function getLastnameMother(): ?string
    {
        return $this->lastnameMother;
    }

    public function setLastnameMother(string $lastnameMother): self
    {
        $this->lastnameMother = $lastnameMother;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(?string $placeOfBirth): self
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function getCommuneOfBirth(): ?string
    {
        return $this->communeOfBirth;
    }

    public function setCommuneOfBirth(?string $communeOfBirth): self
    {
        $this->communeOfBirth = $communeOfBirth;

        return $this;
    }

    public function getProvinceOfBirth(): ?string
    {
        return $this->provinceOfBirth;
    }

    public function setProvinceOfBirth(?string $provinceOfBirth): self
    {
        $this->provinceOfBirth = $provinceOfBirth;

        return $this;
    }

    public function getAdresseCommune(): ?string
    {
        return $this->adresseCommune;
    }

    public function setAdresseCommune(string $adresseCommune): self
    {
        $this->adresseCommune = $adresseCommune;

        return $this;
    }

    public function getAdresseZone(): ?string
    {
        return $this->adresseZone;
    }

    public function setAdresseZone(string $adresseZone): self
    {
        $this->adresseZone = $adresseZone;

        return $this;
    }

    public function getAdresseProvince(): ?string
    {
        return $this->adresseProvince;
    }

    public function setAdresseProvince(string $adresseProvince): self
    {
        $this->adresseProvince = $adresseProvince;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getDateJoined(): ?\DateTimeInterface
    {
        return $this->dateJoined;
    }

    public function setDateJoined(\DateTimeInterface $dateJoined): self
    {
        $this->dateJoined = $dateJoined;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  File|null
     */ 
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    /**
     * Set nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @param  File|null  $imageFile  NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  self
     */ 
    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile)
        {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
