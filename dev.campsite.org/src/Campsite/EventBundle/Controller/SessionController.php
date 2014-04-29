<?php

namespace Campsite\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Campsite\AdminBundle\Entity\Session;

class SessionController extends Controller
{
    /**
     * @Route("/session/details/{id}",name="session_details")
     * @Template()
     */
    public function indexAction(Request $request)
    {
	  $sessionId= $request->get('id');
      $em = $this->getDoctrine()->getManager();
	  $sessionObj = $em->getRepository('CampsiteAdminBundle:SessionDetail')->findBySession($sessionId);
	 	
      
	  return $this->render(
            'EventBundle:Session:index.html.twig',
            array('sessions' => $sessionObj)
        );	
    }
	
	/**
     * @Route("/session/contents/{id}",name="session_content")
     * @Template()
     */
    public function sessionContentAction(Request $request)
    {
	
	  $sessionDetailId= $request->get('id');
	 
      $em = $this->getDoctrine()->getManager();
	  $sessionDetailObj = $em->getRepository('CampsiteAdminBundle:SessionDetail')->find($sessionDetailId);
	 
	  $sessionName = $sessionDetailObj->getSession()->getName();
		
      
	  return $this->render(
            'EventBundle:Session:session_details.html.twig',
            array('sessionDetails' => $sessionDetailObj,'sessionName' => $sessionName)
        );	
    }
	
    public function sessionListByEventAction(Request $request)
    {
	
	  $eventId= $request->get('eventId');
	 
      $em = $this->getDoctrine()->getManager();
	  $sessionObj = $em->getRepository('CampsiteAdminBundle:Session')->findSessionByEvent($eventId);
	  
      return $this->render(
            'EventBundle:Session:events_session.html.twig',
            array('sessionObj' => $sessionObj,'eventId'=>$eventId)
        );	
    }
	/**
     * @Route("/add/session",name="add_session")
     * @Template()
     */
	 public function addSessionAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$session = new Session();
		$communityId = 1;
		// variables
		$eventId=$request->get('eventId');
		$userId = $request->get('userId');
		$name=$request->get('sessionName');
		$description=$request->get('sessionDescription');
		
		if($request->getMethod()=="POST") {
			// Validations
			if(trim($name) == '') {
				$this->get('session')->setFlash('failure', "Name Cant left Blank");
					return $this->redirect($this->generateUrl('marketingcamp', 
						array('id'=>$eventId,'communityId'=>$communityId)));
			}
			
			// Add Sessions into Database

			$event = $em->getRepository('CampsiteAdminBundle:Events')->find($eventId);
		
			$session->setName($name);
			$session->setDescription($description);
			$session->setEvent($event);
			$session->setUserId($userId);
			
			$em->persist($session);
			$em->flush();
			
			return $this->redirect($this->generateUrl('marketingcamp', 
			array('id'=>$eventId,'communityId'=>$communityId)));	
			
		}

    }
	
	
}
