<?php

namespace FixBundle\Controller;

use FixBundle\Entity\Annonce;
use FixBundle\Entity\Profesionnel;
use FixBundle\Entity\Proposition;
use FixBundle\Form\ProfesionnelType;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FilterUserResponseEvent;
class AnnoncePController extends Controller

{
    public function viewAction(){

        $currentuser=$this->getUser();
        $mesannonces=$this->getDoctrine()->getRepository(Annonce::class)->findAll();
        return $this->render('@Fix/Professionnel/annonce.html.twig', array('v' => $mesannonces, 'user'=>$currentuser));
    }
}