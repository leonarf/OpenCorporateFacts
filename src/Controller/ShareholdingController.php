<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Shareholding;
use App\Entity\Corporate;
class ShareholdingController extends AbstractController
{
    /**
     * @Route("/add_shareholding", name="add_shareholding")
     */
    public function add(Request $request)
    {
        $newShareholding = new Shareholding();
        $shareholdingForm = $this->createFormBuilder($newShareholding)
                          ->add('OwningCorporate', EntityType::class, array(
                                // looks for choices from this entity
                                'class' => Corporate::class,
                                // uses the Corporate.Name property as the visible option string
                                'choice_label' => 'Name',
                                ))
                          ->add('OwnedCorporate', EntityType::class, array(
                                // looks for choices from this entity
                                'class' => Corporate::class,
                                // uses the Corporate.Name property as the visible option string
                                'choice_label' => 'Name',
                                ))
                          ->add('OwningPercentage')
                          ->add('OwningDate')
                          ->add('save', SubmitType::class)
                          ->getForm();

        $shareholdingForm->handleRequest($request);

        if ($shareholdingForm->isSubmitted() && $shareholdingForm->isValid()) {
            $newShareholding = $shareholdingForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newShareholding);
            $entityManager->flush();
        }

        return $this->render('shareholding/add.html.twig', [
            'controller_name' => 'shareholding controller',
            'ShareholdingForm' => $shareholdingForm->createView(),
        ]);
    }
}
