<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TechnicalController extends AbstractController
{
    /**
     * @Route("/technical", name="technical")
     */
    public function index()
    {
        return $this->render('technical/index.html.twig', [
            'controller_name' => 'TechnicalController',
        ]);
    }
}
