<?php

namespace App\Controller;

//use Acme\StoreBundle\Entity\Cuestion;
use App\Entity\Aspecto;
use App\Entity\Cuestion;
use App\Entity\UsuarioUnidadPermiso;
use App\Entity\UnidadDeGestion;
use App\Entity\CuestionUnidad;
use App\Form\AspectoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AspectoController extends AbstractController
{
    /**
     * @Route("/aspecto/{interna}", name="aspecto")
     */
    public function index($interna)
    {        
        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));

        $aspectos = $this->getDoctrine()->getRepository(Aspecto::Class)->findAll();
        
        $aspectosResult = [];

        foreach ($aspectos as $key => $aspecto) {
            foreach ($aspecto->getCuestiones() as $key => $cuestion) {
                foreach ($cuestion->getCuestionUnidads() as $key => $unidad) {                    
                    if ($unidad->getUnidad()->getId() == $UUP[0]->getUnidad()->getId()) {
                            if (count($aspectosResult) > 0) {
                            $repe = false;
                            foreach ($aspectosResult as $key => $aspect) {                            
                                if ($aspect->getDescripcion() == $aspecto->getDescripcion()) {
                                    $repe = true;
                                }
                            }
                            if (!$repe) {
                                array_push($aspectosResult, $aspecto);
                            }
                        } else {
                            array_push($aspectosResult, $aspecto);
                        }
                    }
                }                
            }
        }                

        return $this->render(
            'aspecto/index.html.twig',
            [
                'aspectos' => $aspectosResult,
                'interna'  => $interna
            ]
        );
    }

    /**
     * @Route("/aspecto/new/{aspec}", name="aspecto_new")
     */
    public function new($aspec, Request $request)
    {
        $aspecto = new Aspecto();

        $form = $this->createForm(AspectoType::class, $aspecto, ['label' => 'Crear']);

        //Comprueba que recibo por la url

        if ($aspec == 'opor') {
            $interno   = 0;
            $favorable = 1;
            $titulo    = "Crear nueva oportunidad";

        } elseif ($aspec == 'amen') {
            $interno   = 0;
            $favorable = 0;
            $titulo    = "Crear nueva amenaza";
        } elseif ($aspec == 'debi') {
            $interno   = 1;
            $favorable = 0;
            $titulo    = "Crear nueva debilidad";
        } else {
            $interno   = 1;
            $favorable = 1;
            $titulo    = "Crear nueva fortaleza";
        }

        $form->handleRequest($request);

        //Comprueba si el form es valido

        if ($form->isSubmitted() && $form->isValid()) {

            $aspecto = $form->getData();
            $aspecto->setInterno($interno);
            $aspecto->setFavorable($favorable);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspecto);
            $entityManager->flush();

            $this->addFlash('creado','Aspecto '.$aspecto->getDescripcion().' creado!');

            return $this->redirectToRoute('aspecto', ['interna' => $interno]);

        }

        //Busco las cuestiones internas o externas
        if ($interno == 1) {
            $cuestiones = $this->getDoctrine()->getRepository(Cuestion::Class)->findBy(
                ['interno' => $interno]
            );
        } else {
            $cuestiones = $this->getDoctrine()->getRepository(Cuestion::Class)->findBy(
                ['interno' => $interno]
            );
        }

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));
        //Cuestiones del usuario activo        
        $cuestionUnidad = $this->getDoctrine()
            ->getRepository(CuestionUnidad::class)
            ->findBy(array('unidad' => $UUP[0]->getUnidad()->getId()));

        $cuestionesResult = [];

        foreach ($cuestiones as $key => $cuestion) {
            foreach ($cuestionUnidad as $key2 => $cUnidad) {
                if ($cuestion->getId() == $cUnidad->getCuestion()->getId()) {
                    array_push($cuestionesResult, $cuestion);
                }
            }            
        }

        //añado en el form un desplegable de cuestiones        
        $form->add(
            'cuestiones',
            EntityType::class,
            array(
                'class'        => Cuestion::Class,
                'choices'      => $cuestionesResult,
                'choice_label' => 'descripcion',
                'multiple'     => true,
                'attr'         => ['class' => 'height'],
            )
        );

        return $this->render(
            'aspecto/new.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
            ]
        );

    }

    /**
     * @Route("/aspecto/edit/{id}/{aspec}", name="aspecto_edit")
     */
    public function edit($id, $aspec, Request $request)
    {

        $aspecto = $this->getDoctrine()->getRepository(Aspecto::class)->find($id);

        if ($aspec == 'opor') {
            $interno   = 0;
            $titulo    = "Editar oportunidad";
        } elseif
        ($aspec == 'amen') {
            $interno   = 0;
            $titulo    = "Editar amenaza";
        } elseif
        ($aspec == 'debi') {
            $interno   = 1;
            $titulo    = "Editar debilidad";
        } else {
            $interno   = 1;
            $titulo    = "Editar fortaleza";
        }

        $form = $this->createForm(AspectoType::class, $aspecto, ['label' => 'Editar']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $aspecto = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspecto);
            $entityManager->flush();

            return $this->redirectToRoute('aspecto', ['interna' => $interno]);
        }

        //$cuestiones = $aspecto->getCuestiones();
        if ($interno == 1) {
            $cuestiones = $this->getDoctrine()->getRepository(Cuestion::Class)->findBy(
                ['interno' => $interno]
            );
        } else {
            $cuestiones = $this->getDoctrine()->getRepository(Cuestion::Class)->findBy(
                ['interno' => $interno]
            );
        }

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));
        //Cuestiones del usuario activo        
        $cuestionUnidad = $this->getDoctrine()
            ->getRepository(CuestionUnidad::class)
            ->findBy(array('unidad' => $UUP[0]->getUnidad()->getId()));

        $cuestionesResult = [];

        foreach ($cuestiones as $key => $cuestion) {
            foreach ($cuestionUnidad as $key2 => $cUnidad) {
                if ($cuestion->getId() == $cUnidad->getCuestion()->getId()) {
                    array_push($cuestionesResult, $cuestion);
                }
            }            
        }

        $form->add(
            'cuestiones',
            EntityType::class,
            array(
                'class'        => Cuestion::Class,
                'choices'      => $cuestionesResult,
                'choice_label' => 'descripcion',
                'multiple'     => true,
                'attr'         => ['class' => 'height'],
            )
        );


        return $this->render(
            'aspecto/edit.html.twig',
            [
                'form'  => $form->createView(),
                'title' => $titulo,
                'cuestiones' => $cuestiones,
            ]
        );

    }

    /**
     * @Route("/aspecto/delete/{id}/{aspec}", name="aspecto_delete")
     */
    public function delete(Request $request, $id, $aspec) {
        $aspecto = $this->getDoctrine()->getRepository(Aspecto::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($aspecto);
        $em->flush();

        $this->addFlash('eliminado','Aspecto '.$aspecto->getDescripcion().' eliminado!');

        if ($aspec == 'opor' || $aspec == 'amen') {
            $interno   = 0;            
        } else {
            $interno   = 1;            
        }

        return $this->redirectToRoute('aspecto', ['interna' => $interno]);
    }
}