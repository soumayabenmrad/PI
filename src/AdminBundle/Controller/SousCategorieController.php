<?php

namespace AdminBundle\Controller;


use FixBundle\Entity\Souscategorie;
use FixBundle\Form\SouscategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SousCategorieController extends Controller
{

    public function AfficheScAction($id)
    { $souscategorie=$this->getDoctrine()->getRepository(Souscategorie::class)->findBycategorie($id);

        return $this->render('@Admin/Souscategorie/AffichageSc.html.twig',array('v'=>$souscategorie));

    }
    public function ajouterrScAction(Request $Request )
    {   $souscategorie = new souscategorie();
        $form = $this->createForm(SouscategorieType::class, $souscategorie);
        $form = $form->handleRequest($Request);

        if ($form->isValid()) {
            ($em = $this->getDoctrine()->getManager());
            $em->persist($souscategorie);
            $em->flush();
            return $this->redirectToRoute("Affichage_Categorie");}
        return $this->render('@Admin/Souscategorie/ajouterSc.html.twig', array('form' =>$form->createView()));

    }

    public function DeleteAction($id)
    { //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $souscategorie = $em->getRepository(Souscategorie::class)->find($id);
        //remove from the orm
        $em->remove($souscategorie);
        //update the data base
        $em->flush();
        return $this->redirectToRoute( "Affichage_Categorie");

    }

}




