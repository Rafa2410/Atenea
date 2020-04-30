<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Cuestion;
use App\Form\CuestionType;
use App\Entity\SubtipoCuestion;
use App\Form\SubtipoCuestionType;
use App\Entity\TipoCuestion;
use App\Form\TipoCuestionType;


class CuestionExternaController extends AbstractController
{
    /**
     * @Route("/cuestion/externa", name="cuestion_externa")
     */
    public function index()
    {
        $cuestiones = $this->getDoctrine()->getRepository(Cuestion::Class)->findAll();
        $subtipo_cuestiones = $this->getDoctrine()->getRepository(SubtipoCuestion::Class)->findAll();
        $tipo_cuestiones = $this->getDoctrine()->getRepository(TipoCuestion::Class)->findAll();

        return $this->render('cuestion_externa/index.html.twig', [
            'cuestiones' => $cuestiones,
            'subtipo_cuestiones' => $subtipo_cuestiones,
            'tipo_cuestiones' => $tipo_cuestiones
        ]);
    }

     /**
     * @Route("/cuestion/externa/edit/{id<\d+>}", name="cuestion_externa_edit")
     */
     public function edit($id,Request $request)
     {
           //var_dump($request->request);
           //exit();
          $cuestion = $this->getDoctrine()->getRepository(Cuestion::class)->find($id);

          $form = $this->createForm(CuestionType::class, $cuestion);

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()){

                $cuestion = $form->getData();
                $cuestion->setInterno(0);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cuestion);
                $entityManager->flush();

                $this->addFlash(
                                'notice',
                                'Cuestion editada!'
                );
                return $this->redirectToRoute('cuestion_externa');
          }

          return $this->render('cuestion_externa/new.html.twig', [
             'form' => $form->createView(),
             'interno' => 0
          ]);

     }

          /**
          * @Route("/cuestion/externa/new", name="cuestion_externa_new")
          */
          public function new(Request $request)
          {
               $cuestion = new Cuestion();

               $form = $this->createForm(CuestionType::class, $cuestion);

               $subtipo_cuestiones = $this->getDoctrine()->getRepository(SubtipoCuestion::Class)->findBy(['interno' => 0]);
               $form->add('subtipo', EntityType::class, array(
                   'class' => SubtipoCuestion::Class,
                   'choices' => $subtipo_cuestiones,
                   'choice_label' => 'descripcion')
               );

               $form->handleRequest($request);

               if($form->isSubmitted() && $form->isValid()){

                     $cuestion = $form->getData();
                     $cuestion->setInterno(0);

                     $entityManager = $this->getDoctrine()->getManager();
                     $entityManager->persist($cuestion);
                     $entityManager->flush();

                     $this->addFlash(
                                     'notice',
                                     'Nueva cuestion creada!'
                     );
                     return $this->redirectToRoute('cuestion_externa');
               }

               return $this->render('cuestion_externa/new.html.twig', [
                  'form' => $form->createView(),
                  'interno' => 0
               ]);

          }
}
