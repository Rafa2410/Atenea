<?php

namespace App\Controller;

use App\Entity\UnidadDeGestion;
use App\Form\UnidadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UnidadController extends AbstractController
{
    /**
     * @Route("/unidad", name="lista_unidad")
     */
    public function index()
    {        
        $unidades= $this->getDoctrine()->getRepository(UnidadDeGestion::class)->findAll();

        return $this->render('unidad/index.html.twig', array
        ('unidades' => $unidades));
    }

    /**
     * @Route("/unidad/crear", name="nueva_unidad")
     * @Method({"POST"})
     */
    public function crearUnidad(Request $request) {
        $unidad = new UnidadDeGestion();
        $form = $this->createForm(UnidadType::class, $unidad);
        
        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($unidad);
            $em->flush();

            return $this->redirectToRoute('lista_unidad');
        }

        return $this->render('unidad/create-index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/unidad/{id}", name="mostrar_unidad")
     */
    public function mostrar($id) {
        $unidad = $this->getDoctrine()->getRepository(UnidadDeGestion::class)->find($id);

        return $this->render('unidad/mostrar.html.twig', array
        ('unidad' => $unidad));
    }

    /**
     * @Route("/unidad/eliminar/{id}", name="unidad_delete")
     * @Method({"DELETE"})
     */
    public function eliminarUnidad(Request $request, $id) {        
        $unidad = $this->getDoctrine()->getRepository(UnidadDeGestion::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($unidad);
        $em->flush();

        /*$response = new Response();
        $response->send();*/

        return $this->redirectToRoute('lista_unidad');
    }

    /**
     * @Route("/unidad/editar/{id}", name="unidad_edit")
     */
    public function editar($id, Request $request) {
        $unidad = $this->getDoctrine()->getRepository(UnidadDeGestion::class)->find($id);

        $form = $this->createForm(UnidadType::class, $unidad);
        
        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($unidad);
            $em->flush();

            return $this->redirectToRoute('lista_unidad');
        }

        return $this->render('unidad/create-index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
