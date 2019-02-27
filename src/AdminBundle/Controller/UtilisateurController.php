<?php

namespace AdminBundle\Controller;

use FixBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateurController extends Controller
{
    public function AfficheUserAction()
    { $utilisateurs=$this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('@Admin/Utilisateurs/user.html.twig',array('u'=>$utilisateurs));

    }
}
