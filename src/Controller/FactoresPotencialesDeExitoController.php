<?php

namespace App\Controller;

use App\Entity\Aspecto;
use App\Entity\FactoresPotencialesDeExito;
use App\Entity\UsuarioUnidadPermiso;
use App\Entity\CuestionUnidad;
use App\Form\FactoresCriticosDeExitoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FactoresPotencialesDeExitoController extends AbstractController
{
    /**
     * @Route("/factores/potenciales/de/exito", name="factores_potenciales_de_exito")
     */
    public function index()
    {
        $fpe = $this->getDoctrine()->getRepository(FactoresPotencialesDeExito::Class)->findAll();

        $fpeResult = [];

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));
        
        $factorNombre = '';

        foreach ($fpe as $key => $factor) {            
            foreach ($factor->getAspecto() as $key => $aspecto) {
                foreach ($aspecto->getCuestiones() as $key => $cuestion) {
                    foreach($cuestion->getCuestionUnidads() as $key => $unidad) {
                        if ($unidad->getUnidad()->getId() == $UUP[0]->getUnidad()->getId() && $factorNombre != $factor->getDescripcion()) {
                            array_push($fpeResult, $factor);
                            $factorNombre = $factor->getDescripcion();
                        }
                    }
                }
            }
        }        
        
        return $this->render(
            'factores_potenciales_de_exito/index.html.twig',
            [
                'controller_name' => 'FactoresPotencialesDeExitoController',
                'fpe'             => $fpeResult,
            ]
        );
    }

    /**
     * @Route("/factores/potenciales/de/exito/new", name="factores_potenciales_de_exito_new")
     */
    public function new(Request $request)
    {

        $fce = new FactoresPotencialesDeExito();

        $form = $this->createForm(FactoresCriticosDeExitoType::class, $fce);        

        //Busco aspectos favorables y desfavorables        
        $aspectosFav = $this->getDoctrine()->getRepository(Aspecto::Class)->findBy(['favorable' => 1]);
        $aspectosDes = $this->getDoctrine()->getRepository(Aspecto::Class)->findBy(['favorable' => 0]);        

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));
        
        $aspectosFavResult = [];
        $aspectosDesResult = [];

        foreach ($aspectosFav as $key => $aspecto) {
            foreach($aspecto->getCuestiones() as $key2 => $cuestion) {
                foreach($cuestion->getCuestionUnidads() as $key3 => $unidad) {
                    if($unidad->getUnidad()->getId() == $UUP[0]->getUnidad()->getId()) {
                        array_push($aspectosFavResult, $aspecto);
                    }
                }
            }
        }

        foreach ($aspectosDes as $key => $aspecto) {
            foreach($aspecto->getCuestiones() as $key2 => $cuestion) {
                foreach($cuestion->getCuestionUnidads() as $key3 => $unidad) {
                    if($unidad->getUnidad()->getId() == $UUP[0]->getUnidad()->getId()) {
                        array_push($aspectosDesResult, $aspecto);
                    }
                }
            }
        }
        
        //Aspectos sobreescribo el form con las aspectos adecuados a mostrar
        $form->add(
            'aspectosFav',
            EntityType::class,
            array(
                'class'        => Aspecto::Class,
                'choices'      => $aspectosFavResult,
                'choice_label' => 'descripcion',
                'multiple'     => true,
                'label' => false,
            )
        );

        $form->add(
            'aspectosDes',
            EntityType::class,
            array(
                'class'        => Aspecto::Class,
                'choices'      => $aspectosDesResult,
                'choice_label' => 'descripcion',
                'multiple'     => true,
                'label' => false,
            )
        );

        $form->handleRequest($request);

        //Comprueba si el form es valido
        if ($form->isSubmitted() && $form->isValid()) {

            $fce         = $form->getData();
            $aspectosFav = $fce->getAspectosFav();
            $aspectosDes = $fce->getAspectosDes();

            foreach ($aspectosFav as $aspectoFav) {
                $fce->addAspecto($aspectoFav);
            }

            foreach ($aspectosDes as $aspectoDes) {
                $fce->addAspecto($aspectoDes);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fce);
            $entityManager->flush();

            $this->addFlash('creado','Factor '.$fce->getDescripcion().' creado!');

            return $this->redirectToRoute('factores_potenciales_de_exito');

        }        

        return $this->render(
            'factores_potenciales_de_exito/new.html.twig',
            [
                'form'        => $form->createView(),
            ]
        );

    }

    /**
     * @Route("/factores/potenciales/de/exito/edit/{id}", name="factores_potenciales_de_exito_edit")
     */
    public function edit($id, Request $request)
    {
        $fce = $this->getDoctrine()->getRepository(FactoresPotencialesDeExito::class)->find($id);

        $form = $this->createForm(FactoresCriticosDeExitoType::class, $fce, array('allow_extra_fields' =>true));

        $form->handleRequest($request);
        
        //Comprueba si el form es valido
        if ($form->isSubmitted() && $form->isValid()) {

            $fce = $form->getData();
            $aspectosFav = $request->request->get('factores_criticos_de_exito')['aspectosFav'];
            $aspectosDes = $request->request->get('factores_criticos_de_exito')['aspectosDes'];
            
            foreach ($aspectosFav as $aspectoFav) {
                $aspecto = $this->getDoctrine()->getRepository(Aspecto::class)->find((int)$aspectoFav);
                $fce->addAspecto($aspecto);                
            }
            
            foreach ($aspectosDes as $aspectoDes) {
                $aspecto = $this->getDoctrine()->getRepository(Aspecto::class)->find((int)$aspectoDes);    
                $fce->addAspecto($aspecto);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fce);
            $entityManager->flush();

            return $this->redirectToRoute('factores_potenciales_de_exito');

        }
        //Busco aspectos favorables y desfavorables        
        $aspectosFav = $this->getDoctrine()->getRepository(Aspecto::Class)->findBy(['favorable' => 1]);
        $aspectosDes = $this->getDoctrine()->getRepository(Aspecto::Class)->findBy(['favorable' => 0]);

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));
        
        $aspectosFavResult = [];
        $aspectosDesResult = [];

        foreach ($aspectosFav as $key => $aspecto) {
            foreach($aspecto->getCuestiones() as $key2 => $cuestion) {
                foreach($cuestion->getCuestionUnidads() as $key3 => $unidad) {
                    if($unidad->getUnidad()->getId() == $UUP[0]->getUnidad()->getId()) {
                        array_push($aspectosFavResult, $aspecto);
                    }
                }
            }
        }

        foreach ($aspectosDes as $key => $aspecto) {
            foreach($aspecto->getCuestiones() as $key2 => $cuestion) {
                foreach($cuestion->getCuestionUnidads() as $key3 => $unidad) {
                    if($unidad->getUnidad()->getId() == $UUP[0]->getUnidad()->getId()) {
                        array_push($aspectosDesResult, $aspecto);
                    }
                }
            }
        }
        
        //Aspectos sobreescribo el form con las aspectos adecuados a mostrar
        return $this->render(
            'factores_potenciales_de_exito/edit.html.twig',
            [
                'form' => $form->createView(),                
                'aspectosFav' => $aspectosFavResult,
                'aspectosDes' => $aspectosDesResult,
                'fce' => $fce
            ]
        );

    }


    /**
     * @Route("/factores/potenciales/de/exito/delete/{id}", name="factores_potenciales_de_exito_delete")
     */
    public function delete($id, Request $request)
    {
        $fce = $this->getDoctrine()->getRepository(FactoresPotencialesDeExito::Class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($fce);
        $em->flush();

        $this->addFlash('eliminado','Factor '.$fce->getDescripcion().' eliminado!');

        /*return $this->render(
            'factores_potenciales_de_exito/index.html.twig',
            [
                'controller_name' => 'FactoresPotencialesDeExitoController',
                'fpe'             => $fce,
            ]
        );*/
        return $this->redirectToRoute('factores_potenciales_de_exito');
    }

}
