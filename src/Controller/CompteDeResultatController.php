<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\FormBuilderInterface;

use App\Entity\CompteDeResultat;
use App\Entity\Corporate;
use App\Form\CompteDeResultatFormType;

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
        $form = $this->createForm(CompteDeResultatFormType::class, $newCompteDeResultat);

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
}
