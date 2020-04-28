<?php

namespace App\Controller;

use App\Entity\Corporacion;
use App\Form\CorporacionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CorporacionController extends AbstractController
{
    /**
     * @Route("/corporacion", name="corporacion")
     */
    public function index(Request $request)
    {
        $corporacion = new Corporacion();
        $form = $this->createForm(CorporacionType::class, $corporacion);

        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($corporacion);
            $em->flush();

            return $this->redirectToRoute('administration');
        }

        return $this->render('corporacion/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
