<?php

namespace App\Controller;

use App\Entity\Contrato;
use App\Entity\UnidadDeGestion;
use App\Entity\UsuarioUnidadPermiso;
use App\Form\UnidadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UnidadController extends AbstractController
{
    /**
     * @Route("/unidad", name="lista_unidad")
     */
    public function index()
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $unidades = $this->getDoctrine()->getRepository(UnidadDeGestion::class)->findAll();

            return $this->render(
                'unidad/admin/index.html.twig',
                array
                (
                    'unidades' => $unidades,
                )
            );
        } elseif ($this->isGranted('ROLE_SUPER')) {
            return $this->indexSuperUser();
        }
    }

    /**
     * @Route("/unidad/crear", name="nueva_unidad")
     */
    public function crearUnidad(Request $request)
    {
        $unidad = new UnidadDeGestion();
        $form   = $this->createForm(UnidadType::class, $unidad);

        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            if ($unidad->getTipo() == 1) {
                $unidad->setUnidadDeGestion(null);
                $this->addFlash('creado', 'Corporación '.$unidad->getNombre().' creada!');
            } elseif ($unidad->getTipo() == 2) {
                $this->addFlash('creado', 'Empresa '.$unidad->getNombre().' creada!');
            } else {
                $this->addFlash('creado', 'Emplazamiento '.$unidad->getNombre().' creado!');
            }

            $em->persist($unidad);
            $em->flush();

            return $this->redirectToRoute('lista_unidad');
        }

        return $this->render(
            'unidad/admin/create-index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/unidad/{id}", name="mostrar_unidad")
     */
    public function mostrar($id)
    {
        $unidad = $this->getDoctrine()
                       ->getRepository(UnidadDeGestion::class)->find($id);

        if ($this->isGranted('ROLE_ADMIN')) {
            $contrato = $this->getDoctrine()
                             ->getRepository(Contrato::class)
                             ->findBy(array('unidad_id' => $id));

            $empresas = $this->getDoctrine()
                             ->getRepository(UnidadDeGestion::class)
                             ->findBy(array('unidadDeGestion' => $id));

            $superusuarios = $this->getDoctrine()
                                  ->getRepository(UsuarioUnidadPermiso::class)
                                  ->findBy(array('unidad' => $id));

            return $this->render(
                'unidad/admin/mostrar.html.twig',
                [
                    'unidad'        => $unidad,
                    'contrato'      => $contrato,
                    'empresas'      => $empresas,
                    'superusuarios' => $superusuarios,
                ]
            );
        } elseif ($this->isGranted('ROLE_SUPER')) {
            $usuarios = $this->getDoctrine()
                             ->getRepository(UsuarioUnidadPermiso::class)
                             ->findBy(array('unidad' => $id));

            return $this->render(
                'unidad/super/mostrar.html.twig',
                [
                    'unidad'   => $unidad,
                    'usuarios' => $usuarios,
                ]
            );
        }
    }

    /**
     * @Route("/unidad/eliminar/{id}", name="unidad_delete")
     */
    public function eliminarUnidad(Request $request, $id)
    {
        $unidad     = $this->getDoctrine()->getRepository(UnidadDeGestion::class)->find($id);
        /*$repository = $this->getDoctrine()->getRepository(Contrato::class);

        $contrato = $repository->findOneBy(
            ['unidad_id' => $id]
        );*/

        /*var_dump($contrato[0]->getUnidadId()->getNombre());*/
        $em = $this->getDoctrine()->getManager();

       /* $em->remove($contrato);
        $em->flush();*/
        $em->remove($unidad);
        $em->flush();

        if ($unidad->getTipo() == 1) {
            $this->addFlash('eliminado', 'Corporación '.$unidad->getNombre().' eliminada!');
        } elseif ($unidad->getTipo() == 2) {
            $this->addFlash('eliminado', 'Empresa '.$unidad->getNombre().' eliminada!');
        } else {
            $this->addFlash('eliminado', 'Emplazamiento '.$unidad->getNombre().' eliminado!');
        }

        return $this->redirectToRoute('lista_unidad');
    }

    /**
     * @Route("/unidad/editar/{id}", name="unidad_edit")
     */
    public function editar($id, Request $request)
    {
        $unidad = $this->getDoctrine()->getRepository(UnidadDeGestion::class)->find($id);

        $form = $this->createForm(UnidadType::class, $unidad);

        //handle request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Guardar en la bbdd
            $em = $this->getDoctrine()->getManager();

            if ($unidad->getTipo() == 1) {
                $unidad->setUnidadDeGestion(null);
                $this->addFlash('editado', 'Corporación '.$unidad->getNombre().' editada!');
            } elseif ($unidad->getTipo() == 2) {
                $this->addFlash('editado', 'Empresa '.$unidad->getNombre().' editada!');
            } else {
                $this->addFlash('editado', 'Emplazamiento '.$unidad->getNombre().' editado!');
            }

            $em->persist($unidad);
            $em->flush();

            return $this->redirectToRoute('lista_unidad');
        }

        return $this->render(
            'unidad/admin/create-index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    public function indexSuperUser()
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

        $empresas = $this->getDoctrine()
                         ->getRepository(UnidadDeGestion::class)
                         ->findBy(array('unidadDeGestion' => $UUP[0]->getUnidad()->getId()));

        //Devolvemos la corporacion con sus empresas
        return $this->render(
            'unidad/super/index.html.twig',
            array
            (
                'unidad'   => $unidad,
                'empresas' => $empresas,
            )
        );
    }
}
