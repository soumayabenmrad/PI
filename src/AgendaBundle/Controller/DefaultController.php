<?php

namespace AgendaBundle\Controller;

use FixBundle\Entity\Agenda;
use FixBundle\Entity\programme;
use FixBundle\Entity\Utilisateur;
use FixBundle\Form\AgendaType;
use FixBundle\Form\programmeType;
use FixBundle\Repository\AgendaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function affichProgramAction()
    {   $ag=new Agenda();
        $currentuser = new Utilisateur();
        $currentuser=$this->getUser();
        $id=$currentuser->getId();
        $date=new \DateTime();

        $ag=$this->getDoctrine()->getRepository(Agenda::class)->findOneByProfid($id);

        $programs=$this->getDoctrine()->getRepository(programme::class)->findprogramprochain($date,$ag->getId());

        return $this->render('@Agenda/Default/index.html.twig',array('ag'=>$ag,'user' => $currentuser, 'programs' => $programs));

    }
    public function modifierprogramAction(Request $request,$id)
    {$currentuser=$this->getUser();
        $pr1=new programme();
    $pr=$this->getDoctrine()->getRepository(programme::class)->find($id);
    $form=$this->createForm(programmeType::class,$pr);

    $form->handleRequest($request);
    if ($form->isSubmitted()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($pr);
        $em->flush();
        return $this->redirectToRoute('agenda_homepage');
    }
    return $this->render('@Agenda/Default/modification.html.twig',array('form' =>$form->createView() , 'user' => $currentuser, 'pr'=>$pr ));


    }
    public function supprimerprogramAction($id){
        $currentuser=$this->getUser();
        $pr=$this->getDoctrine()->getRepository(programme::class)->find($id);

        $em=$this->getDoctrine()->getManager();
        $em->remove($pr);
        $em->flush();
        return $this->redirectToRoute('agenda_homepage');


    }
    public function adminagendaAction(){
        $programs=$this->getDoctrine()->getRepository(programme::class)->findAll();

        return $this->render('@Agenda/Default/adminprogram.html.twig',array('pr' => $programs ));


    }

}
