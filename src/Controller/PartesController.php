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

        $tipos = $this->getDoctrine()
                        ->getRepository(TipoPartesInteresadas::Class)
                        ->findAll();
        
        $expectativas = $this->getDoctrine()
                        ->getRepository(ExpectativaPartesInteresadas::Class)
                        ->findAll();

        $tiposResult = [];
        $expectativasResult = [];

        foreach ($tipos as $key => $tipo) {
            if ($tipo->getParteInteresada()->getUnidadDeGestion()->getId() ==  $UUP[0]->getUnidad()->getId()) {
                array_push($tiposResult, $tipo);
            }
        }
        foreach ($expectativas as $key => $expectativa) {
            if ($expectativa->getParteInteresada()->getUnidadDeGestion()->getId() ==  $UUP[0]->getUnidad()->getId()) {
                array_push($expectativasResult, $expectativa);
            }
        }
        
        //Aspectos sobreescribo el form con las aspectos adecuados a mostrar
        $form->add(
            'tipoPartesInteresadas',
            EntityType::class,
            array(
                'class'        => TipoPartesInteresadas::Class,
                'choices'      => $tiposResult,
                'choice_label' => 'nombre',
                'multiple'  => true,
                'label' => false,
            )
        );

        $form->add(
            'expectativaPartesInteresadas',
            EntityType::class,
            array(
                'class'        => ExpectativaPartesInteresadas::Class,
                'choices'      => $expectativasResult,
                'choice_label' => 'nombre',
                'multiple' => true,
                'label' => false,
            )
        );

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
}
