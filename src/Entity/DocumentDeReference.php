<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentDeReferenceRepository")
 */
class DocumentDeReference
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChiffreAffaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $BeneficesGroupe;

    /**
     * @ORM\Column(type="integer")
     */
    private $Dividend;

    /**
     * @ORM\Column(type="integer")
     */
    private $SalaireMoyen;

    /**
     * @ORM\Column(type="integer")
     */
    private $OnProfitTaxPaid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Corporate", inversedBy="documentDeReferences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Corporation;

    /**
     * @ORM\Column(type="date")
     */
    private $Year;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChiffreAffaire(): ?int
    {
        return $this->ChiffreAffaire;
    }

    public function setChiffreAffaire(int $ChiffreAffaire): self
    {
        $this->ChiffreAffaire = $ChiffreAffaire;

        return $this;
    }

    public function getBeneficesGroupe(): ?int
    {
        return $this->BeneficesGroupe;
    }

    public function setBeneficesGroupe(int $BeneficesGroupe): self
    {
        $this->BeneficesGroupe = $BeneficesGroupe;

        return $this;
    }

    public function getDividend(): ?int
    {
        return $this->Dividend;
    }

    public function setDividend(int $Dividend): self
    {
        $this->Dividend = $Dividend;

        return $this;
    }

    public function getSalaireMoyen(): ?int
    {
        return $this->SalaireMoyen;
    }

    public function setSalaireMoyen(int $SalaireMoyen): self
    {
        $this->SalaireMoyen = $SalaireMoyen;

        return $this;
    }

    public function getOnProfitTaxPaid(): ?int
    {
        return $this->OnProfitTaxPaid;
    }

    public function setOnProfitTaxPaid(int $OnProfitTaxPaid): self
    {
        $this->OnProfitTaxPaid = $OnProfitTaxPaid;

        return $this;
    }

    public function getCorporation(): ?Corporate
    {
        return $this->Corporation;
    }

    public function setCorporation(?Corporate $Corporation): self
    {
        $this->Corporation = $Corporation;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->Year;
    }

    public function setYear(\DateTimeInterface $Year): self
    {
        $this->Year = $Year;

        return $this;
    }
}
