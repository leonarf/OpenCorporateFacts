<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CompteDeResultat;
use App\Entity\Corporate;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CompteDeResultatController extends AbstractController
{
    /**
     * @Route("/add_compte_de_resultat", name="add_compte_de_resultat")
     */
    public function add(Request $request)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $newCompteDeResultat = new CompteDeResultat();

        $form = $this->buildForm($newCompteDeResultat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newCompteDeResultat = $form->getData();
            $entityManager->persist($newCompteDeResultat);
            $entityManager->flush();
        }

        return $this->render('compte_de_resultat/add.html.twig', [
            'controller_name' => 'CompteDeResultatController',
            'addForm' => $form->createView(),
        ]);
    }

    public function buildForm(CompteDeResultat $compteDeResultat)
    {
      return $this->createFormBuilder($compteDeResultat)
                  ->add('Corporate', EntityType::class, array(
                        // looks for choices from this entity
                        'class' => Corporate::class,
                        // uses the Corporate.Name property as the visible option string
                        'choice_label' => 'Name',
                        ))
                  ->add('year')
                  ->add('VenteMarchandises')
                  ->add('ProductionVendueDeServices')
                  ->add('ChiffresAffairesNet')
                  ->add('ProductionImmobilisee')
                  ->add('SubventionsExploitation')
                  ->add('RepriseDepreciationProvisionsTransfertCharges')
                  ->add('AutresProduits')
                  ->add('ProduitsExploitation')
                  ->add('AchatsDeMarchandises')
                  ->add('AchatMatierePremiereAutreAppro')
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
                  ->add('save', SubmitType::class)
                  ->getForm();
    }
}
