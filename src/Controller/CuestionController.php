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
     * @Route("/cuestion/{interna}", name="cuestion")
     */
    public function index($interna)
    {
        $cuestiones         = $this->getDoctrine()->getRepository(Cuestion::Class)->findAll();
        $subtipo_cuestiones = $this->getDoctrine()->getRepository(SubtipoCuestion::Class)->findAll();
        $tipo_cuestiones    = $this->getDoctrine()->getRepository(TipoCuestion::Class)->findAll();


        return $this->render(
            'cuestion/index.html.twig',
            [
                'cuestiones'         => $cuestiones,
                'subtipo_cuestiones' => $subtipo_cuestiones,
                'tipo_cuestiones'    => $tipo_cuestiones,
                'cue_interna'        => $interna,
            ]
        );
    }

    /**
     * @Route("/cuestion/new/{interno}", name="cuestion_new")
     */
    public function new($interno, Request $request)
    {
        $cuestion = new Cuestion();

        $form = $this->createForm(CuestionType::class, $cuestion);

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

            return $this->redirectToRoute('cuestion', ['interna' => $interno]);

        }

        if ($interno == 0) {
            $titulo = "Nueva Cuestion Externa";
        } else {
            $titulo = "Nueva Cuestion Interna";
        }

        return $this->render(
            'cuestion/new.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }


    /**
     * @Route("/cuestion/edit/{id}", name="cuestion_edit")
     */
    public function edit($id, Request $request)
    {

        $cuestion = $this->getDoctrine()->getRepository(Cuestion::class)->find($id);

        $form = $this->createForm(CuestionType::class, $cuestion);

        $subtipo_cuestiones = $this->getDoctrine()->getRepository(SubtipoCuestion::Class)->findBy(
            ['interno' => $cuestion->getInterno()]
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

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuestion);
            $entityManager->flush();

            if ($cuestion->getInterno() == 0) {
                return $this->redirectToRoute('cuestion', ['interna' => 0]);
            } else {
                return $this->redirectToRoute('cuestion', ['interna' => 1]);
            }
        }

        if ($cuestion->getInterno()) {
            $titulo = "Editar Cuestion Interna";
        } else {
            $titulo = "Editar Cuestion Externa";
        }

        return $this->render(
            'cuestion/edit.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/subtipo/new/{interno}", name="cuestion_subtipo_new")
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

            return $this->redirectToRoute('cuestion', ['interna' => $interno]);

        }

        if ($interno == 0) {
            $titulo = "Nuevo Subtipo Externo";
        } else {
            $titulo = "Nuevo Subtipo Interno";
        }

        return $this->render(
            'cuestion/new-subtipo.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/subtipo/edit/{id}", name="cuestion_subtipo_edit")
     */
    public function editExternaSubtipo($id, Request $request)
    {

        $subtipo_cuestion = $this->getDoctrine()->getRepository(SubtipoCuestion::class)->find($id);

        $form = $this->createForm(SubtipoCuestionType::class, $subtipo_cuestion, ['label' => 'Editar']);

        $tipo_cuestiones = $this->getDoctrine()->getRepository(TipoCuestion::Class)->findBy(['interno' => $subtipo_cuestion->getInterno()]);

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

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtipo_cuestion);
            $entityManager->flush();

            if ($subtipo_cuestion->getInterno() == 0) {
                return $this->redirectToRoute('cuestion', ['interna' => 0]);
            } else {
                return $this->redirectToRoute('cuestion', ['interna' => 1]);
            }

        }

        if ($subtipo_cuestion->getInterno()) {
            $titulo = "Editar Subtipo Interna";
        } else {
            $titulo = "Editar Subtipo Externa";
        }

        return $this->render(
            'cuestion/edit-subtipo.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/tipo/new/{interno}", name="cuestion_tipo_new")
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

            return $this->redirectToRoute('cuestion', ['interna' => $interno]);

        }

        if ($interno == 0) {
            $titulo = "Nuevo Tipo Externo";
        } else {
            $titulo = "Nuevo Tipo Interno";
        }

        return $this->render(
            'cuestion/new-tipo.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/cuestion/tipo/edit/{id}", name="cuestion_tipo_edit")
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

            if ($tipo_cuestion->getInterno() == 0) {
                return $this->redirectToRoute('cuestion', ['interna' => 0]);
            } else {
                return $this->redirectToRoute('cuestion', ['interna' => 1]);
            }

        }

        if ($tipo_cuestion->getInterno()) {
            $titulo = "Editar Tipo Interna";
        } else {
            $titulo = "Editar Tipo Externa";
        }

        return $this->render(
            'cuestion/edit-tipo.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }
}