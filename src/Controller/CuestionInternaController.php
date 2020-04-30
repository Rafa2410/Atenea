<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CuestionInternaController extends AbstractController
{
    /**
     * @Route("/cuestion/interna", name="cuestion_interna")
     */
    public function index()
    {
        return $this->render('cuestion_interna/index.html.twig', [
            'controller_name' => 'CuestionInternaController',
        ]);
    }
}
