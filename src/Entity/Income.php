<?php

namespace App\Entity;

use App\Repository\IncomeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IncomeRepository::class)
 */
class Income
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateIncome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryIncome::class, inversedBy="incomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryIncome;

    /**
     * @ORM\ManyToOne(targetEntity=Donor::class, inversedBy="incomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $donor;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="incomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateIncome(): ?\DateTimeInterface
    {
        return $this->dateIncome;
    }

    public function setDateIncome(\DateTimeInterface $dateIncome): self
    {
        $this->dateIncome = $dateIncome;

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCategoryIncome(): ?CategoryIncome
    {
        return $this->categoryIncome;
    }

    public function setCategoryIncome(?CategoryIncome $categoryIncome): self
    {
        $this->categoryIncome = $categoryIncome;

        return $this;
    }

    public function getDonor(): ?Donor
    {
        return $this->donor;
    }

    public function setDonor(?Donor $donor): self
    {
        $this->donor = $donor;

        return $this;
    }

    public function getEditor(): ?User
    {
        return $this->editor;
    }

    public function setEditor(?User $editor): self
    {
        $this->editor = $editor;

        return $this;
    }
}
