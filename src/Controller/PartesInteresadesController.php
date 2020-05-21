<?php

namespace App\Controller;

use App\Entity\Expectativa;
use App\Entity\PartesInteresadas;
use App\Entity\TipoPartesInteresadas;
use App\Entity\UsuarioUnidadPermiso;
use App\Entity\UnidadDeGestion;
use App\Form\PartesInteresadasType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PartesInteresadesController extends AbstractController
{
    /**
     * @Route("/partes_interesadas/{currentPage}", name="partes_interesadas")
     */
    public function index($currentPage = 1)
    {
        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $user));
        //Cuestiones del usuario activo
        $tipos = $this->getDoctrine()
                               ->getRepository(TipoPartesInteresadas::class)
                               ->findBy(array('UnidadDeGestion' => $UUP[0]->getUnidad()->getId()));
        
        if (count($tipos) > 0) {
            $partesResult = [];
            foreach ($tipos as $key => $tipo) {
                $parte = $this->getDoctrine()
                        ->getRepository(PartesInteresadas::Class)
                        ->findBy(array('TipoParteInteresada' => $tipo->getId()));
                array_push($partesResult, $parte);
            }
            
        } else {
            $partesResult = [];            
        }

        //Paginacion
        $em = $this->getDoctrine()->getManager();

        $limit = 3;
        $parte = $em->getRepository(PartesInteresadas::Class)->getAllPers($currentPage, $limit, $partesResult);
        $partesResultado = $parte['paginator'];
        $partesQueryCompleta =  $parte['query'];        

        $maxPages = ceil($parte['paginator']->count() / $limit);

        return $this->render('partes_interesadas/index.html.twig', [
            'partes'          => $partesResultado,
            'maxPages'        => $maxPages,
            'thisPage'        => $currentPage,
            'all_items'       => $partesQueryCompleta
        ]);
    }

    /**
     * @Route("/partes_interesadas/super/{id}/{currentPage}", name="partes_interesadas_super")
     */
    public function indexSuper($id, $currentPage = 1)
    {
        $tipos = $this->getDoctrine()
                               ->getRepository(TipoPartesInteresadas::class)
                               ->findBy(array('UnidadDeGestion' => $id));
        
        if (count($tipos) > 0) {
            $partesResult = [];
            foreach ($tipos as $key => $tipo) {
                $parte = $this->getDoctrine()
                        ->getRepository(PartesInteresadas::Class)
                        ->findBy(array('TipoParteInteresada' => $tipo->getId()));
                array_push($partesResult, $parte);
            }
            
        } else {
            $partesResult = [];            
        }

        //Paginacion
        $em = $this->getDoctrine()->getManager();

        $limit = 3;
        $parte = $em->getRepository(PartesInteresadas::Class)->getAllPers($currentPage, $limit, $partesResult);
        $partesResultado = $parte['paginator'];
        $partesQueryCompleta =  $parte['query'];        

        $maxPages = ceil($parte['paginator']->count() / $limit);

        return $this->render('partes_interesadas/index.html.twig', [
            'partes'          => $partesResultado,
            'maxPages'        => $maxPages,
            'thisPage'        => $currentPage,
            'all_items'       => $partesQueryCompleta
        ]);
    }

    /**
     * @Route("/partes_interesadas/new/parte", name="partes_interesada_new")
     */
    public function new(Request $request)
    {        
        $parte = new PartesInteresadas();

        $form = $this->createForm(PartesInteresadasType::class, $parte);

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $user));
        //Cuestiones del usuario activo
        $tipos = $this->getDoctrine()
                               ->getRepository(TipoPartesInteresadas::class)
                               ->findBy(array('UnidadDeGestion' => $UUP[0]->getUnidad()->getId()));
        
        $form->add(
            'TipoParteInteresada',
            EntityType::class,
            array(
                'class'        => TipoPartesInteresadas::Class,
                'choices'      => $tipos,
                'choice_label' => 'nombre',                
                'label' => false,
            )
        );

        $form->handleRequest($request);

        //Comprueba si el form es valido
        if ($form->isSubmitted() && $form->isValid()) {

            $parte = $form->getData();
            //$parte->setTipoParteInteresada();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parte);
            $entityManager->flush();

            $this->addFlash('creado','Parte '.$parte->getNombre().' creada!');

            return $this->redirectToRoute('partes_interesadas');
        }

        return $this->render(
            'partes_interesadas/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

        /**
     * @Route("/partes_interesadas/edit/{id}", name="partes_interesada_edit")
     */
    public function edit($id, Request $request)
    {
        $parte = $this->getDoctrine()->getRepository(PartesInteresadas::class)->find($id);        

        $form = $this->createForm(PartesInteresadasType::class, $parte);

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $user));
        //Cuestiones del usuario activo
        $tipos = $this->getDoctrine()
                               ->getRepository(TipoPartesInteresadas::class)
                               ->findBy(array('UnidadDeGestion' => $UUP[0]->getUnidad()->getId()));
        
        $form->add(
            'TipoParteInteresada',
            EntityType::class,
            array(
                'class'        => TipoPartesInteresadas::Class,
                'choices'      => $tipos,
                'choice_label' => 'nombre',                
                'label' => false,
            )
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $parte = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parte);
            $entityManager->flush();

            return $this->redirectToRoute('partes_interesadas');
        }        

        return $this->render(
            'partes_interesadas/new.html.twig',
            [
                'form'  => $form->createView(),
                'title' => 'Editar parte',
            ]
        );

    }

    /**
     * @Route("/partes_interesadas/new/tipo/{nombre}", name="partes_tipo_new")
     */
    public function addTipo($nombre) {
        
        $tipo = new TipoPartesInteresadas();

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $user));        

        $unidadDeGestion = $this->getDoctrine()->getRepository(UnidadDeGestion::class)->find($UUP[0]->getUnidad()->getId());

        $tipo->setNombre($nombre);
        $tipo->setUnidadDeGestion($unidadDeGestion);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($tipo);
        $entityManager->flush();
        
        $response = new Response(
            $tipo->getNombre(),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );

        return $response;
    }

    /**
     * @Route("/partes/expectativa/new/{nombre}/{parte}", name="partes_expectativa_new")
     */
    public function addExpectativa($nombre, $parte) {
        $expectativa = new Expectativa();

        $parteInteresada = $this->getDoctrine()->getRepository(PartesInteresadas::class)->find($parte);

        $expectativa->setNombre($nombre);
        $expectativa->setParteInteresada($parteInteresada);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($expectativa);
        $entityManager->flush();

        $response = new Response(
            $expectativa->getNombre(),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );

        return $response;
    }
}
