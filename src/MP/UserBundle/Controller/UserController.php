<?php
namespace MP\UserBundle\Controller;

use MP\UserBundle\Entity\User;
use MP\UserBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserInterface;


class UserController extends Controller
{
    
        public function registerAction(Request $request)
        {

        $user = new User();

        $formUser   = $this->get('form.factory')->create(UserType::class, $user);
        //$adresse = new Adresse();
        if ($request->isMethod('POST')) {
          $formUser->handleRequest($request);

          if ($formUser->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Bienvenue');
            return $this->redirectToRoute('login');
          }
        }

        return $this->render('MPUserBundle:User:form.html.twig', array(
          'formUser' => $formUser->createView(),
        ));
      }
    
      public function profilAction(Request $request)
      {
        $user = $this->getUser();
        $userId = $user->getId();

          if (null === $user) {
            return $this->redirectToRoute('mp_user_register');
          } 
          else {
                      
            $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MPCompBundle:Comp')
            ;
        
            $comp = $repository->findByUser($userId);
              
            return $this->render('MPUserBundle:User:profil.html.twig', array(
            'comp' => $comp
        ));
          }
              
      }
          
    public function presentAction($id, Request $request)
      {   
        $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('MPUserBundle:User')
        ;

        $profil = $repository->findById($id);
                
        $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('MPCompBundle:Comp')
        ;
        
        $comp = $repository->findByUser($id);
        
        return $this->render('MPUserBundle:User:present.html.twig', array(
            'profil' => $profil, 'comp' => $comp
        ));
              
      }
  
}
        


