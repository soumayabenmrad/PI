<?php

namespace FixBundle\Controller;

use FixBundle\Entity\Commentaire;
use FixBundle\Entity\Post;
use FixBundle\Entity\Profesionnel;
use FixBundle\Entity\Proposition;
use FixBundle\Entity\Utilisateur;
use FixBundle\Form\CommentaireType;
use FixBundle\Form\PostType;
use FixBundle\Form\ProfesionnelType;
use FixBundle\Form\UtilisateurType;
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
use Doctrine\Common\Persistence\ObjectManager;
class DefaultController extends Controller

{

    /**
     * @Route("/", name="fix_homepage")
     */
    public function indexAction(Request $request)
    {
        $currentuser = $this->getUser();
        $authChecker=$this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_PRO'))
        {
            return $this->render('@Fix/Professionnel/prof.html.twig',array('user' => $currentuser));}
        $currentuser = $this->getUser();
        $authChecker=$this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_CLI'))
        {return $this->render('@Fix/Client/client.html.twig',array('user' => $currentuser));}
        $eventDispatcher = $this->get('event_dispatcher');
        $formFactory = $this->get('fos_user.registration.form.factory');
        $userManager = $this->get('fos_user.user_manager');

        $eventDispatcher = $this->get('event_dispatcher');
        $formFactory = $this->get('fos_user.registration.form.factory');
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->addRole('ROLE_CLI');
        $user1 = $userManager->createUser();
        $user1->setEnabled(true);
        $user1->addRole('ROLE_PRO');


        $event = new GetResponseUserEvent($user, $request);
        $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        $event1 = new GetResponseUserEvent($user1, $request);
        $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event1);


        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        if (null !== $event1->getResponse()) {
            return $event1->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $formpro = $formFactory->createForm();
        $formpro->setData($user1);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $event = new FormEvent($form, $request);
                $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
            $event = new FormEvent($form, $request);
            $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);}
             if (null !== $response = $event->getResponse()) {
            return $response;
             }




            return $this->render('@Fix/Default/index.html.twig', array(
                'form' => $form->createView(),'formpro' => $formpro->createView()
            ));
    }
    /**
     * @Route("/", name="fix_registerPro")
     */
    public function registerproAction(Request $request){


        $eventDispatcher = $this->get('event_dispatcher');
        $formFactory = $this->get('fos_user.registration.form.factory');
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->addRole('ROLE_PRO');
        $event = new GetResponseUserEvent($user, $request);
        $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $formpro = $formFactory->createForm();
        $formpro->setData($user);


        $formpro->handleRequest($request);
        if ($formpro->isSubmitted()) {
            if ($formpro->isValid()) {

                $event = new FormEvent($formpro, $request);
                $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($formpro, $request);
            $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@Fix/Default/index.html.twig', array(
             'formpro' => $formpro->createView()
        ));
    }

    public function registercliAction(Request $request){


        $eventDispatcher = $this->get('event_dispatcher');
        $formFactory = $this->get('fos_user.registration.form.factory');
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->addRole('ROLE_CLI');
        $event = new GetResponseUserEvent($user, $request);
        $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $formpro = $formFactory->createForm();
        $formpro->setData($user);


        $formpro->handleRequest($request);
        if ($formpro->isSubmitted()) {
            if ($formpro->isValid()) {

                $event = new FormEvent($formpro, $request);
                $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($formpro, $request);
            $eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@Fix/Default/index.html.twig', array(
            'formpro' => $formpro->createView()
        ));
    }


    public function registerAction()
    {
        return $this->render('base.html.twig');

    }
    public function adminAction(){
        return $this->render('@Fix/default/indexadmin.html.twig');
    }

    public function showprofilcliAction(){
        $currentuser=$this->getUser();
        return $this->render('@Fix/Client/showprofilcli.html.twig',array('user'=>$currentuser));
    }

    public function showprofilprofAction(){
        $currentuser=$this->getUser();
        return $this->render('@Fix/Professionnel/showprofilpro.html.twig',array('user'=>$currentuser));
    }

    public function showpostclientAction(){
        $currentuser=$this->getUser();
        $postes=$this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('@Fix/Client/showpostclient.html.twig',array('postes'=>$postes,'user'=>$currentuser));
    }

    public function showpostproAction(){
        $currentuser=$this->getUser();
        $postes=$this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('@Fix/Professionnel/showpostprof.html.twig',array('postes'=>$postes,'user'=>$currentuser));
    }

    public function mypostclientAction(){
        $currentuser=$this->getUser();
        $postes=$this->getDoctrine()->getRepository(Post::class)->findByUserid($currentuser);
        return $this->render('@Fix/Client/mypostclient.html.twig',array('postes'=>$postes,'user'=>$currentuser));
    }


    public function addpostclientAction(Request $request)
    {
        $currentuser=$this->getUser();
        $post= new Post();
        $post->setUserid($currentuser);
        $form=$this->createForm(PostType::class,$post);
        $form=$form->handleRequest($request);
        if($form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('showpostclient');
        }
        return $this->render('@Fix/Client/addpostclient.html.twig',array('form'=>$form->createView(),'user'=>$currentuser
        ));
    }
    public function updatepostclientAction(Request $request,$id)
    {
        $currentuser=$this->getUser();
        $post=$this->getDoctrine()->getRepository(Post::class)->find($id); //getDoctine() Doctrine gère la base de données.
        //getRepository() récupérer les entités depuis la base de données.
        //find($id) Select id
        $form=$this->createForm(PostType::class,$post); //Création formulaire
        $form->handleRequest($request); // Exécuter de la requette
        if ($form->isValid()&&($form->isSubmitted())) // If form isValid and submitted
        {
            $em=$this->getDoctrine()->getManager();   // On récupère l'EntityManager
            $em->persist($post);     // Étape 1 : On « persiste » l'entité
            $em->flush(); // Étape 2 : On déclenche l'enregistrement
            return $this->redirectToRoute("showpostclient");
        }
        $formview=$form->createView(); // Crée la vue du formulaire.
        return $this->render('@Fix/Client/updatepostclient.html.twig',array('form'=>$formview, 'user'=>$currentuser)); // Retourne le vue ajouter
    }


    public function deletepostclientAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $post= $em->getRepository(Post::class)->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("showpostclient");
    }

    public function showpostadminAction(){

        $postes=$this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('@Fix/Admin/showpostadmin.html.twig',array('postes'=>$postes));
    }

    public function deletepostadminAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $post= $em->getRepository(Post::class)->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("showpostadmin");
    }


    public function showcommentaireproAction(){
        $currentuser=$this->getUser();
        $commentaires=$this->getDoctrine()->getRepository(Commentaire::class)->findByUserid($currentuser);
        return $this->render('@Fix/Professionnel/showcommentairepro.html.twig',array('commentaires'=>$commentaires,'user'=>$currentuser));
    }

    public function showcommentairecliAction(){
        $currentuser=$this->getUser();
        $commentaires=$this->getDoctrine()->getRepository(Commentaire::class)->findByUserid($currentuser);
        return $this->render('@Fix/Client/showcommentairecli.html.twig',array('commentaires'=>$commentaires,'user'=>$currentuser));
    }


    public function addcommentaireclientAction(Request $request, $id)
    {
        $currentuser=$this->getUser();
        $commentaire= new Commentaire();
        $commentaire->setUserid($currentuser);
        $form=$this->createForm(CommentaireType::class,$commentaire);
        $form=$form->handleRequest($request);
        if($form->isSubmitted()){
            $post=$this->getDoctrine()->getRepository(Post::class)->find($id);
            $commentaire->setPostid($post);
            $em= $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('showpostclient');
        }
        return $this->render('@Fix/Client/addcommentaireclient.html.twig',array('form'=>$form->createView(),'user'=>$currentuser
        ));
    }

    public function addcommentaireproAction(Request $request, $id)
    {
        $currentuser=$this->getUser();
        $commentaire= new Commentaire();
        $commentaire->setUserid($currentuser);
        $form=$this->createForm(CommentaireType::class,$commentaire);
        $form=$form->handleRequest($request);
        if($form->isSubmitted()){
            $post=$this->getDoctrine()->getRepository(Post::class)->find($id);
            $commentaire->setPostid($post);
            $em= $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('showcommentaire');
        }
        return $this->render('@Fix/Professionnel/addcommentairepro.html.twig',array('form'=>$form->createView(),'user'=>$currentuser
        ));
    }

    public function updatecommentairecliAction(Request $request,$id)
    {
        $currentuser=$this->getUser();
        $commentaires=$this->getDoctrine()->getRepository(Commentaire::class)->find($id); //getDoctine() Doctrine gère la base de données.
        //getRepository() récupérer les entités depuis la base de données.
        //find($id) Select id
        $form=$this->createForm(CommentaireType::class,$commentaires); //Création formulaire
        $form->handleRequest($request); // Exécuter de la requette
        if ($form->isValid()&&($form->isSubmitted())) // If form isValid and submitted
        {
            $em=$this->getDoctrine()->getManager();   // On récupère l'EntityManager
            $em->persist($commentaires);     // Étape 1 : On « persiste » l'entité
            $em->flush(); // Étape 2 : On déclenche l'enregistrement
            return $this->redirectToRoute("showcommentairecli");
        }
        $formview=$form->createView(); // Crée la vue du formulaire.
        return $this->render('@Fix/Client/updatecommentairecli.html.twig',array('form'=>$formview,'user'=>$currentuser)); // Retourne le vue ajouter
    }


    public function updatecommentaireproAction(Request $request,$id)
    {
        $currentuser=$this->getUser();
        $commentaires=$this->getDoctrine()->getRepository(Commentaire::class)->find($id); //getDoctine() Doctrine gère la base de données.
        //getRepository() récupérer les entités depuis la base de données.
        //find($id) Select id
        $form=$this->createForm(CommentaireType::class,$commentaires); //Création formulaire
        $form->handleRequest($request); // Exécuter de la requette
        if ($form->isValid()&&($form->isSubmitted())) // If form isValid and submitted
        {
            $em=$this->getDoctrine()->getManager();   // On récupère l'EntityManager
            $em->persist($commentaires);     // Étape 1 : On « persiste » l'entité
            $em->flush(); // Étape 2 : On déclenche l'enregistrement
            return $this->redirectToRoute("showcommentairepro");
        }
        $formview=$form->createView(); // Crée la vue du formulaire.
        return $this->render('@Fix/Professionnel/updatecommentairepro.html.twig',array('form'=>$formview,'user'=>$currentuser)); // Retourne le vue ajouter
    }




    public function deletecommentaireAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $commentaires= $em->getRepository(Commentaire::class)->find($id);
        $em->remove($commentaires);
        $em->flush();
        return $this->redirectToRoute("showcommentaire");
    }

    public function voirpluspostclientAction($id, $titre, $description, $categorie, $souscategorie){
        $currentuser=$this->getUser();
        $commentaires=$this->getDoctrine()->getRepository(Commentaire::class)->findByPostid($id);
        return $this->render('@Fix/Client/voirpluspostclient.html.twig',array('id'=>$id,'titre'=>$titre,'description'=>$description,'categorie'=>$categorie,'souscategorie'=>$souscategorie,'commentaire'=>$commentaires,'user'=>$currentuser));
    }

    public function voirpluspostproAction($id, $titre, $description, $categorie, $souscategorie){
        $currentuser=$this->getUser();
        $commentaires=$this->getDoctrine()->getRepository(Commentaire::class)->findByPostid($id);
        return $this->render('@Fix/Professionnel/voirpluspostpro.html.twig',array('id'=>$id,'titre'=>$titre,'description'=>$description,'categorie'=>$categorie,'souscategorie'=>$souscategorie,'commentaire'=>$commentaires,'user'=>$currentuser));
    }


}

