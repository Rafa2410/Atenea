<?php

namespace App\Controller;

use App\Entity\UsuarioUnidadPermiso;
use App\Entity\UnidadDeGestion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TechnicalController extends AbstractController
{
    /**
     * @Route("/technical", name="technical")
     */
    public function index()
    {
        $user = $this->getUser()->getId();
        
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));
        //Empresas de la corporacion
        $unidad = $this->getDoctrine()
            ->getRepository(UnidadDeGestion::class)
            ->findBy(array('id' => $UUP[0]->getUnidad()->getId()));

        return $this->render('technical/index.html.twig', [
            'controller_name' => 'TechnicalController',
            'unidad' => $unidad,
        ]);
    }
}
