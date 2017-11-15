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
     * @Route("/")
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

       return $this->render('RutasBundle:Default:index.html.twig');
   }
        return $this->render('RutasBundle:Default:anadirRuta.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/editarRuta", name="editarRuta")
     */
    public function editarRutaAction()
    {
        return $this->render('RutasBundle:Default:editarRuta.html.twig');
    }

    /**
     * @Route("/rutasPropias", name="rutasPropias")
     */
    public function rutasPropiasAction()
    {
        return $this->render('RutasBundle:Default:rutasPropias.html.twig');
    }
}
