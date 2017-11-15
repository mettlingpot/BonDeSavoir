<?php

namespace MP\CompBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MP\CompBundle\Entity\Comp;
use MP\CompBundle\Form\CompType;
use MP\CompBundle\Entity\Materiel;
use MP\UserBundle\Entity\User;
use MP\CompBundle\Entity\Demande;
use MP\CompBundle\Entity\Session;
use MP\CompBundle\Form\SessionType;

class DefaultController extends Controller
{
        
    public function indexAction($page)
    { 
        $nbArticlesParPage = 12;

        $em = $this->getDoctrine()->getManager()->getRepository('MPCompBundle:Comp');
        $randomList = $em->findAll();
        $comp = $em->findAllPagination($page, $nbArticlesParPage);
        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($comp) / $nbArticlesParPage),
            'nomRoute' => 'mp_comp_home',
            'paramsRoute' => array()
        );        
        return $this->render('MPCompBundle:Default:index.html.twig', array(         
            
            'pagination' => $pagination,'listComp' => $comp,'randomList' => $randomList
        ));
    }
            
    public function addAction(Request $request)
    {

        $comp = new Comp();
        $user = $this->getUser();
        //$matos = new Materiel();

        $formComp   = $this->get('form.factory')->create(CompType::class, $comp);
        //$adresse = new Adresse();
        if ($request->isMethod('POST')) {
          $formComp->handleRequest($request);

          if ($formComp->isValid()) {
            $bon = $comp->getBon();
            //$matos = $comp->getMatos();
            $comp->addUserSouhait($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comp);
            $user->addBon($bon); 
            $em->flush();
            return $this->redirectToRoute('login');
          }
        }

        return $this->render('MPCompBundle:Default:formComp.html.twig', array(
          'formComp' => $formComp->createView(),
        ));
      }
      
    public function viewAction($id)
      {
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('MPCompBundle:Comp')
        ;

        $comp = $repository->find($id);
        $em = $this->getDoctrine()->getManager()->getRepository('MPCompBundle:Session');
        $session = $em->findByCompetence($id);
        //$session = $em->findAll();
        
        if (null === $comp) {
          throw new NotFoundHttpException("La competence d'id ".$id." n'existe pas.");
        }

        return $this->render('MPCompBundle:Default:view.html.twig', array(
          'comp' => $comp, 'listSession' => $session
        ));
      }
      
    public function editAction($id, Request $request)
      {
        
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository('MPCompBundle:Comp')->find($id);
        $bon = $comp->getBon();

        if (null === $comp) {
          throw new NotFoundHttpException("L'événement d'id ".$id." n'existe pas.");
        }
        
        if (null === $user) {          
            return $this->redirectToRoute('mp_user_register');
            $request->getSession()->getFlashBag()->add('notice', 'Pour proposer une competence il faut etre connecté.');
        }
            $user->addBon($bon);
            $comp->addUserSouhait($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comp);
            $em->flush();

          return $this->redirectToRoute('mp_comp_view', array('id' => $comp->getId()));
        }
        
    public function rechercheAction(Request $request)
      {
        $recherche = $request->query->get('_recherche');
        $em = $this->getDoctrine()->getManager()->getRepository('MPCompBundle:Comp');
        $comp = $em->findByRecherche($recherche);

        return $this->render('MPCompBundle:Default:recherche.html.twig', array(
                'listComp' => $comp
             ));
    }
       
        
    public function demandeAction($id, $compId, Request $request)
    {

        $demande = new Demande();
        $target = new User();
        $comp = new Comp();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $target = $em->getRepository('MPUserBundle:User')->find($id);
        $comp = $em->getRepository('MPCompBundle:Comp')->find($compId);
        
        $demande->setTarget($target);
        $demande->addCompetence($comp);
        $demande->addRequester($user);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($demande);
        $em->flush();
        
        //envoi de mail
        
        //session demande bien envoyée
        return $this->redirectToRoute('mp_comp_home');
        $request->getSession()->getFlashBag()->add('notice', 'Une demande a été envoyée.');
      }

    public function addSessionAction($id, $compId, $demId,Request $request)
    {

        $session = new Session();
        $user = $this->getUser();
        $comp = new Comp();

        $formSess   = $this->get('form.factory')->create(SessionType::class, $session);
        $em = $this->getDoctrine()->getManager();
        $lerner = $em->getRepository('MPUserBundle:User')->find($id);
        $comp = $em->getRepository('MPCompBundle:Comp')->find($compId);
        $demande = $em->getRepository('MPCompBundle:Demande')->find($demId);
        
        if ($request->isMethod('POST')) {
          $formSess->handleRequest($request);

          if ($formSess->isValid()) {
            
            $em->remove($demande);
            $session->setDealer($user);
            $session->setCompetence($comp);
            $session->addLerner($lerner);
            $em->persist($session);
            $em->flush();
            return $this->redirectToRoute('mp_user_profil');
          }
        }

        return $this->render('MPCompBundle:Default:formSession.html.twig', array(
           'lerner' => $lerner, 'comp' => $comp, 'formSess' => $formSess->createView()
        ));
      }
        
    public function viewSessionAction($id)
      {
        
        $user = $this->getUser();
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('MPCompBundle:Session')
        ;

        $session = $repository->find($id);

        if (null === $session) {
          throw new NotFoundHttpException("La session d'id ".$id." n'existe pas.");
        }

        return $this->render('MPCompBundle:Default:viewSession.html.twig', array(
          'session' => $session
        ));
      }
        
    public function addUserSessionAction($id, Request $request)
      {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $session = $em->getRepository('MPCompBundle:Session')->find($id);
        $session->addLerner($user);            
        $em->persist($session);
        $em->flush();

        if (null === $session) {
          throw new NotFoundHttpException("La session d'id ".$id." n'existe pas.");
        }
        //session 'vous avez bien été ajouté'
        return $this->redirectToRoute('mp_user_profil');
      }
        
    public function removeUserSessionAction($id, Request $request)
      {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $session = $em->getRepository('MPCompBundle:Session')->find($id);
        $session->removeLerner($user);
        $em->persist($session);
        $em->flush();

        if (null === $session) {
          throw new NotFoundHttpException("La session d'id ".$id." n'existe pas.");
        }
        //session 'vous avez bien été ajouté'
        return $this->redirectToRoute('mp_user_profil');
      }

      
}
