<?php

namespace App\Controller;

use App\Entity\ExpectativaPartesInteresadas;
use App\Entity\PartesInteresadas;
use App\Entity\TipoPartesInteresadas;
use App\Entity\UsuarioUnidadPermiso;
use App\Form\PartesInteresadasType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PartesController extends AbstractController
{
    /**
     * @Route("/partes", name="partes")
     */
    public function index()
    {
        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $user));
        //Cuestiones del usuario activo        
        $partesInteresadas = $this->getDoctrine()
                               ->getRepository(PartesInteresadas::class)
                               ->findBy(array('unidad_de_gestion' => $UUP[0]->getUnidad()->getId()));
        
        if (count($partesInteresadas) > 0) {        
            $tipos = $this->getDoctrine()
                        ->getRepository(TipoPartesInteresadas::Class)
                        ->findBy(array('parte_interesada' => $partesInteresadas[0]->getId()));

            $expectativas = $this->getDoctrine()
                                ->getRepository(ExpectativaPartesInteresadas::Class)
                                ->findBy(array('parte_interesada' => $partesInteresadas[0]->getId()));
        } else {
            $tipos = [];
            $expectativas = [];
        }

        return $this->render('partes/index.html.twig', [
            'partes' => $partesInteresadas,
            'tipos' => $tipos,
            'expectativas' => $expectativas
        ]);
    }

    /**
     * @Route("/partes/new", name="partes_new")
     */
    public function addParte(Request $request) {
        $parte = new PartesInteresadas();

        $form = $this->createForm(PartesInteresadasType::class, $parte);

        //Obtener el id del usuario para saber a que corporacion pertenece
        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $user));

        $form->handleRequest($request);

        //Comprueba si el form es valido
        if ($form->isSubmitted() && $form->isValid()) {

            $parte = $form->getData();
            $parte->setUnidadDeGestion($UUP[0]->getUnidad());
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parte);
            $entityManager->flush();

            $this->addFlash('creado','Parte interesada '.$parte->getNombre().' creada!');

            return $this->redirectToRoute('partes');

        }

        return $this->render(
            'partes/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     *  @Route("/partes/edit/{id}", name="partes_edit")
     */
    public function edit($id, Request $request) {
        $parte = $this->getDoctrine()->getRepository(PartesInteresadas::class)->find($id);

        $form = $this->createForm(PartesInteresadasType::class, $parte);

        $form->handleRequest($request);

        //Comprueba si el form es valido
        if ($form->isSubmitted() && $form->isValid()) {

            $parte = $form->getData();            
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parte);
            $entityManager->flush();            

            return $this->redirectToRoute('partes');

        }

        return $this->render(
            'partes/edit.html.twig',
            [
                'form'  => $form->createView()
            ]
        );
    }

    /**
     * @Route("/partes/tipo/new/{nombre}/{parte}", name="partes_tipo_new")
     */
    public function addTipo($nombre, $parte) {
        $tipo = new TipoPartesInteresadas();

        $parteInteresada = $this->getDoctrine()->getRepository(PartesInteresadas::class)->find($parte);

        $tipo->setNombre($nombre);
        $tipo->setParteInteresada($parteInteresada);
        

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($tipo);
        $entityManager->flush();

        $this->addFlash('creado','Tipo '.$tipo->getNombre().' creado!');
    }

    /**
     * @Route("/partes/expectativa/new/{nombre}/{parte}", name="partes_tipo_new")
     */
    public function addExpectativa($nombre, $parte) {
        $expectativa = new ExpectativaPartesInteresadas();

        $parteInteresada = $this->getDoctrine()->getRepository(PartesInteresadas::class)->find($parte);

        $expectativa->setNombre($nombre);
        $expectativa->setParteInteresada($parteInteresada);
        

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($expectativa);
        $entityManager->flush();

        $this->addFlash('creado','Expectativa '.$expectativa->getNombre().' creado!');
    }
}
