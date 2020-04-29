<?php

namespace App\Controller;

use App\Entity\UnidadDeGestion;
use App\Form\UnidadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UnidadController extends AbstractController
{
    /**
     * @Route("/unidad", name="unidad")
     */
    public function index(Request $request)
    {
        $unidad = new UnidadDeGestion();
        $form = $this->createForm(UnidadType::class, $unidad);
        
        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($unidad);
            $em->flush();

            return $this->redirectToRoute('administration');
        }

        return $this->render('unidad/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
