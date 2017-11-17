<?php

namespace RutasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RutasBundle\Entity\ruta;
use RutasBundle\Form\rutaType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
      //devolver la clase para interactuar con la BBDD
        $repository = $this->getDoctrine()->getRepository(ruta::class);
      //sacar lo que queramos de la base de datos
        $rutas = $repository->findAll();
        return $this->render('RutasBundle:Default:index.html.twig', array('rutas'=>$rutas));
    }

    /**
     * @Route("/descripcionRuta", name="descripcionRuta")
     */
    public function descripcionRutaAction()
    {
        return $this->render('RutasBundle:Default:descripcionRuta.html.twig');
    }

    /**
     * @Route("/anadirRuta", name="anadirRuta")
     */
    public function anadirRutaAction(Request $request)
    {
      $rutas = new ruta();
      $form = $this->createForm(rutaType::class, $rutas);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
       $ruta = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($ruta);
        $em->flush();

       return $this->redirectToRoute('index');
   }
        return $this->render('RutasBundle:Default:anadirRuta.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/editarRuta/{id}", name="editarRuta")
     */
    public function editarRutaAction(Request $request, $id)
    {
      $ruta=$this->getDoctrine()->getRepository(ruta::class)->find($id);

      $form=$this->createForm(rutaType::class, $ruta);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {

         //$cerveza = $form->getData();
         $em = $this->getDoctrine()->getManager();
         $em->persist($ruta);
         $em->flush();

         return $this->redirectToRoute('index');
       }

      return $this->render('RutasBundle:Default:editarRuta.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/eliminarRuta/{id}", name="eliminarRuta")
     */
    public function eliminarRutaAction($id)
    {
      $db=$this->getDoctrine()->getManager();
      $eliminar = $db ->getRepository(ruta::class)->find($id);
      $db->remove($eliminar);
      $db->flush();
        return $this->redirectToRoute('index');
    }
}
