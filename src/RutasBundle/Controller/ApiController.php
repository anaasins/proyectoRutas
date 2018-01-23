<?php

namespace RutasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RutasBundle\Entity\ruta;
use RutasBundle\Form\rutaType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    /**
     * @Route("/api/anadirRuta", name="anadirRutaAPI")
     * @Method({"POST"})
     */
    public function anadirRutaAPIAction(Request $request)
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
     * @Route("/api/editarRuta/{id}", name="editarRutaAPI")
     * @Method({"PUT"})
     */
    public function editarRutaAPIAction(Request $request, $id)
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
     * @Route("/api/eliminarRuta/{id}", name="eliminarRutaAPI")
     * @Method({"DELETE"})
     */
    public function eliminarRutaAPIAction($id)
    {
      $db=$this->getDoctrine()->getManager();
      $eliminar = $db ->getRepository(ruta::class)->find($id);
      $db->remove($eliminar);
      $db->flush();
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/api/mostrarId/{id}", name="mostrarIdAPI")
     * @Method({"GET"})
     */
    public function mostrarIdAPIAction($id)
    {
      //devolver la clase para interactuar con la BBDD
        $repository = $this->getDoctrine()->getRepository(ruta::class);
      //sacar lo que queramos de la base de datos
        $rutas = $repository->findOneById($id);

        $response = new JsonResponse($rutas);
        return $response;
    }

    /**
     * @Route("/api", name="api")
     * @Method("GET")
     */
    public function apiAction()
    {
      //devolver la clase para interactuar con la BBDD
        $repository = $this->getDoctrine()->getRepository(ruta::class);
      //sacar lo que queramos de la base de datos
        $rutas = $repository->findAll();
        $response =  new JsonResponse(array("nombre" => "pepe", "apellido" => "Juan"));
        return $response;
    }
}
