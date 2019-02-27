<?php

namespace AdminBundle\Controller;

use FixBundle\Entity\Categorie;
use FixBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    public function AfficheCAction(Request $request)
    {   $em = $this->getDoctrine()->getManager();
        $listcategories = $em->getRepository(Categorie::class)->findAll();
        $categorie=$this->get('knp_paginator')->paginate(
        $listcategories,
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('@Admin/Categorie/Affichage.html.twig',array('v' => $categorie));
    }

    public function modifierCAction(Request $Request,$id){

        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
        $form = $this->createForm(CategorieType::class, $categorie);
        $form = $form->handleRequest($Request);
        if ($form->isValid()&& $form->isSubmitted());
        { $em = $this->getDoctrine()->getManager();
            $em->flush();}
        $formview=$form->createView();
        return $this->render('@Admin/Categorie/Ajouter.html.twig',array('form'=>$formview));
        return $this->redirectToRoute( "Affichage_Categorie");
    }
    public function ajoutAction(Request $Request )
    {   $categorie = new categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form = $form->handleRequest($Request);

        if ($form->isValid()) {
           ($em = $this->getDoctrine()->getManager());

            $categorie->uploadProfilePicture();

            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute("Affichage_Categorie");}
        return $this->render('@Admin/Categorie/Ajouter.html.twig', array('form' =>$form->createView()));

    }

    public function DeleteAction($id)
    { //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->find($id);
        //remove from the orm
        $em->remove($categorie);
        //update the data base
        $em->flush();
        return $this->redirectToRoute( "Affichage_Categorie");

    }

    public function chercherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categorie::class)->findAll();
        if ($request->isMethod('POST')) {
            $titre = $request->get('titre');
            $categories = $em->getRepository(Categorie::class)->findBy(array('titre' => $titre));
        } else {
            $categories = $em->getRepository(Categorie::class)->findAll();
        }
        return $this->render('@Admin/Categorie/Rechercher.html.twig', array('v' => $categories));

    }

}




