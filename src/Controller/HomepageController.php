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
          'comptes' => $lotsOfCompteDeResultats,
          'companyCount' => $companyCount,
          'bilanComptableCount' => $bilanComptableCount
      ]);
    }
}
