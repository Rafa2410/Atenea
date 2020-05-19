<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TipoPartesInteresadesController extends AbstractController
{
    /**
     * @Route("/tipo/partes/interesades", name="tipo_partes_interesades")
     */
    public function index()
    {
        return $this->render('tipo_partes_interesades/index.html.twig', [
            'controller_name' => 'TipoPartesInteresadesController',
        ]);
    }
}
