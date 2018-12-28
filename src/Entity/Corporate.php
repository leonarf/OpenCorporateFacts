<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CorporateRepository")
 */
class Corporate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompteDeResultat", mappedBy="Corporate", orphanRemoval=true)
     */
    private $ComptesDeResultats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OpenCorporateURL;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $CompanyNumber;

    public function __construct()
    {
        $this->ComptesDeResultats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|CompteDeResultat[]
     */
    public function getComptesDeResultats(): Collection
    {
        return $this->ComptesDeResultats;
    }

    public function addComptesDeResultat(CompteDeResultat $comptesDeResultat): self
    {
        if (!$this->ComptesDeResultats->contains($comptesDeResultat)) {
            $this->ComptesDeResultats[] = $comptesDeResultat;
            $comptesDeResultat->setCorporate($this);
        }

        return $this;
    }

    public function removeComptesDeResultat(CompteDeResultat $comptesDeResultat): self
    {
        if ($this->ComptesDeResultats->contains($comptesDeResultat)) {
            $this->ComptesDeResultats->removeElement($comptesDeResultat);
            // set the owning side to null (unless already changed)
            if ($comptesDeResultat->getCorporate() === $this) {
                $comptesDeResultat->setCorporate(null);
            }
        }

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(?string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function __toString()
    {
       return $this->Name;
    }

    public function getOpenCorporateURL(): ?string
    {
        return $this->OpenCorporateURL;
    }

    public function setOpenCorporateURL(string $OpenCorporateURL): self
    {
        $this->OpenCorporateURL = $OpenCorporateURL;

        return $this;
    }

    public function getCompanyNumber(): ?string
    {
        return $this->CompanyNumber;
    }

    public function setCompanyNumber(string $CompanyNumber): self
    {
        $this->CompanyNumber = $CompanyNumber;

        return $this;
    }
}
