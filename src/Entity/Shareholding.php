<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShareholdingRepository")
 */
class Shareholding
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $OwningPercentage;

    /**
     * @ORM\Column(type="date")
     */
    private $OwningDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Corporate", inversedBy="shareholdings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $OwningCorporate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Corporate", inversedBy="CorporateShareholders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $OwnedCorporate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwningPercentage(): ?float
    {
        return $this->OwningPercentage;
    }

    public function setOwningPercentage(float $OwningPercentage): self
    {
        $this->OwningPercentage = $OwningPercentage;

        return $this;
    }

    public function getOwningDate(): ?\DateTimeInterface
    {
        return $this->OwningDate;
    }

    public function setOwningDate(\DateTimeInterface $OwningDate): self
    {
        $this->OwningDate = $OwningDate;

        return $this;
    }

    public function getOwningCorporate(): ?Corporate
    {
        return $this->OwningCorporate;
    }

    public function setOwningCorporate(?Corporate $OwningCorporate): self
    {
        $this->OwningCorporate = $OwningCorporate;

        return $this;
    }

    public function getOwnedCorporate(): ?Corporate
    {
        return $this->OwnedCorporate;
    }

    public function setOwnedCorporate(?Corporate $OwnedCorporate): self
    {
        $this->OwnedCorporate = $OwnedCorporate;

        return $this;
    }
}
