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
              
            //mail
            $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('mettlingpot@bondesavoir.fr')
            ->setTo($user.mail)
            ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/registration.html.twig',
                array('name' => $user.username)
            ),
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
        ;
        $this->get('mailer')->send($message);
  
              
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
                          
            $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MPCompBundle:Demande')
            ;
            $demande = $repository->findByTarget($userId);
            
            $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MPCompBundle:Demande')
            ;
            $demande2 = $repository->findByRequester($userId);
            
            $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MPCompBundle:Session')
            ;
            $session = $repository->findByUser($userId);
              
            $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MPCompBundle:Session')
            ;
            $session2 = $repository->findBylerner($userId);
              
            return $this->render('MPUserBundle:User:profil.html.twig', array(
            'comp' => $comp, 'demandes' => $demande,'demandeFait' => $demande2, 'session' => $session, 'session2' => $session2
            ));
          }
              
      }
          
    public function presentAction($id, $compet, Request $request)
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
        
        $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('MPCompBundle:Comp')
        ;
        
        $competence = $repository->findById($compet);
        
        return $this->render('MPUserBundle:User:present.html.twig', array(
            'profil' => $profil, 'comp' => $comp, 'competence' => $competence
        ));
              
      }
  
}
        


