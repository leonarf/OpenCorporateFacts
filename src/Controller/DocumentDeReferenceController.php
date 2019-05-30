<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\DocumentDeReference;
use App\Entity\Corporate;
class DocumentDeReferenceController extends AbstractController
{
    /**
     * @Route("/add_documentDeReference", name="add_documentDeReference")
     */
    public function add(Request $request)
    {
        $newDocumentDeReference = new DocumentDeReference();
        $documentDeReferenceForm = $this->createFormBuilder($newDocumentDeReference)
                                        ->add('Corporation', EntityType::class, array(
                                              // looks for choices from this entity
                                              'class' => Corporate::class,
                                              // uses the Corporate.Name property as the visible option string
                                              'choice_label' => 'Name',
                                              ))
                                        ->add('Year', DateType::class, [ 'years' => range(2009,2019)])
                                        ->add('ChiffreAffaire')
                                        ->add('BeneficesGroupe')
                                        ->add('Dividend')
                                        ->add('SalaireMoyen')
                                        ->add('OnProfitTaxPaid')
                                        ->add('save', SubmitType::class)
                                        ->getForm();

        $documentDeReferenceForm->handleRequest($request);

        if ($documentDeReferenceForm->isSubmitted() && $documentDeReferenceForm->isValid()) {
            $newDocumentDeReference = $documentDeReferenceForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newDocumentDeReference);
            $entityManager->flush();
        }

        return $this->render('document_de_reference/add.html.twig', [
            'controller_name' => 'Document de reference controller',
            'DocumentDeReferenceForm' => $documentDeReferenceForm->createView(),
        ]);
    }
}
