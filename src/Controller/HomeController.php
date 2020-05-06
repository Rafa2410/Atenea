<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        if(!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_SUPER') && !$this->isGranted('ROLE_USER')){
          throw $this->createAccessDeniedException('Inicia sesión');
        }

        if($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_SUPER')) {
            return $this->redirectToRoute('lista_unidad');
        }

        if($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('technical');
        }
        /*return $this->render('technical/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);*/
    }
}
