<?php

namespace App\Controller;


use App\Entity\Permisos;
use App\Entity\UnidadDeGestion;
use App\Entity\Usuario;
use App\Entity\UsuarioUnidadPermiso;
use App\Form\UsuarioType;
use Swift_Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegisterController extends AbstractController
{
    /**
     * @Route("/register/{id}", name="register")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        $id,
        \Swift_Mailer $mailer
    ) {
        if ( ! $this->isGranted('ROLE_ADMIN') && ! $this->isGranted('ROLE_SUPER')) {
            throw $this->createAccessDeniedException('Permisos insuficientes');
        }

        // 1) build the form
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $userEncontrado = $this->getDoctrine()
                 ->getRepository(Usuario::class)
                 ->findBy(array('email' => $data->getEmail()));
            if(isset($userEncontrado[0])){
                if ($data->getEmail() == $userEncontrado[0]->getEmail()) {
                    $this->addFlash('correoRepetido', 'El correo '.$data->getEmail().' ya existe!');

                    return $this->redirectToRoute('register', array('id' => $id));
                }
            }


            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            if ($this->isGranted('ROLE_ADMIN')) {
                $user->setRoles(['ROLE_SUPER']);

                $permiso = $this->getDoctrine()
                                ->getRepository(Permisos::class)
                                ->findBy(array('tipo' => 'l'));

                $this->addFlash('creado', 'Superusuario '.$user->getNombre().' '.$user->getApellidos().' creado!');
            } elseif ($this->isGranted('ROLE_SUPER')) {
                $user->setRoles(['ROLE_USER']);

                $permiso = $this->getDoctrine()
                                ->getRepository(Permisos::class)
                                ->findBy(array('tipo' => 'le'));

                $this->addFlash('creado', 'Usuario '.$user->getNombre().' '.$user->getApellidos().' creado!');
            }

            $unidad = $this->getDoctrine()
                           ->getRepository(UnidadDeGestion::class)
                           ->find($id);

            $UUP = new UsuarioUnidadPermiso();
            $UUP->setUsuario($user);
            $UUP->setUnidad($unidad);
            $UUP->setPermiso($permiso[0]);

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $datos = $form->getData();

            //Encriptamos el correo para poder enviar por la url el email para cambiar la contraseña
            $email = $datos->getEmail();

            $hashed_user = crypt($email, '90985f2a86c2664dd1a2558843483d6f');
            $email_md5 = md5($hashed_user);


            $message = (new \Swift_Message('Bienvenido a Atenea'))
                ->setFrom('noreplyatenea@gmail.com')
                ->setTo($datos->getEmail())
                ->attach(Swift_Attachment::fromPath('images/atenea.jpg'))
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/registration.html.twig',
                        [
                            'name'       => $datos->getNombre(),
                            'surname'    => $datos->getApellidos(),
                            'encriptado' => $email_md5,
                            'email'      => $email,
                        ]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($UUP);
            $entityManager->flush();

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
    public function editar($id, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
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

        return $this->render(
            'register/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/register/delete/{id}", name="register_delete")
     */
    public function eliminar($id, Request $request)
    {
        $user = $this->getDoctrine()
                     ->getRepository(Usuario::class)
                     ->find($id);

        $UUP = $this->getDoctrine()
                    ->getRepository(UsuarioUnidadPermiso::class)
                    ->findBy(array('usuario' => $id));

        if ($user->getRoles()[0] == 'ROLE_SUPER') {
            $this->addFlash('eliminado', 'Superusuario '.$user->getNombre().' '.$user->getApellidos().' eliminado!');
        } else {
            $this->addFlash('eliminado', 'Usuario '.$user->getNombre().' '.$user->getApellidos().' eliminado!');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($UUP[0]);
        $em->remove($user);
        $em->flush();

        $unidadId = $UUP[0]->getUnidad()->getId();

        return $this->redirectToRoute('mostrar_unidad', array('id' => $unidadId));
    }


    /**
     * @Route("/password/{email}/{encriptado}", name="password")
     */
    public function newPassword($email, $encriptado, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getDoctrine()
                     ->getRepository(Usuario::class)
                     ->findBy(array('email' => $email));

        $hashed_user = crypt($email, '90985f2a86c2664dd1a2558843483d6f');
        $email_md5 = md5($hashed_user);


        if (hash_equals($email_md5, $encriptado) && $user[0] != null) {
            $form = $this->createForm(UsuarioType::class, $user[0]);
        } else {
            $this->addFlash('passwordError', 'Ha ocurrido un error!');

            return $this->redirectToRoute('app_login');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user[0], $user[0]->getPassword());
            $user[0]->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user[0]);
            $entityManager->flush();

            $this->addFlash('passwordCorrecto', 'Se ha modificado correctamente!');

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'register/new-password.html.twig',
            [
                'form'  => $form->createView(),
                'email' => $email,
            ]
        );
    }

    /**
     * @Route("/index/password", name="index_password")
     */
    public function indexPassword()
    {
        return $this->render(
            'register/change-password.html.twig'
        );
    }

    /**
     * @Route("/change/password", name="change_password")
     */
    public function changePassword(Request $request,\Swift_Mailer $mailer)
    {
        //comprueba si recibe el email

        //var_dump($_POST['email']);
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $user = $this->getDoctrine()
                         ->getRepository(Usuario::class)
                         ->findBy(array('email' => $email));

            //comprueba si existe el usuario con ese email
            if (isset($user[0])) {
                $hashed_user = crypt($email, '90985f2a86c2664dd1a2558843483d6f');
                $email_md5 = md5($hashed_user);

                $message = (new \Swift_Message('Bienvenido a Atenea'))
                    ->setFrom('noreplyatenea@gmail.com')
                    ->setTo($email)
                    ->attach(Swift_Attachment::fromPath('images/atenea.jpg'))
                    ->setBody(
                        $this->renderView(
                            'emails/change_password.html.twig',
                            [
                                'encriptado' => $email_md5,
                                'email'      => $email,
                            ]
                        ),
                        'text/html'
                    );

                $mailer->send($message);
                $this->addFlash('email_encontrado', 'Se te ha enviado un correo a '.$email.'!');
                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('userError', 'El usuario no existe!');

                return $this->redirectToRoute('app_login');
            }
        }else{
            $this->addFlash('noencontrado', 'No se ha encontrado el usuario');
            return $this->redirectToRoute('app_login');
        }
    }
}
