<?php

namespace MP\CompBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MP\CompBundle\Entity\Comp;
use MP\CompBundle\Form\CompType;
use MP\CompBundle\Entity\Materiel;

class DefaultController extends Controller
{
        
    public function indexAction($page)
    { 
        $nbArticlesParPage = 8;

        $em = $this->getDoctrine()->getManager()->getRepository('MPCompBundle:Comp');
        
        $comp = $em->findAllPagination($page, $nbArticlesParPage);
        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($comp) / $nbArticlesParPage),
            'nomRoute' => 'mp_comp_home',
            'paramsRoute' => array()
        );

        return $this->render('MPCompBundle:Default:index.html.twig', array(         
            
            'pagination' => $pagination,'listComp' => $comp
            ));
    }
    public function addAction(Request $request)
    {

        $comp = new Comp();
        $user = $this->getUser();

        $formComp   = $this->get('form.factory')->create(CompType::class, $comp);
        //$adresse = new Adresse();
        if ($request->isMethod('POST')) {
          $formComp->handleRequest($request);

          if ($formComp->isValid()) {
            $bon = $comp->getBon();
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

        if (null === $comp) {
          throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        return $this->render('MPCompBundle:Default:view.html.twig', array(
          'comp' => $comp
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

      
}
