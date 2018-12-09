<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteDeResultatRepository")
 */
class CompteDeResultat
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
    private $ChiffresAffairesNet;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitsExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $SalairesEtTraitements;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesSociales;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesFinancieres;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitsFinanciers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Corporate", inversedBy="ComptesDeResultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Corporate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $ImpotTaxesEtVersementsAssimiles;

    /**
     * @ORM\Column(type="integer")
     */
    private $SubventionsExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $AchatsDeMarchandises;

    /**
     * @ORM\Column(type="integer")
     */
    private $ResultatExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $ResultatFinancier;

    /**
     * @ORM\Column(type="integer")
     */
    private $ResultatExceptionnel;

    /**
     * @ORM\Column(type="integer")
     */
    private $ParticipationSalariesAuxResultats;

    /**
     * @ORM\Column(type="integer")
     */
    private $ImpotsSurLesBenefices;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChiffresAffairesNet(): ?int
    {
        return $this->ChiffresAffairesNet;
    }

    public function setChiffresAffairesNet(int $ChiffresAffairesNet): self
    {
        $this->ChiffresAffairesNet = $ChiffresAffairesNet;

        return $this;
    }

    public function getProduitsExploitation(): ?int
    {
        return $this->ProduitsExploitation;
    }

    public function setProduitsExploitation(int $ProduitsExploitation): self
    {
        $this->ProduitsExploitation = $ProduitsExploitation;

        return $this;
    }

    public function getSalairesEtTraitements(): ?int
    {
        return $this->SalairesEtTraitements;
    }

    public function setSalairesEtTraitements(int $SalairesEtTraitements): self
    {
        $this->SalairesEtTraitements = $SalairesEtTraitements;

        return $this;
    }

    public function getChargesSociales(): ?int
    {
        return $this->ChargesSociales;
    }

    public function setChargesSociales(int $ChargesSociales): self
    {
        $this->ChargesSociales = $ChargesSociales;

        return $this;
    }

    public function getChargesExploitation(): ?int
    {
        return $this->ChargesExploitation;
    }

    public function setChargesExploitation(int $ChargesExploitation): self
    {
        $this->ChargesExploitation = $ChargesExploitation;

        return $this;
    }

    public function getChargesFinancieres(): ?int
    {
        return $this->ChargesFinancieres;
    }

    public function setChargesFinancieres(int $ChargesFinancieres): self
    {
        $this->ChargesFinancieres = $ChargesFinancieres;

        return $this;
    }

    public function getProduitsFinanciers(): ?int
    {
        return $this->ProduitsFinanciers;
    }

    public function setProduitsFinanciers(int $ProduitsFinanciers): self
    {
        $this->ProduitsFinanciers = $ProduitsFinanciers;

        return $this;
    }

    public function getCorporate(): ?Corporate
    {
        return $this->Corporate;
    }

    public function setCorporate(?Corporate $Corporate): self
    {
        $this->Corporate = $Corporate;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getImpotTaxesEtVersementsAssimiles(): ?int
    {
        return $this->ImpotTaxesEtVersementsAssimiles;
    }

    public function setImpotTaxesEtVersementsAssimiles(int $ImpotTaxesEtVersementsAssimiles): self
    {
        $this->ImpotTaxesEtVersementsAssimiles = $ImpotTaxesEtVersementsAssimiles;

        return $this;
    }

    public function getSubventionsExploitation(): ?int
    {
        return $this->SubventionsExploitation;
    }

    public function setSubventionsExploitation(int $SubventionsExploitation): self
    {
        $this->SubventionsExploitation = $SubventionsExploitation;

        return $this;
    }

    public function getAchatsDeMarchandises(): ?int
    {
        return $this->AchatsDeMarchandises;
    }

    public function setAchatsDeMarchandises(int $AchatsDeMarchandises): self
    {
        $this->AchatsDeMarchandises = $AchatsDeMarchandises;

        return $this;
    }

    public function getResultatExploitation(): ?int
    {
        return $this->ResultatExploitation;
    }

    public function setResultatExploitation(int $ResultatExploitation): self
    {
        $this->ResultatExploitation = $ResultatExploitation;

        return $this;
    }

    public function getResultatFinancier(): ?int
    {
        return $this->ResultatFinancier;
    }

    public function setResultatFinancier(int $ResultatFinancier): self
    {
        $this->ResultatFinancier = $ResultatFinancier;

        return $this;
    }

    public function getResultatExceptionnel(): ?int
    {
        return $this->ResultatExceptionnel;
    }

    public function setResultatExceptionnel(int $ResultatExceptionnel): self
    {
        $this->ResultatExceptionnel = $ResultatExceptionnel;

        return $this;
    }

    public function getParticipationSalariesAuxResultats(): ?int
    {
        return $this->ParticipationSalariesAuxResultats;
    }

    public function setParticipationSalariesAuxResultats(int $ParticipationSalariesAuxResultats): self
    {
        $this->ParticipationSalariesAuxResultats = $ParticipationSalariesAuxResultats;

        return $this;
    }

    public function getImpotsSurLesBenefices(): ?int
    {
        return $this->ImpotsSurLesBenefices;
    }

    public function setImpotsSurLesBenefices(int $ImpotsSurLesBenefices): self
    {
        $this->ImpotsSurLesBenefices = $ImpotsSurLesBenefices;

        return $this;
    }
}
