<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Corporate;
use App\Entity\CompteDeResultat;
class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     * @Route("", name="homepage")
     */
    public function index(Request $request)
    {
      $entityManager = $this->getDoctrine()->getManager();
      $tmpCorporate = new Corporate();
      $form = $this->createFormBuilder($tmpCorporate)
            ->add('Name', EntityType::class, array(
                  // looks for choices from this entity
                  'class' => Corporate::class,
                  // uses the Corporate.Name property as the visible option string
                  'choice_label' => 'Name',
                  ))
            ->add('save', SubmitType::class, array('label' => 'Look at this corporate'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $corporate = $entityManager->getRepository(Corporate::class)
                  ->findByName($form->getData()->getName());
            if ($corporate) {
              return $this->redirect('corporate/'.$corporate->getId());
            }
        }
/*
        // 2. Setup repository of some entity
        $repoArticles = $em->getRepository(Articles::class);

        // 3. Query how many rows are there in the Articles table
        $totalArticles = $repoArticles->createQueryBuilder('a')
            // Filter by some parameter if you want
            // ->where('a.published = 1')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
*/
        $repoCompteDeResultat = $entityManager->getRepository(CompteDeResultat::class);
        $lotsOfCompteDeResultats = $repoCompteDeResultat->findAllUpTo(100);
        $bilanComptableCount = $repoCompteDeResultat->createQueryBuilder('compte')
            ->select('count(compte.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $companyCount = $entityManager->getRepository(Corporate::class)->createQueryBuilder('corporate')
            ->select('count(corporate.id)')
            ->getQuery()
            ->getSingleScalarResult();
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'form' => $form->createView(),
            'comptes' => $lotsOfCompteDeResultats,
            'companyCount' => $companyCount,
            'bilanComptableCount' => $bilanComptableCount
        ]);
    }
}
