<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Form\CompteDeResultatFormType;
use App\Entity\Corporate;
class CorporateController extends AbstractController
{
  public function buildForm(FormBuilderInterface $builder)
  {
    $builder->add('Name', TextType::class)
            ->add('OpenCorporateURL', UrlType::class)
            ->add('CompanyNumber', TextType::class)
            ->add('ComptesDeResultats', CollectionType::class, [
            'entry_type' => CompteDeResultatFormType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false])
            ->add('save', SubmitType::class, array('label' => 'Save corporate'));
  }

    /**
     * @Route("/add_corporate", name="add_corporate")
     */
    public function add(Request $request)
    {
        $newCorporate = new Corporate();
        $formBuilder = $this->createFormBuilder($newCorporate);
        $this->buildForm($formBuilder);
        $newCorporateForm = $formBuilder->getForm();

        $newCorporateForm->handleRequest($request);

        if ($newCorporateForm->isSubmitted() && $newCorporateForm->isValid()) {
            // $form->getData() holds the submitted values
            $newCorporate = $newCorporateForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $oldCorporate = $entityManager->getRepository(Corporate::class)
                ->findByName($newCorporate->getName());

            if ($oldCorporate) {
              $oldCorporate = $newCorporate;
            }
            else {
              $entityManager->persist($newCorporate);
            }
            $entityManager->flush();

            // return $this->redirectToRoute('task_success');
        }

        return $this->render('corporate/add.html.twig', [
            'controller_name' => 'CorporateController',
            'NewCorporateForm' => $newCorporateForm->createView(),
        ]);
    }
    /**
     * @Route("/import", name="import")
     */
    public function import(Request $request)
    {
        $newCorporate = new Corporate();
        $formBuilder = $this->createFormBuilder($newCorporate);
        $this->buildForm($formBuilder);
        $newCorporateForm = $formBuilder->getForm();

        $newCorporateForm->handleRequest($request);

        if ($newCorporateForm->isSubmitted() && $newCorporateForm->isValid()) {
            $newCorporate = $newCorporateForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $oldCorporate = $entityManager->getRepository(Corporate::class)
                ->findByName($newCorporate->getName());

            if ($oldCorporate) // Update existing corporate
            {
              foreach($newCorporate->getComptesDeResultats() as $newCompte){
                  $oldCorporate->addComptesDeResultat($newCompte);
              }
            }
            else // Save in database new corporate
            {
              $entityManager->persist($newCorporate);
            }
            $entityManager->flush();

            return $this->redirectToRoute('import');
        }

        return $this->render('corporate/import.html.twig', [
            'controller_name' => 'CorporateController',
            'NewCorporateForm' => $newCorporateForm->createView(),
        ]);
    }

    /**
     * @Route("/corporate/{id}", options={"expose"=true}, name="corporate_show")
     */
    public function show($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $askedCorporate = $entityManager->getRepository(Corporate::class)
            ->findOneBy(['id' => $id]);

        if (!$askedCorporate) {
            throw $this->createNotFoundException(
                'No corporate found for id '.$id
            );
        }
        return $this->render('corporate/show.html.twig', ['corporate' => $askedCorporate]);
    }
}
