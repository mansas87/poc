<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\OffreEmploi;
use AppBundle\Form\OffreEmploiType;

class DefaultController extends Controller
{
    /**
     * @Route("/ajouter-offre", name="ajout_offre")
     */
    public function ajouterOffreAction(Request $request) {
        $offreEmploi = new OffreEmploi();

        $form = $this->get('form.factory')->create(new OffreEmploiType(), $offreEmploi);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offreEmploi);
            $em->flush();

            return $this->redirect($this->generateUrl('liste-offre',  array()));
        }

        return $this->render('default/ajouter-offre.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/liste-offres", name="liste-offre")
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
