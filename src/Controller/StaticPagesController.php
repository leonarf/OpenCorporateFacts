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
class StaticPagesController extends AbstractController
{
    /**
     * @Route("/mentions_legales", name="mentions_legales")
     */
    public function mentions_legales(Request $request)
    {
      return $this->render('mentions_legales/mentionslegales.html.twig');
    }

    /**
     * @Route("/documentation_donnees", name="documentation_donnees")
     */
    public function donnees_documentation(Request $request)
    {
      return $this->render('donnees_documentation/donnees_doc.html.twig');
    }
}
