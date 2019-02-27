<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompteController extends Controller
{
    public function adminAction()
    {
        return $this->render('@Admin/Utilisateurs/compte.html.twig');
    }
}
