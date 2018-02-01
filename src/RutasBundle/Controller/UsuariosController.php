<?php

namespace RutasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RutasBundle\Entity\ruta;
use RutasBundle\Form\rutaType;
use RutasBundle\Entity\usuario;
use RutasBundle\Form\usuarioType;
use RutasBundle\Form\editarUsuarioType;
use Symfony\Component\HttpFoundation\Request;

class UsuariosController extends Controller
{
      /**
       * @Route("/gestionUsuarios/registro", name="registro")
       */
      public function registroAction(Request $request)
      {
          // 1) build the form
          $user = new usuario();
          $form = $this->createForm(usuarioType::class, $user);

          // 2) handle the submit (will only happen on POST)
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {

              // 3) Encode the password (you could also do this via Doctrine listener)
              $password = $this->get('security.password_encoder')
                  ->encodePassword($user, $user->getPlainPassword());
              $user->setPassword($password);

              // 4) save the User!
              $roles = ["ROLE_ADMIN"];
              $user->setRoles($roles);
              $em = $this->getDoctrine()->getManager();
              $em->persist($user);
              $em->flush();

              // ... do any other work - like sending them an email, etc
              // maybe set a "flash" success message for the user

              return $this->redirectToRoute('listaUsuarios');
          }

          return $this->render(
              'RutasBundle:Default:register.html.twig',
              array('form' => $form->createView())
          );
      }

      /**
       * @Route("/usuarios", name="usuarios")
       */
      public function usuariosAction()
      {
        //devolver la clase para interactuar con la BBDD
          $repository = $this->getDoctrine()->getRepository(ruta::class);
        //sacar lo que queramos de la base de datos
          $rutas = $repository->findAll();
          return $this->render('RutasBundle:Default:index.html.twig', array('rutas'=>$rutas));
      }

    /**
     * @Route("/usuarios/login", name="login")
     */
    public function loginAction(Request $request)
    {
      $authenticationUtils = $this->get('security.authentication_utils');

      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('RutasBundle:Default:login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));
    }

    /**
     * @Route("/gestionUsuarios/lista", name="listaUsuarios")
     */
    public function listaAction()
    {
      //devolver la clase para interactuar con la BBDD
        $repository = $this->getDoctrine()->getRepository(usuario::class);
      //sacar lo que queramos de la base de datos
        $usuarios = $repository->findAll();
        return $this->render('RutasBundle:Default:listaUsuarios.html.twig', array('usuarios'=>$usuarios));
    }

    /**
     * @Route("/gestionUsuarios/editar/{id}", name="editarUsuario")
     */
    public function editarAction(Request $request, $id)
    {
      $usuario=$this->getDoctrine()->getRepository(usuario::class)->find($id);

      $form=$this->createForm(editarUsuarioType::class, $usuario);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {

         //$cerveza = $form->getData();
         $em = $this->getDoctrine()->getManager();
         $em->persist($usuario);
         $em->flush();

         return $this->redirectToRoute('listaUsuarios');
       }

      return $this->render('RutasBundle:Default:editarUsuario.html.twig', array('form'=>$form->createView()));
    }


        /**
         * @Route("/gestionUsuarios/eliminar/{id}", name="eliminarUsuario")
         */
        public function eliminarAction($id)
        {
          $db=$this->getDoctrine()->getManager();
          $eliminar = $db ->getRepository(usuario::class)->find($id);
          $db->remove($eliminar);
          $db->flush();
            return $this->redirectToRoute('listaUsuarios');
        }
}
