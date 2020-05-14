<?php

namespace App\Controller;

use App\Entity\Aspecto;
use App\Entity\UsuarioUnidadPermiso;
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

        $aspectosResult = [];

        $user = $this->getUser()->getId();
        //Tabla usuario_unidad_permiso
        $UUP = $this->getDoctrine()
            ->getRepository(UsuarioUnidadPermiso::class)
            ->findBy(array('usuario' => $user));

        foreach ($aspectos as $key => $aspecto) {
            foreach ($aspecto->getCuestiones() as $key => $cuestion) {
                foreach ($cuestion->getCuestionUnidads() as $key => $unidad) {
                    if ($unidad->getUnidad()->getId() == $UUP[0]->getUnidad()->getId()) {
                        array_push($aspectosResult, $aspecto);
                    }                    
                }
            }
        }
        
        return $this->render('dafo/index.html.twig', [
            'aspectos' => $aspectosResult,
        ]);
    }

    /**
     * @Route("/dafo/{id}", name="dafo_super")
     */
    public function indexSuper($id)
    {
        $aspectos = $this->getDoctrine()->getRepository(Aspecto::Class)->findAll();

        $aspectosResult = [];
        
        foreach ($aspectos as $key => $aspecto) {
            foreach ($aspecto->getCuestiones() as $key => $cuestion) {
                foreach ($cuestion->getCuestionUnidads() as $key => $unidad) {
                    if ($unidad->getUnidad()->getId() == $id) {
                        array_push($aspectosResult, $aspecto);
                    }                    
                }
            }
        }
        
        return $this->render('dafo/index.html.twig', [
            'aspectos' => $aspectosResult,
        ]);
    }
}
