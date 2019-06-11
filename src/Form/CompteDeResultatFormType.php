<?php

namespace App\Form;

use App\Entity\CompteDeResultat;
use App\Entity\Corporate;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CompteDeResultatFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder->add('Corporate', EntityType::class, array(
                    // looks for choices from this entity
                    'class' => Corporate::class,
                    // uses the Corporate.Name property as the visible option string
                    'choice_label' => 'Name',
                    ))
              ->add('year')
              ->add('VenteMarchandises')
              ->add('ProductionVendueDeBiens')
              ->add('ProductionVendueDeServices')
              ->add('ChiffresAffairesNet')
              ->add('ProductionStocked')
              ->add('ProductionImmobilisee')
              ->add('SubventionsExploitation')
              ->add('RepriseDepreciationProvisionsTransfertCharges')
              ->add('AutresProduits')
              ->add('ProduitsExploitation')
              ->add('AchatsDeMarchandises')
              ->add('VariationStockMarchandise')
              ->add('AchatMatierePremiereAutreAppro')
              ->add('VariationStockMatierePremiereEtAppro')
              ->add('AutresAchatEtChargesExternes')
              ->add('ImpotTaxesEtVersementsAssimiles')
              ->add('SalairesEtTraitements')
              ->add('ChargesSociales')
              ->add('DotationAmortissementImmobilisations')
              ->add('DotationDepreciationImmobilisations')
              ->add('DotationDepreciationActifCirculant')
              ->add('DotationProvisions')
              ->add('AutresCharges')
              ->add('ChargesExploitation')
              ->add('ResultatExploitation')
              ->add('ProduitsFinanciersParticipations')
              ->add('ProduitsAutresValeursMobiliereEtCreancesActifImmobilise')
              ->add('AutreInteretEtProduitAssimile')
              ->add('RepriseDepreciationEtProvisionTransfertsCharges')
              ->add('DifferencesPositivesChange')
              ->add('ProduitsNetsCessionsValeursMobilesPlacement')
              ->add('ProduitsFinanciers')
              ->add('DotationsFinancieresAmortissementDepreciationProvision')
              ->add('InteretEtChargeAssimilees')
              ->add('DifferenceNegativeChange')
              ->add('ChargesNetteCessionValeurMobiliereDePlacement')
              ->add('ChargesFinancieres')
              ->add('ResultatFinancier')
              ->add('ProduitExceptionnelOperationGestion')
              ->add('ProduitExceptionnelOperationCapital')
              ->add('RepriseDepreciationProvisionTransfertCharge')
              ->add('ChargesExceptionnelleOperationGestion')
              ->add('ChargesExceptionnelleOperationCapital')
              ->add('DotationExceptionnelleAmortissementDepreciationProvision')
              ->add('ResultatExceptionnel')
              ->add('ParticipationSalariesAuxResultats')
              ->add('ImpotsSurLesBenefices')
              ->add('Benefice')
              ->add('EffectifsMoyens')
              ->add('Dividende')
              ->add('save', SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'data_class' => CompteDeResultat::class,
      ]);
  }
}
