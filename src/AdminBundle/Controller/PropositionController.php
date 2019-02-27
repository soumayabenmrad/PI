<?php

namespace AdminBundle\Controller;

use FixBundle\Entity\Annonce;
use FixBundle\Entity\Proposition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PropositionController extends Controller
{


    public function affichagePAction()
    { /*$proposition=$this->getDoctrine()->getRepository(Proposition::class)->findAll();*/
        return $this->render('@Admin/Proposition/AffichageP.html.twig',array());

    }


}
