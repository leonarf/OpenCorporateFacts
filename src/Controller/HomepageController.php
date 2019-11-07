<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

use App\Entity\Corporate;
use App\Entity\CompteDeResultat;
class HomepageController extends AbstractController
{
    /**
     * @Route("/api_doc", name="api_doc")
     */
    public function api_doc(Request $request)
    {
        // Fix for api platform bug.
        return new Response('OK');
    }

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

    /**
     * @Route("/csv/{corporateId}", name="csv")
     */
    public function allInOneCsv($corporateId)
    {
      $entityManager = $this->getDoctrine()->getManager();
      $repoCorporate = $entityManager->getRepository(Corporate::class);

      $lotsOfCompteDeResultats = $repoCorporate->find($corporateId)->getComptesDeResultats();

      $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
      $normalizer = new ObjectNormalizer($classMetadataFactory);

      $encoders = [new CsvEncoder()];
      $serializer = new Serializer([$normalizer], $encoders);
      $csvContent = $serializer->serialize($lotsOfCompteDeResultats, 'csv', ['groups' => ['groupImportant']]);

      $response = new Response($csvContent);
      $response->headers->set('Content-Disposition', 'attachment; filename="allOfFame.csv"');

      return $response;
    }
}
