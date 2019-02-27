<?php

namespace FixBundle\Controller;

use FixBundle\Entity\Proposition;
use FixBundle\Entity\Annonce;
use FixBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PropositionCController extends Controller
{
    public function viewAction(){
        $currentuser= new Utilisateur();
        $mesannonces=new Annonce();
        $currentuser=$this->getUser();
        $id=$currentuser->getId();
        $mesproposition=$this->getDoctrine()->getRepository(Proposition::class)->findByclientid($id);
        return $this->render('@Fix/Proposition/affichepropo.html.twig',array('p'=>$mesproposition, 'user'=>$currentuser));
    }


    public function propositionAction(Request $request,$id){
        $currentuser=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonce::class)->find($id);
        if($request->isMethod('post')){
            $proposition = new proposition();
            $proposition->setAnnonce($annonce);
            $proposition->setDescription($request->get('description'));
            $proposition->setPrix($request->get('prix'));
            $prof=$this->getDoctrine()->getRepository(Utilisateur::class)->find($currentuser->getId());
            $proposition->setProfid($prof);
            $proposition->setClientid($annonce->getClientid());
            $em->persist($proposition);
            $em->flush();
          return $this->redirectToRoute( "annonce");}
          return $this->render('@Fix/Proposition/ajouterProp.html.twig',array( 'annonce' =>$annonce , 'user'=>$currentuser));

    }


}
