<?php

namespace Campsite\EventBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Campsite\AdminBundle\Entity\Events;
use Campsite\AdminBundle\Entity\UsersGroups;

// Use Google Maps
use Google\MapsBundle\Geo\Coding;
class EventController extends Controller
{
		
    /**
     * @Route("/eventlist",name="event_list")
     * @Template()
     */
    public function index1Action()
    {
	  return array();
    }
	
	
	/**
     * @Route("/eve",name="client1")
     * @Template()
     */ 
    public function indexAction(Request $request)
    {
	  $em = $this->getDoctrine()->getManager();
	  $entity = $em->getRepository('CampsiteAdminBundle:Events')->findAll();
      if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event INDex entity.');
        }
      return array(
            'events' => $entity,
        );
    }
	
	/**
     * @Route("/",name="client")
     * @Template()
     */ 
    public function sessionListAction(Request $request)
    {
	
	 $communityId = ($request->getSession()->get('communityId')!='') ? $request->getSession()->get('communityId') :  $this->container->getParameter('default_communityId');
	
	 $em = $this->getDoctrine()->getManager();
	 if(is_numeric($communityId)) {	
	
      $entity = $em->getRepository('CampsiteAdminBundle:Session')->findSessionByCommunity($communityId);
	  }
	  else{
	    $communityId=$this->container->getParameter('default_communityId');
	    $entity = $em->getRepository('CampsiteAdminBundle:Session')->findSessionByCommunity($communityId);
	  
	  }
	  if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventSessionList entity.');
        }
      return array(
            'sessions' => $entity,'communityId' => $communityId
        );
    }
	/**
     * @Route("/chapters/{id}",name="chapters")
     * @Template()
     */ 
    public function chapterlistAction(Request $request)
    {
		
	    $communityId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
		$user = $this->container->get('security.context')->getToken()->getUser();
		
		if(is_object($user)) {
		
        $entity = $em->getRepository('CampsiteAdminBundle:Groups')->findGroupByCommunity($communityId);
		
		if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chapter list entity.');
        }
		// also get the Groups of that users
		$userGroups = $em->getRepository('CampsiteAdminBundle:UsersGroups')->findByFosuser($user->getId());
		$userGroupArr = array();
		foreach($userGroups as $userGroup) {
			$userId= $userGroup->getFosuser()->getId();
			$groupId= $userGroup->getGroup()->getId();
			$userGroupArr[$userId][$groupId] = $groupId;
		}
		return array(
            'groups' => $entity,
			'userGroups' => $userGroupArr,
			'communityId' => $communityId
        );
		}
		else {
		
			$entity = $em->getRepository('CampsiteAdminBundle:Groups')->findGroupByCommunity($communityId);
			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Event chapterlist 2 entity.');
			}
			return array(
				'groups' => $entity,'communityId' => $communityId
			);
		}
		
		// Getting the Total COunt of Group
		
		//$count = $em->getRepository('CampsiteAdminBundle:Groups')->findCountOfUserGroup($entity[0]->getId());
		//var_dump($count);exit;
		
	    
    }
	
	/**
     * @Route("/communities",name="community")
     * @Template()
     */ 
    public function communityAction(Request $request)
    {
	  $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	 
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('CampsiteAdminBundle:Community')->findAll();
      if (!$entity) {
            throw $this->createNotFoundException('Unable to find community entity.');
        }
      return array(
            'communities' => $entity, 'communityId' => $communityId
        );
	  
    }
	/**
     * @Route("/sponsors",name="sponsors_display")
     * @Template()
     */ 
    public function sponcerlistAction()
    {
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('CampsiteAdminBundle:Vendors')->findAllSponcers();
	
   	  return array(
            'vendors' => $entity,
        );
    }
	
	/**
     * @Route("/partners",name="partners_display")
     * @Template()
     */ 
    public function partnerlistAction()
    {
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('CampsiteAdminBundle:Vendors')->findAllPartners();
      
	  return array(
            'partners' => $entity,
        );
    }
    /**
	 * Display Event Details
	 *
     * @Route("/marketingcampsv/{id}/{communityId}", name="marketingcamp")
     * @Template()
     */
    public function eventDetailsAction(Request $request)
    {
        $id = $request->get('id');
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		$user = $this->container->get('security.context')->getToken()->getUser();
		$isAllowed = 0;
		if(is_object($user)) {
			$userId= $user->getId();
			
			$em = $this->getDoctrine()->getManager();
			$userEvents = $em->getRepository('CampsiteAdminBundle:Events')->findBy(array('userId'=>$userId,'id'=>$id));
			
			$isAllowed = ($userEvents) ? 1 : 2;
		  }
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CampsiteAdminBundle:Events')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventDetails entity.');
        }
     
	  return array(
            'event' => $entity,'communityId' => $communityId,'isEditable'=>$isAllowed
        );
    }
	
	/**
	 * Display Group Details
	 *
     * @Route("/group/{groupName}/{id}/{communityId}", name="group_details")
     * @Template()
     */
    public function groupDetailsAction(Request $request)
    {
        $id = $request->get('id');
		$communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CampsiteAdminBundle:Groups')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group Details entity.');
        }
      // here we  also have to check is user Allowed to add Events
	  $isAllowed = 0;
	  $user = $this->container->get('security.context')->getToken()->getUser();
	  
	  if(is_object($user)) {
		$userId= $user->getId();
		$groupId= $entity->getId();
		$em = $this->getDoctrine()->getManager();
        $userGroups = $em->getRepository('CampsiteAdminBundle:UsersGroups')->findBy(array('fosuser'=>$userId,'group'=>$groupId));
		$isAllowed = ($userGroups) ? 1 : 2;
	  }
	  
	  return array(
            'group' => $entity,'communityId' =>$communityId,'isAllowedToAddEvent'=>$isAllowed 
        );
    }
	
	public function upcomingEventsAction(Request $request)
	{
	 
	  $em = $this->getDoctrine()->getManager();
	  $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
      $entity = $em->getRepository('CampsiteAdminBundle:Events')->findUpcomingEvents($communityId,4);		
      return $this->render(
            'EventBundle::upcoming_events.html.twig',
            array('events' => $entity,'communityId' => $communityId)
        );
	}
	/**
	 * Display Events Based on Group
	 */
	public function upcomingGroupEventsAction(Request $request)
	{
	
	  $groupId = $request->get('groupId');	
	  $communityId = $request->get('communityId');
	  $em = $this->getDoctrine()->getManager();
	  
      $entity = $em->getRepository('CampsiteAdminBundle:Groups')->findUpcomingGroupEvents($groupId,4);
			
      return $this->render(
            'EventBundle::upcoming_group_events.html.twig',
            array('group_events' => $entity, 'groupId'=> $groupId,'communityId'=>$communityId)
        );
	}
	
	/**
	 * Display All Upcoming Events
	 *
     * @Route("/upcomingevents/{communityId}", name="upcoming_events")
     * @Template()
     */
	public function allupcomingEventsAction(Request $request)
	{
	  
	  $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
	  $em = $this->getDoctrine()->getManager();
	  
      $entity = $em->getRepository('CampsiteAdminBundle:Events')->findUpcomingEvents($communityId,0);
	  
      if (!$entity) {
            throw $this->createNotFoundException('Unable to find All Upcoming Event entity.');
      }
	  
     return array('events' => $entity, 'communityId' => $communityId);
	}	
	/**
	 * Display All Upcoming Group  Events
	 *
     * @Route("/upcoming/group/events/{groupId}/{communityId}", name="upcoming_group_events")
     * @Template()
     */
	public function allupcomingGroupEventsAction(Request $request)
	{
	  $groupId = $request->get('groupId');	
	  $communityId = $request->get('communityId');
	  $em = $this->getDoctrine()->getManager();
	  
      $entity = $em->getRepository('CampsiteAdminBundle:Groups')->findUpcomingGroupEvents($groupId);
	  
      if (!$entity) {
            throw $this->createNotFoundException('Unable to find All upcoming Group Event entity.');
      }
	  
     return array('group_events' => $entity,'communityId'=>$communityId);
	}
	
	public function recentEventsAction(Request $request)
	{
	  $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		
	  $em = $this->getDoctrine()->getManager();
	  
      $entity = $em->getRepository('CampsiteAdminBundle:Events')->findRecentEvents($communityId,4);
	  

	  return $this->render(
            'EventBundle::recent_events.html.twig',
            array('events' => $entity,'communityId' => $communityId)
        );
	}
	/**
	 * Display All Recent Events
	 *
     * @Route("/recentevents/{communityId}", name="recent_events")
     * @Template()
     */

	public function allrecentEventsAction(Request $request)
	{
	  $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		
	  $em = $this->getDoctrine()->getManager();
	  
      $entity = $em->getRepository('CampsiteAdminBundle:Events')->findRecentEvents($communityId,0);
	
      return array('events' => $entity,'communityId' => $communityId);
        
	}
	
	/**
	 * Display Next Event
	 *
     * @Template()
     */

	public function nextEventAction(Request $request)
	{
	  $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		
	  $em = $this->getDoctrine()->getManager();
	  
      $entity = $em->getRepository('CampsiteAdminBundle:Events')->findUpcomingEvents($communityId,1);
	  if (!$entity) {
		$entity[0]= array();
	  }
      return $this->render(
            'EventBundle::next_event.html.twig',
            array('event' => $entity[0])
        );
        
	}
	
   /**
	*   get Google Map Address
	*   @param string Address
	*/
	
	public function getGoogleMapAddressAction($address='United States')
	{ 
	 
 	 $query = new Coding($address);
	 return $this->render(
            'EventBundle::googlemap.html.twig',
            array('googlemapaddress' => $query->getResults())
        );	
	 
	}
	
	public function getMultipleGoogleDataAction(Request $request) {
		$communityId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CampsiteAdminBundle:Groups')->findGroupByCommunity($communityId);
		
		// now we cant get latitude and longitude of all city and location
		$addressN = array();
		$latitudeArray = array();
		$longitudeArray = array();
		foreach ($entity as $key=>$group) {
		  $address = $group[0]->getCity()."+".$group[0]->getLocation();
  	      $query = new Coding($address);
		  $res= $query->getResults();
		  $latitude = $res[0]->getLatitude();
		  $longitude = $res[0]->getLongitude();
		  $latitudeArray[$key] = $latitude;
		  $longitudeArray[$key] = $longitude;
		  
		  $addressN[$key]['latitude']= (float)  $latitude;
		  $addressN[$key]['longitude']= (float)  $longitude;
		  $addressN[$key]['location'] = (string) $group[0]->getCity();					 
		}
		// For Center We choose Mid Level Value Between Latitude and Longitude

		return $this->render(
            'EventBundle::chapterlist_maps.html.twig',
            array('googlemapaddress' => $addressN, 'count' => count($entity))
        );	
	 
	}
	/**
     * @Route("/join/{id}",name="join")
     * @Template()
     */
    public function joinAction(Request $request)
    {
	  $em = $this->getDoctrine()->getManager();
	  // First We check if user is login or not 
	  $user = $this->container->get('security.context')->getToken()->getUser();
	  $id = $request->get('id');
	  $group = $em->getRepository('CampsiteAdminBundle:Groups')->find($id);
	  $communityId = $group->getCommunity()->getId();
	  // if user is login then it returns User object then we have to save it that data
	  // in users_groups table
	  if(is_object($user)) {
     	 
	     $objUserGroup = new UsersGroups();
		 $objUserGroup->setFosuser($user);
		 $objUserGroup->setGroup($group);
		 $em->persist($objUserGroup);
		 $em->flush();
		 
		 return $this->redirect($this->generateUrl('chapters', array('id' => $communityId)));
	  }
	  // redirected to Login Page
	  else {
		 return $this->redirect($this->generateUrl('fos_user_security_login'));
	  }
	  
	  
    }
	
	/**
     * @Route("/groups/{communityId}/{page}",name="near_group")
	 * defaults={"communityId"="1"}
     * @Template()
     */
    public function nearGroupAction(Request $request)
    {
	   $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	   $page=$request->get('page');
	   $em = $this->getDoctrine()->getManager();
	   $groups = $em->getRepository('CampsiteAdminBundle:Groups')->findGroupByCommunity($communityId,9);
	
		
	   return $this->render(
            'EventBundle::near_group.html.twig',
            array('groups' => $groups,'communityId'=>$communityId,'page'=>$page)
        );	
    }
	/**
     * @Route("/communitylist/{communityId}",name="community_list")
	 * defaults={"communityId"="1"}
     * @Template()
     */
	 public function communityListAction(Request $request) 
	 {
		  $communityId= $request->get('communityId');
		  // set the variable in session
		  $session = $request->getSession();
		  $session->set('communityId',$communityId);
		  return $this->redirect($this->generateUrl('client'));
	 }
	 /**
     * @Route("/edit/event/{id}",name="edit_event_details")
     * @Template()
     */ 	
	public function editAjaxEventDetailsAction(Request $request)
	{

		$fieldName = $request->get('element_id');
		$id = $request->get('id');
		$value =$request->get('update_value');
		
		if($value != " ") {
			
			$em = $this->getDoctrine()->getManager();
			$eventDetails = $em->getRepository('CampsiteAdminBundle:Events')->find($id);
			
			switch($fieldName) {
				case 'name':
					$eventDetails->setName($value);
					break;
				case 'address':
					$eventDetails->setAddress($value);
					break;	
				case 'city':
					$eventDetails->setCity($value);
					break;	
				case 'state':
					$eventDetails->setState($value);
					break;	
				case 'zipcode':
					$eventDetails->setZipcode($value);
					break;	
				case 'country':
					$eventDetails->setCountry($value);
					break;	
				case 'description':
					$eventDetails->setDescription($value);
					break;	
				
				case 'from_time':
				case 'from_date':
					// we have to convert value into Datetime object
					$value1 = new \DateTime($value);
					$eventDetails->setFromDate($value1);
					break;		
				case 'to_time' :
				case 'to_date' :
					// we have to convert value into Datetime object
					$value1 = new \DateTime($value);
					$eventDetails->setToDate($value1);
					break;									
				default:
					echo "default";exit;
					break;
			}
			$em->persist($eventDetails);
			$em->flush();	
		}
		else {
			echo "blank";
		}
		return new Response ($value); 		
		exit;
	}
}
