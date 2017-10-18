<?php

namespace RutasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RutasBundle\Entity\ruta;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('RutasBundle:Default:index.html.twig');
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
    public function anadirRutaAction()
    {
        return $this->render('RutasBundle:Default:anadirRuta.html.twig');
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
    /**
     * @Route("/index", name="listaIndex")
     */
    public function listaIndexAction()
    {
      //devolver la clase para interactuar con la BBDD
        $repository = $this->getDoctrine()->getRepository(ruta::class);
      //sacar lo que queramos de la base de datos
        $rutas = $repository->findAll();
        return $this->render('RutasBundle:Default:index.html.twig', array('rutas'=>$rutas));
    }
}
