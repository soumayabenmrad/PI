<?php

namespace AdminBundle\Controller;

use FixBundle\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnonceController extends Controller
{


    public function AfficheAAction()
    { $annonces=$this->getDoctrine()->getRepository(Annonce::class)->findAll();
        return $this->render('@Admin/Annonce/AffichageA.html.twig',array('v'=>$annonces));

    }
    public function DeleteAction($id)
    { //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $annonce= $em->getRepository(Annonce::class)->find($id);
        //remove from the orm
        $em->remove($annonce);
        //update the data base
        $em->flush();
        return $this->redirectToRoute( "Affichage_Annonce");

    }

}
