<?php

namespace App\Controller;

use App\Entity\Aspecto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DafoController extends AbstractController
{
    /**
     * @Route("/dafo", name="dafo")
     */
    public function index()
    {
        $aspectos = $this->getDoctrine()->getRepository(Aspecto::Class)->findAll();

        return $this->render('dafo/index.html.twig', [
            'aspectos' => $aspectos,
        ]);
    }
}
