<?php

namespace App\Controller;

use App\Entity\Contrato;
use App\Form\ContratoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContratoController extends AbstractController
{
    /**
     * @Route("/contrato", name="contrato")
     */
    public function index(Request $request)
    {
        $contrato = new Contrato();
        $form = $this->createForm(ContratoType::class, $contrato);

        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($contrato);
            $em->flush();

            return $this->redirectToRoute('administration');
        }

        return $this->render('contrato/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
