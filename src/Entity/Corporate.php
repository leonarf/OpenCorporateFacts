<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CorporateRepository")
 * @ApiResource
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
     * @ORM\OneToMany(targetEntity="App\Entity\CompteDeResultat", mappedBy="Corporate", orphanRemoval=true, cascade={"persist"})
     * @ORM\OrderBy({"year" = "ASC"})
     * @Assert\Valid
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shareholding", mappedBy="OwningCorporate")
     */
    private $shareholdings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shareholding", mappedBy="OwnedCorporate")
     */
    private $CorporateShareholders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DocumentDeReference", mappedBy="Corporation", orphanRemoval=true)
     * @ORM\OrderBy({"Year" = "ASC"})
     */
    private $documentDeReferences;

    public function __construct()
    {
        $this->ComptesDeResultats = new ArrayCollection();
        $this->shareholdings = new ArrayCollection();
        $this->CorporateShareholders = new ArrayCollection();
        $this->documentDeReferences = new ArrayCollection();
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
            foreach($this->ComptesDeResultats as $existingCompte){
              if ($existingCompte->getYear() == $comptesDeResultat->getYear())
              {
                return $this; // Do not add multiple compte for the same year
              }
            }
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

    /**
     * @return Collection|Shareholding[]
     */
    public function getShareholdings(): Collection
    {
        return $this->shareholdings;
    }

    public function addShareholding(Shareholding $shareholding): self
    {
        if (!$this->shareholdings->contains($shareholding)) {
            $this->shareholdings[] = $shareholding;
            $shareholding->setOwningCorporate($this);
        }

        return $this;
    }

    public function removeShareholding(Shareholding $shareholding): self
    {
        if ($this->shareholdings->contains($shareholding)) {
            $this->shareholdings->removeElement($shareholding);
            // set the owning side to null (unless already changed)
            if ($shareholding->getOwningCorporate() === $this) {
                $shareholding->setOwningCorporate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Shareholding[]
     */
    public function getCorporateShareholders(): Collection
    {
        return $this->CorporateShareholders;
    }

    public function addCorporateShareholder(Shareholding $corporateShareholder): self
    {
        if (!$this->CorporateShareholders->contains($corporateShareholder)) {
            $this->CorporateShareholders[] = $corporateShareholder;
            $corporateShareholder->setOwnedCorporate($this);
        }

        return $this;
    }

    public function removeCorporateShareholder(Shareholding $corporateShareholder): self
    {
        if ($this->CorporateShareholders->contains($corporateShareholder)) {
            $this->CorporateShareholders->removeElement($corporateShareholder);
            // set the owning side to null (unless already changed)
            if ($corporateShareholder->getOwnedCorporate() === $this) {
                $corporateShareholder->setOwnedCorporate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DocumentDeReference[]
     */
    public function getDocumentDeReferences(): Collection
    {
        return $this->documentDeReferences;
    }

    public function addDocumentDeReference(DocumentDeReference $documentDeReference): self
    {
        if (!$this->documentDeReferences->contains($documentDeReference)) {
            $this->documentDeReferences[] = $documentDeReference;
            $documentDeReference->setCorporation($this);
        }

        return $this;
    }

    public function removeDocumentDeReference(DocumentDeReference $documentDeReference): self
    {
        if ($this->documentDeReferences->contains($documentDeReference)) {
            $this->documentDeReferences->removeElement($documentDeReference);
            // set the owning side to null (unless already changed)
            if ($documentDeReference->getCorporation() === $this) {
                $documentDeReference->setCorporation(null);
            }
        }

        return $this;
    }
}
