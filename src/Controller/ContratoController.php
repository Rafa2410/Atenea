<?php

namespace App\Controller;

use App\Entity\Contrato;
use App\Form\ContratoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ContratoController extends AbstractController
{
    /**
     * @Route("/contrato", name="contrato_list")
     */
    public function index(Request $request)
    {
        $contratos= $this->getDoctrine()->getRepository(Contrato::class)->findAll();
                        
        return $this->render('contrato/index.html.twig', [
            'contratos' => $contratos
        ]);
    }
    /**
     * @Route("/contrato/crear", name="nuevo_contrato")
     * @Method({"POST"})
     */
    public function crearContrato(Request $request) {
        $contrato = new Contrato();
        $form = $this->createForm(ContratoType::class, $contrato);

        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($contrato);
            $em->flush();

            return $this->redirectToRoute('lista_unidad');
        }

        return $this->render('contrato/create-index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/contrato/delete/{id}", name="contrato_delete")
     */
    public function delete($id, Request $request) {
        $contrato = $this->getDoctrine()
            ->getRepository(Contrato::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();        
        $entityManager->remove($contrato);
        $entityManager->flush();

        return $this->redirectToRoute('lista_unidad');
    }

    /**
     * @Route("/contrato/edit/{id}", name="contrato_edit")
     */
    public function editar($id, Request $request) {
        $contrato = $this->getDoctrine()
        ->getRepository(Contrato::class)
        ->find($id);

        $form = $this->createForm(ContratoType::class, $contrato);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($contrato);
            $em->flush();

            return $this->redirectToRoute('lista_unidad');
        }

        return $this->render('contrato/create-index.html.twig', [
            'form' => $form->createView(),
            'title' => 'Editar contrato',
        ]);
    }
}
