<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/liste-offres", name="homepage")
     */
    public function listerLesOffresDEmploi(){
        $repository = $this->getDoctrine()->getRepository('AppBundle:OffreEmploi');
        $listeOffresEmploi = $repository->findAll();
        if(is_null($listeOffresEmploi)){
            throw $this->createNotFoundException('Il n\'existe pas encore d\'offre publiée.');
        }
        
        return $this->render('default/liste-offres-emploi.html.twig',array('listeOffresEmploi'=>$listeOffresEmploi));
    }
    
    
}
