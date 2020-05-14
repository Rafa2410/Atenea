<?php

namespace App\Controller;

use App\Entity\Cuestion;
use App\Entity\CuestionUnidad;
use App\Entity\SubtipoCuestion;
use App\Entity\TipoCuestion;
use App\Entity\UnidadDeGestion;
use App\Entity\UsuarioUnidadPermiso;
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
        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $user));
        //Cuestiones del usuario activo        
        $cuestionUnidad = $this->getDoctrine()
                               ->getRepository(CuestionUnidad::class)
                               ->findBy(array('unidad' => $UUP[0]->getUnidad()->getId()));
        //var_dump($cuestionUnidad[0]->getCuestion()->getSubtipo()->getDescripcion());

        $subtiposCuestionUnidad = [];
        $tiposCuestionUnidad    = [];
        if (count($cuestionUnidad) > 0) {
            for ($i = 0; $i < count($cuestionUnidad); $i++) {

                $subtipo = $this->getDoctrine()
                                ->getRepository(SubtipoCuestion::class)
                                ->findOneBy(
                                    array(
                                        'tipo' => $cuestionUnidad[$i]->getCuestion()->getSubtipo()->getTipo()->getId(),
                                    )
                                );
                array_push($subtiposCuestionUnidad, $subtipo);
            }
            for ($i = 0; $i < count($cuestionUnidad); $i++) {
                //var_dump($cuestionUnidad[$i]->getCuestion()->getSubtipo()->getId());

                $tipo = $this->getDoctrine()
                                ->getRepository(TipoCuestion::class)
                                ->findOneBy(
                                    array(
                                        'subtipoCuestions' => $cuestionUnidad[$i]->getCuestion()->getSubtipo()->getId(),
                                    )
                                );
                //var_dump($subtipo->getDescripcion());
                array_push($tiposCuestionUnidad, $tipo);
            }
        }

        /*$tiposCuestionUnidad = [];
        if (count($subtiposCuestionUnidad) > 0) {
            $tiposCuestionUnidad = $this->getDoctrine()
                                        ->getRepository(SubtipoCuestion::class)
                                        ->findBy(array('tipo' => $subtiposCuestionUnidad->getTipo()));
        }*/


        $cuestiones = $this->getDoctrine()->getRepository(Cuestion::Class)->findAll();
        //$subtipo_cuestiones = $this->getDoctrine()->getRepository(SubtipoCuestion::Class)->findAll();
        //$tipo_cuestiones = $this->getDoctrine()->getRepository(TipoCuestion::Class)->findAll();

        $cuestionesResult = [];

        foreach ($cuestiones as $key => $cuestion) {
            foreach ($cuestionUnidad as $key2 => $cUnidad) {
                if ($cuestion->getId() == $cUnidad->getCuestion()->getId()) {
                    array_push($cuestionesResult, $cuestion);
                }
            }
        }

        //var_dump($subtiposCuestionUnidad[0]->getDescripcion());
        return $this->render(
            'cuestion/index.html.twig',
            [
                'cuestiones'         => $cuestionesResult,
                'subtipo_cuestiones' => $subtiposCuestionUnidad,
                'tipo_cuestiones'    => $tiposCuestionUnidad,
                'cue_interna'        => $interna,
                'cuestionUnidad'     => $cuestionUnidad,
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

            $user = $this->getUser()->getId();
            //Tabla usuario_unidad_permiso
            $UUP = $this->getDoctrine()
                        ->getRepository(UsuarioUnidadPermiso::class)
                        ->findBy(array('usuario' => $user));
            //Empresas de la corporacion
            $unidad = $this->getDoctrine()
                           ->getRepository(UnidadDeGestion::class)
                           ->findBy(array('id' => $UUP[0]->getUnidad()->getId()));

            $unidadCuestion = new CuestionUnidad();

            $unidadCuestion->setCuestion($cuestion);
            $unidadCuestion->setUnidad($unidad[0]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuestion);
            $entityManager->persist($unidadCuestion);
            $entityManager->flush();

            $this->addFlash('creado', 'Cuestion '.$cuestion->getDescripcion().' creada!');

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
     * @Route("/cuestion/delete/{id}", name="cuestion_delete")
     */
    public function eliminarCuestion(Request $request, $id)
    {
        $cuestion = $this->getDoctrine()->getRepository(Cuestion::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($cuestion);
        $em->flush();

        $this->addFlash('eliminado', 'Cuestión '.$cuestion->getDescripcion().' eliminada!');

        if ($cuestion->getInterno() == 0) {
            return $this->redirectToRoute('cuestion', ['interna' => 0]);
        } else {
            return $this->redirectToRoute('cuestion', ['interna' => 1]);
        }
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

            $this->addFlash('creado', 'Subtipo '.$subtipo_cuestion->getDescripcion().' creado!');

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

        $tipo_cuestiones = $this->getDoctrine()->getRepository(TipoCuestion::Class)->findBy(
            ['interno' => $subtipo_cuestion->getInterno()]
        );

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
     * @Route("/cuestion/subtipo/delete/{id}", name="cuestion_subtipo_delete")
     */
    public function eliminarSubtipo(Request $request, $id)
    {
        $subtipo_cuestion = $this->getDoctrine()->getRepository(SubtipoCuestion::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($subtipo_cuestion);
        $em->flush();

        $this->addFlash('eliminado', 'Subtipo '.$subtipo_cuestion->getDescripcion().' eliminado!');

        if ($subtipo_cuestion->getInterno() == 0) {
            return $this->redirectToRoute('cuestion', ['interna' => 0]);
        } else {
            return $this->redirectToRoute('cuestion', ['interna' => 1]);
        }
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

            $this->addFlash('creado', 'Tipo '.$tipo_cuestion->getDescripcion().' creado!');

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
        var_dump($tipo_cuestion);

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

    /**
     * @Route("/cuestion/tipo/delete/{id}", name="cuestion_tipo_delete")
     */
    public function deleteTipo($id, Request $request)
    {
        $tipo_cuestion = $this->getDoctrine()->getRepository(TipoCuestion::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($tipo_cuestion);
        $em->flush();

        $this->addFlash('eliminado', 'Tipo '.$tipo_cuestion->getDescripcion().' eliminado!');

        if ($tipo_cuestion->getInterno() == 0) {
            return $this->redirectToRoute('cuestion', ['interna' => 0]);
        } else {
            return $this->redirectToRoute('cuestion', ['interna' => 1]);
        }
    }
}