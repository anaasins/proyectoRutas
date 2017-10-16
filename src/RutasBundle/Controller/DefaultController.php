<?php

namespace RutasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
}
