<?php

namespace App\Controller;

use App\Entity\Cuestion;
use App\Entity\SubtipoCuestion;
use App\Entity\TipoCuestion;
use App\Form\CuestionType;
use App\Form\SubtipoCuestionType;
use App\Form\TipoCuestionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CuestionController extends AbstractController
{
    /**
     * @Route("/cuestion/externa/{interna}", name="cuestion_externa")
     */
    public function index($interna)
    {
        $cuestiones         = $this->getDoctrine()->getRepository(Cuestion::Class)->findAll();
        $subtipo_cuestiones = $this->getDoctrine()->getRepository(SubtipoCuestion::Class)->findAll();
        $tipo_cuestiones    = $this->getDoctrine()->getRepository(TipoCuestion::Class)->findAll();


        return $this->render(
            'cuestion_externa/index.html.twig',
            [
                'cuestiones'         => $cuestiones,
                'subtipo_cuestiones' => $subtipo_cuestiones,
                'tipo_cuestiones'    => $tipo_cuestiones,
                'cue_interna'        => $interna,
            ]
        );
    }

    /**
     * @Route("/cuestion/externa/new/{interno}", name="cuestion_externa_new")
     */
    public function new($interno, Request $request)
    {
        $cuestion = new Cuestion();

        $form = $this->createForm(CuestionType::class, $cuestion, ['label' => 'Crear']);

        $subtipo_cuestiones = $this->getDoctrine()->getRepository(SubtipoCuestion::Class)->findBy(
            ['interno' => $interno]
        );

        $form->add(
            'subtipo',
            EntityType::class,
            array(
                'class'        => SubtipoCuestion::Class,
                'choices'      => $subtipo_cuestiones,
                'choice_label' => 'descripcion',
            )
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cuestion = $form->getData();
            $cuestion->setInterno($interno);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuestion);
            $entityManager->flush();

            return $this->redirectToRoute('cuestion_externa');

        }

        if ($interno == 0) {
            $titulo = "Nueva Cuestion Externa";
        } else {
            $titulo = "Nueva Cuestion Interna";
        }

        return $this->render(
            'cuestion_externa/new.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }


    /**
     * @Route("/cuestion/externa/edit/{id}", name="cuestion_externa_edit")
     */
    public function edit($id, Request $request)
    {

        $cuestion = $this->getDoctrine()->getRepository(Cuestion::class)->find($id);

        $form = $this->createForm(CuestionType::class, $cuestion, ['label' => 'Editar']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cuestion = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuestion);
            $entityManager->flush();

            return $this->redirectToRoute('cuestion_externa');
        }

        if ($cuestion->getInterno()) {
            $titulo = "Editar Cuestion Interna";
        } else {
            $titulo = "Editar Cuestion Externa";
        }

        return $this->render(
            'cuestion_externa/edit.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/externa/subtipo/new/{interno}", name="cuestion_externa_subtipo_new")
     */
    public function newExternaSubtipo($interno, Request $request)
    {
        $subtipo_cuestion = new SubtipoCuestion();

        $form = $this->createForm(SubtipoCuestionType::class, $subtipo_cuestion, ['label' => 'Crear']);

        $tipo_cuestiones = $this->getDoctrine()->getRepository(TipoCuestion::Class)->findBy(['interno' => $interno]);

        $form->add(
            'tipo',
            EntityType::class,
            array(
                'class'        => TipoCuestion::Class,
                'choices'      => $tipo_cuestiones,
                'choice_label' => 'descripcion',
            )
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $subtipo_cuestion = $form->getData();
            $subtipo_cuestion->setInterno($interno);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtipo_cuestion);
            $entityManager->flush();

            return $this->redirectToRoute('cuestion_externa');

        }

        if ($interno == 0) {
            $titulo = "Nuevo Subtipo Externo";
        } else {
            $titulo = "Nuevo Subtipo Interno";
        }

        return $this->render(
            'cuestion_externa/new-subtipo.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/externa/subtipo/edit/{id}", name="cuestion_externa_subtipo_edit")
     */
    public function editExternaSubtipo($id, Request $request)
    {

        $subtipo_cuestion = $this->getDoctrine()->getRepository(SubtipoCuestion::class)->find($id);

        $form = $this->createForm(SubtipoCuestionType::class, $subtipo_cuestion, ['label' => 'Editar']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $subtipo_cuestion = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtipo_cuestion);
            $entityManager->flush();

            return $this->redirectToRoute('cuestion_externa');
        }

        if ($subtipo_cuestion->getInterno()) {
            $titulo = "Editar Subtipo Interna";
        } else {
            $titulo = "Editar Subtipo Externa";
        }

        return $this->render(
            'cuestion_externa/edit-subtipo.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/externa/tipo/new/{interno}", name="cuestion_externa_tipo_new")
     */
    public function newExternatipo($interno, Request $request)
    {
        $tipo_cuestion = new TipoCuestion();

        $form = $this->createForm(TipoCuestionType::class, $tipo_cuestion, ['label' => 'Crear']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tipo_cuestion = $form->getData();
            $tipo_cuestion->setInterno($interno);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipo_cuestion);
            $entityManager->flush();

            return $this->redirectToRoute('cuestion_externa');

        }

        if ($interno == 0) {
            $titulo = "Nuevo Tipo Externo";
        } else {
            $titulo = "Nuevo Tipo Interno";
        }

        return $this->render(
            'cuestion_externa/new-tipo.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/externa/tipo/edit/{id}", name="cuestion_externa_tipo_edit")
     */
    public function editExternatipo($id, Request $request)
    {

        $tipo_cuestion = $this->getDoctrine()->getRepository(TipoCuestion::class)->find($id);

        $form = $this->createForm(TipoCuestionType::class, $tipo_cuestion, ['label' => 'Editar']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tipo_cuestion = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipo_cuestion);
            $entityManager->flush();

            /*$this->addFlash(
                'notice',
                'Subtipo editado!'
            );*/

            return $this->redirectToRoute('cuestion_externa');
        }

        if($tipo_cuestion->getInterno()){
            $titulo = "Editar Tipo Interna";
        }else{
            $titulo = "Editar Tipo Externa";
        }
        return $this->render(
            'cuestion_externa/edit-tipo.html.twig',
            [
                'form' => $form->createView(),
                'title' => $titulo
            ]
        );

    }
}