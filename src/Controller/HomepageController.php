<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

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

    /**
     * @Route("/csv", name="csv")
     */
    public function allInOneCsv(Request $request)
    {
      $entityManager = $this->getDoctrine()->getManager();
      $repoCompteDeResultat = $entityManager->getRepository(CompteDeResultat::class);
      $lotsOfCompteDeResultats = $repoCompteDeResultat->findAllUpTo(1000000);

      // csv tryhard
      // all callback parameters are optional (you can omit the ones you don't use)
      $corporateSerializerCallback = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
          if ($format == "csv")
          {
            return $innerObject->getName() . "|" . $innerObject->getCompanyNumber() . "|" . $innerObject->getIndustryCode();
          }
          return "je sais pas faire autre chose que du csv";
      };

      $circularReferenceCallback = function ($innerObject) {
          return $innerObject instanceof \CompteDeResultat ? "c'est un bilan circulaire" : "pas un bilan mais c'est circulaire?";
      };

      $defaultContext = [
          'callbacks' => [
              'Corporate' => $corporateSerializerCallback,
          ],
          'circular_reference_handler' =>  $corporateSerializerCallback,
      ];
      $normalizer = new GetSetMethodNormalizer(null, null, null, null, null, $defaultContext);
      $normalizer->setCircularReferenceHandler($circularReferenceCallback);
      $normalizer->setCallbacks([
          'corporate' => $corporateSerializerCallback
      ]);

      $encoders = [new CsvEncoder()];
      $serializer = new Serializer([$normalizer], $encoders);
      $csvContent = $serializer->serialize($lotsOfCompteDeResultats, 'csv');

      $response = new Response($csvContent);

      $disposition = ResponseHeaderBag::makeDisposition(
          ResponseHeaderBag::DISPOSITION_ATTACHMENT,
          'allOfFame.csv'
      );

      $response->headers->set('Content-Disposition', $disposition);
      return $response;
    }
}
