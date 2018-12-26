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
     * @ORM\ManyToOne(targetEntity="App\Entity\Corporate", inversedBy="ComptesDeResultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Corporate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $year;


    /***********************
      Début du compte de résultat
    ************************/


    /**
     * @ORM\Column(type="integer")
     */
    private $VenteMarchandises;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProductionVendueDeServices;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChiffresAffairesNet;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProductionImmobilisee;

    /**
     * @ORM\Column(type="integer")
     */
    private $SubventionsExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $RepriseDepreciationProvisionsTransfertCharges;

    /**
     * @ORM\Column(type="integer")
     */
    private $AutresProduits;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitsExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $AchatsDeMarchandises;

    /**
     * @ORM\Column(type="integer")
     */
    private $AutresAchatEtChargesExternes;

    /**
     * @ORM\Column(type="integer")
     */
    private $ImpotTaxesEtVersementsAssimiles;

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
    private $DotationAmortissementImmobilisations;

    /**
     * @ORM\Column(type="integer")
     */
    private $DotationDepreciationImmobilisations;

    /**
     * @ORM\Column(type="integer")
     */
    private $DotationDepreciationActifCirculant;

    /**
     * @ORM\Column(type="integer")
     */
    private $DotationProvisions;

    /**
     * @ORM\Column(type="integer")
     */
    private $AutresCharges;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $ResultatExploitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitsFinanciersParticipations;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitsAutresValeursMobiliereEtCreancesActifImmobilise;

    /**
     * @ORM\Column(type="integer")
     */
    private $AutreInteretEtProduitAssimile;

    /**
     * @ORM\Column(type="integer")
     */
    private $RepriseDepreciationEtProvisionTransfertsCharges;

    /**
     * @ORM\Column(type="integer")
     */
    private $DifferencesPositivesChange;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitsFinanciers;

    /**
     * @ORM\Column(type="integer")
     */
    private $DotationsFinancieresAmortissementDepreciationProvision;

    /**
     * @ORM\Column(type="integer")
     */
    private $InteretEtChargeAssimilees;

    /**
     * @ORM\Column(type="integer")
     */
    private $DifferenceNegativeChange;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesNetteCessionValeurMobiliereDePlacement;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesFinancieres;

    /**
     * @ORM\Column(type="integer")
     */
    private $ResultatFinancier;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitExceptionnelOperationGestion;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitExceptionnelOperationCapital;

    /**
     * @ORM\Column(type="integer")
     */
    private $RepriseDepreciationProvisionTransfertCharge;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesExceptionnelleOperationGestion;

    /**
     * @ORM\Column(type="integer")
     */
    private $ChargesExceptionnelleOperationCapital;

    /**
     * @ORM\Column(type="integer")
     */
    private $DotationExceptionnelleAmortissementDepreciationProvision;

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

    /**
     * @ORM\Column(type="integer")
     */
    private $Benefice;

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

    public function getVenteMarchandises(): ?int
    {
        return $this->VenteMarchandises;
    }

    public function setVenteMarchandises(int $VenteMarchandises): self
    {
        $this->VenteMarchandises = $VenteMarchandises;

        return $this;
    }

    public function getProductionVendueDeServices(): ?int
    {
        return $this->ProductionVendueDeServices;
    }

    public function setProductionVendueDeServices(int $ProductionVendueDeServices): self
    {
        $this->ProductionVendueDeServices = $ProductionVendueDeServices;

        return $this;
    }

    public function getProductionImmobilisee(): ?int
    {
        return $this->ProductionImmobilisee;
    }

    public function setProductionImmobilisee(int $ProductionImmobilisee): self
    {
        $this->ProductionImmobilisee = $ProductionImmobilisee;

        return $this;
    }

    public function getRepriseDepreciationProvisionsTransfertCharges(): ?int
    {
        return $this->RepriseDepreciationProvisionsTransfertCharges;
    }

    public function setRepriseDepreciationProvisionsTransfertCharges(int $RepriseDepreciationProvisionsTransfertCharges): self
    {
        $this->RepriseDepreciationProvisionsTransfertCharges = $RepriseDepreciationProvisionsTransfertCharges;

        return $this;
    }

    public function getAutresProduits(): ?int
    {
        return $this->AutresProduits;
    }

    public function setAutresProduits(int $AutresProduits): self
    {
        $this->AutresProduits = $AutresProduits;

        return $this;
    }

    public function getAutresAchatEtChargesExternes(): ?int
    {
        return $this->AutresAchatEtChargesExternes;
    }

    public function setAutresAchatEtChargesExternes(int $AutresAchatEtChargesExternes): self
    {
        $this->AutresAchatEtChargesExternes = $AutresAchatEtChargesExternes;

        return $this;
    }

    public function getDotationAmortissementImmobilisations(): ?int
    {
        return $this->DotationAmortissementImmobilisations;
    }

    public function setDotationAmortissementImmobilisations(int $DotationAmortissementImmobilisations): self
    {
        $this->DotationAmortissementImmobilisations = $DotationAmortissementImmobilisations;

        return $this;
    }

    public function getDotationDepreciationImmobilisations(): ?int
    {
        return $this->DotationDepreciationImmobilisations;
    }

    public function setDotationDepreciationImmobilisations(int $DotationDepreciationImmobilisations): self
    {
        $this->DotationDepreciationImmobilisations = $DotationDepreciationImmobilisations;

        return $this;
    }

    public function getDotationDepreciationActifCirculant(): ?int
    {
        return $this->DotationDepreciationActifCirculant;
    }

    public function setDotationDepreciationActifCirculant(int $DotationDepreciationActifCirculant): self
    {
        $this->DotationDepreciationActifCirculant = $DotationDepreciationActifCirculant;

        return $this;
    }

    public function getDotationProvisions(): ?int
    {
        return $this->DotationProvisions;
    }

    public function setDotationProvisions(int $DotationProvisions): self
    {
        $this->DotationProvisions = $DotationProvisions;

        return $this;
    }

    public function getAutresCharges(): ?int
    {
        return $this->AutresCharges;
    }

    public function setAutresCharges(int $AutresCharges): self
    {
        $this->AutresCharges = $AutresCharges;

        return $this;
    }

    public function getProduitsFinanciersParticipations(): ?int
    {
        return $this->ProduitsFinanciersParticipations;
    }

    public function setProduitsFinanciersParticipations(int $ProduitsFinanciersParticipations): self
    {
        $this->ProduitsFinanciersParticipations = $ProduitsFinanciersParticipations;

        return $this;
    }

    public function getProduitsAutresValeursMobiliereEtCreancesActifImmobilise(): ?int
    {
        return $this->ProduitsAutresValeursMobiliereEtCreancesActifImmobilise;
    }

    public function setProduitsAutresValeursMobiliereEtCreancesActifImmobilise(int $ProduitsAutresValeursMobiliereEtCreancesActifImmobilise): self
    {
        $this->ProduitsAutresValeursMobiliereEtCreancesActifImmobilise = $ProduitsAutresValeursMobiliereEtCreancesActifImmobilise;

        return $this;
    }

    public function getRepriseDepreciationEtProvisionTransfertsCharges(): ?int
    {
        return $this->RepriseDepreciationEtProvisionTransfertsCharges;
    }

    public function setRepriseDepreciationEtProvisionTransfertsCharges(int $RepriseDepreciationEtProvisionTransfertsCharges): self
    {
        $this->RepriseDepreciationEtProvisionTransfertsCharges = $RepriseDepreciationEtProvisionTransfertsCharges;

        return $this;
    }

    public function getDifferencesPositivesChange(): ?int
    {
        return $this->DifferencesPositivesChange;
    }

    public function setDifferencesPositivesChange(int $DifferencesPositivesChange): self
    {
        $this->DifferencesPositivesChange = $DifferencesPositivesChange;

        return $this;
    }

    public function getDotationsFinancieresAmortissementDepreciationProvision(): ?int
    {
        return $this->DotationsFinancieresAmortissementDepreciationProvision;
    }

    public function setDotationsFinancieresAmortissementDepreciationProvision(int $DotationsFinancieresAmortissementDepreciationProvision): self
    {
        $this->DotationsFinancieresAmortissementDepreciationProvision = $DotationsFinancieresAmortissementDepreciationProvision;

        return $this;
    }

    public function getInteretEtChargeAssimilees(): ?int
    {
        return $this->InteretEtChargeAssimilees;
    }

    public function setInteretEtChargeAssimilees(int $InteretEtChargeAssimilees): self
    {
        $this->InteretEtChargeAssimilees = $InteretEtChargeAssimilees;

        return $this;
    }

    public function getDifferenceNegativeChange(): ?int
    {
        return $this->DifferenceNegativeChange;
    }

    public function setDifferenceNegativeChange(int $DifferenceNegativeChange): self
    {
        $this->DifferenceNegativeChange = $DifferenceNegativeChange;

        return $this;
    }

    public function getChargesNetteCessionValeurMobiliereDePlacement(): ?int
    {
        return $this->ChargesNetteCessionValeurMobiliereDePlacement;
    }

    public function setChargesNetteCessionValeurMobiliereDePlacement(int $ChargesNetteCessionValeurMobiliereDePlacement): self
    {
        $this->ChargesNetteCessionValeurMobiliereDePlacement = $ChargesNetteCessionValeurMobiliereDePlacement;

        return $this;
    }

    public function getProduitExceptionnelOperationGestion(): ?int
    {
        return $this->ProduitExceptionnelOperationGestion;
    }

    public function setProduitExceptionnelOperationGestion(int $ProduitExceptionnelOperationGestion): self
    {
        $this->ProduitExceptionnelOperationGestion = $ProduitExceptionnelOperationGestion;

        return $this;
    }

    public function getProduitExceptionnelOperationCapital(): ?int
    {
        return $this->ProduitExceptionnelOperationCapital;
    }

    public function setProduitExceptionnelOperationCapital(int $ProduitExceptionnelOperationCapital): self
    {
        $this->ProduitExceptionnelOperationCapital = $ProduitExceptionnelOperationCapital;

        return $this;
    }

    public function getRepriseDepreciationProvisionTransfertCharge(): ?int
    {
        return $this->RepriseDepreciationProvisionTransfertCharge;
    }

    public function setRepriseDepreciationProvisionTransfertCharge(int $RepriseDepreciationProvisionTransfertCharge): self
    {
        $this->RepriseDepreciationProvisionTransfertCharge = $RepriseDepreciationProvisionTransfertCharge;

        return $this;
    }

    public function getChargesExceptionnelleOperationGestion(): ?int
    {
        return $this->ChargesExceptionnelleOperationGestion;
    }

    public function setChargesExceptionnelleOperationGestion(int $ChargesExceptionnelleOperationGestion): self
    {
        $this->ChargesExceptionnelleOperationGestion = $ChargesExceptionnelleOperationGestion;

        return $this;
    }

    public function getChargesExceptionnelleOperationCapital(): ?int
    {
        return $this->ChargesExceptionnelleOperationCapital;
    }

    public function setChargesExceptionnelleOperationCapital(int $ChargesExceptionnelleOperationCapital): self
    {
        $this->ChargesExceptionnelleOperationCapital = $ChargesExceptionnelleOperationCapital;

        return $this;
    }

    public function getDotationExceptionnelleAmortissementDepreciationProvision(): ?int
    {
        return $this->DotationExceptionnelleAmortissementDepreciationProvision;
    }

    public function setDotationExceptionnelleAmortissementDepreciationProvision(int $DotationExceptionnelleAmortissementDepreciationProvision): self
    {
        $this->DotationExceptionnelleAmortissementDepreciationProvision = $DotationExceptionnelleAmortissementDepreciationProvision;

        return $this;
    }

    public function getBenefice(): ?int
    {
        return $this->Benefice;
    }

    public function setBenefice(int $Benefice): self
    {
        $this->Benefice = $Benefice;

        return $this;
    }

    public function getAutreInteretEtProduitAssimile(): ?int
    {
        return $this->AutreInteretEtProduitAssimile;
    }

    public function setAutreInteretEtProduitAssimile(int $AutreInteretEtProduitAssimile): self
    {
        $this->AutreInteretEtProduitAssimile = $AutreInteretEtProduitAssimile;

        return $this;
    }
}
