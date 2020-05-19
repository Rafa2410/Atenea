<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartesController extends AbstractController
{
    /**
     * @Route("/partes", name="partes")
     */
    public function index()
    {
        return $this->render('partes/index.html.twig', [
            'controller_name' => 'PartesController',
        ]);
    }
}
