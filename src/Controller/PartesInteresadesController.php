<?php

namespace App\Controller;

use App\Entity\Expectativa;
use App\Entity\PartesInteresadas;
use App\Entity\TipoPartesInteresadas;
use App\Entity\UsuarioUnidadPermiso;
use App\Form\PartesInteresadasType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PartesInteresadesController extends AbstractController
{
    /**
     * @Route("/partes_interesadas", name="partes_interesadas")
     */
    public function index()
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
                $partes = $this->getDoctrine()
                        ->getRepository(PartesInteresadas::Class)
                        ->findBy(array('TipoParteInteresada' => $tipo->getId()));
                array_push($partesResult, $partes);
            }
            
        } else {
            $partesResult = [];            
        }

        return $this->render('partes_interesadas/index.html.twig', [
            'partes' => $partesResult
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
}
