<?php

namespace FixBundle\Controller;


use FixBundle\Entity\Annonce;
use FixBundle\Entity\Utilisateur;
use FixBundle\Form\AnnonceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AnnonceController extends Controller
{

    public function ajouterAction()
    {
        return $this->render('@Fix/Annonce/Ajouter.html.twig');
    }
    public function ajouterAnAction(Request $Request)
    {
        {   $currentuser=$this->getUser();
            $Annonce = new Annonce();
            $Annonce->setEtat("Valide");
            $Annonce->setClientid($currentuser);
            $form = $this->createForm(AnnonceType::class , $Annonce);
            $form = $form->handleRequest($Request);
            if ($form->isValid()) {
                ($em = $this->getDoctrine()->getManager());
                $em->persist($Annonce);
                $em->flush();
                return $this->redirectToRoute("afficheAnnonce_client");}
            return $this->render('@Fix/Annonce/ajouter.html.twig', array('form' => $form->createView(), 'user'=>$currentuser));

        }
    }
    public function afficherannoncesclientAction(){
        $currentuser= new Utilisateur();
        $mesannonces=new Annonce();
        $currentuser=$this->getUser();
        $id=$currentuser->getId();
        $mesannonces=$this->getDoctrine()->getRepository(Annonce::class)->findByClientid($id);
        return $this->render('@Fix/Annonce/AfficheC.html.twig', array('v' => $mesannonces, 'user'=>$currentuser));
    }

    public function deleteAction($id)
    { //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository(Annonce::class)->find($id);
        //remove from the orm
        $em->remove($annonces);
        //update the data base
        $em->flush();
        return $this->redirectToRoute( "afficheAnnonce_client");

    }


    public function modifierAAction(Request $Request,$id){
        $currentuser=$this->getUser();
        $annonces = $this->getDoctrine()->getRepository(Annonce::class)->find($id);
        $form = $this->createForm(AnnonceType::class, $annonces);
        $form = $form->handleRequest($Request);
        if ($form->isValid()&& $form->isSubmitted());
        {   $em = $this->getDoctrine()->getManager();
            $em->flush();}
        $formview=$form->createView();
        return $this->render('@Fix/Annonce/modifier.html.twig',array('form'=>$formview,'user'=>$currentuser));
        return $this->redirectToRoute( "afficheAnnonce_client");
    }
}
