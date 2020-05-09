<?php

namespace App\Controller;


use App\Form\UsuarioType;
use App\Entity\Usuario;
use App\Entity\Permisos;
use App\Entity\UsuarioUnidadPermiso;
use App\Entity\UnidadDeGestion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register/{id}", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, $id)
    {
      if(!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_SUPER')){
        throw $this->createAccessDeniedException('Permisos insuficientes');
      }

        // 1) build the form
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);            

            if($this->isGranted('ROLE_ADMIN')) {
              $user->setRoles(['ROLE_SUPER']);

              $permiso = $this->getDoctrine()
              ->getRepository(Permisos::class)
              ->findBy(array('tipo' => 'l'));

              $this->addFlash('creado','Superusuario '.$user->getNombre().' '.$user->getApellidos().' creado!');
            } else if ($this->isGranted('ROLE_SUPER')) {
              $user->setRoles(['ROLE_USER']);

              $permiso = $this->getDoctrine()
              ->getRepository(Permisos::class)
              ->findBy(array('tipo' => 'le'));

              $this->addFlash('creado','Usuario '.$user->getNombre().' '.$user->getApellidos().' creado!');
            }
            
            $unidad = $this->getDoctrine()
              ->getRepository(UnidadDeGestion::class)
              ->find($id);            

            $UUP = new UsuarioUnidadPermiso();
            $UUP->setUsuario($user);
            $UUP->setUnidad($unidad);
            $UUP->setPermiso($permiso[0]);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($UUP);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('mostrar_unidad', array('id' => $id));
        }

        return $this->render(
            'register/index.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/register/edit/{id}", name="register_edit")
    */    
    public function editar($id, Request $request, UserPasswordEncoderInterface $passwordEncoder) {
      $user = $this->getDoctrine()
        ->getRepository(Usuario::class)
        ->find($id);

      $form = $this->createForm(UsuarioType::class, $user);

      $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);            

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);            
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            $UUP = $this->getDoctrine()
              ->getRepository(UsuarioUnidadPermiso::class)
              ->findBy(array('usuario' => $id));
            
            $unidadId = $UUP[0]->getUnidad()->getId();
            
            return $this->redirectToRoute('mostrar_unidad', array('id' => $unidadId));
        }

        return $this->render('register/index.html.twig', [
          'form' => $form->createView()
      ]);
    }

    /**
     * @Route("/register/delete/{id}", name="register_delete")
    */    
    public function eliminar($id, Request $request) {
      $user = $this->getDoctrine()
        ->getRepository(Usuario::class)
        ->find($id);
        
      $UUP = $this->getDoctrine()
        ->getRepository(UsuarioUnidadPermiso::class)
        ->findBy(array('usuario' => $id));
      
      if ($user->getRoles()[0] == 'ROLE_SUPER') {
        $this->addFlash('eliminado','Superusuario '.$user->getNombre().' '.$user->getApellidos().' eliminado!');
      } else {
        $this->addFlash('eliminado','Usuario '.$user->getNombre().' '.$user->getApellidos().' eliminado!');
      }
      
      $em = $this->getDoctrine()->getManager();
      $em->remove($UUP[0]);
      $em->remove($user);
      $em->flush();

      $unidadId = $UUP[0]->getUnidad()->getId();

      return $this->redirectToRoute('mostrar_unidad', array('id' => $unidadId));
    }
}
