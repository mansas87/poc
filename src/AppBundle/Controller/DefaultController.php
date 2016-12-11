<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\OffreEmploi;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     * @Route("/liste-offres")
     */
    public function listerLesOffresDEmploi(){
        $logger = $this->get("logger");
        $repository = $this->getDoctrine()->getRepository('AppBundle:OffreEmploi');
        $listeOffresEmploi = $repository->findAll();
        if(is_null($listeOffresEmploi)){
            $logger->info("Il n'y a pas d'offre publiée.");
        }
        
        return $this->render('default/liste-offres-emploi.html.twig',array('listeOffresEmploi'=>$listeOffresEmploi));
    }
    
    /**
     * @Route("/visualiser-offre")
     */
    public function visualiserOffre(Request $request){
        
        if($request->isXMLHttpRequest()){
            
          $idOffre = $request->get("idOffre");
          $repository = $this->getDoctrine()->getRepository('AppBundle:OffreEmploi');
          $offreRecherchee = $repository->find(intval($idOffre));
          
          $content = $this->render('default/visualisation-offre-emploi.html.twig',array('offreRecherchee'=>$offreRecherchee))->getContent();
          return new JsonResponse(json_encode(array('data'=> $content)));
            
        }
        return new Response("Requête incorrecte.",400);
        
    }    
    
}
