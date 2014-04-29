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
class UserController extends Controller
{
 
	const USER_IMAGE_PATH = '../img/users/';
	/**
     * @Route("/users",name="users_display")
     * @Template()
     */ 
    public function userslistAction()
    {
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('CampsiteAdminBundle:Users')->findAll();
	
   	  return array(
            'users' => $entity,
        );
    }	
	/**
     * @Route("/user/{id}",name="user_profile")
     * @Template()
     */ 
    public function userprofileAction(Request $request)
    {
		$id = $request->get('id');
		$em = $this->getDoctrine()->getManager();
		$user = $this->container->get('security.context')->getToken()->getUser();
		$isEditable = 0;
		$userProfile = $em->getRepository('CampsiteAdminBundle:Users')->find($id);
		if(is_object($user) && $user->getId() == $userProfile->getUser()->getId()) {
			$isEditable = 1;
		}	
		return array(
			'userProfile'=>$userProfile, 'isEditable'=>$isEditable 
		);		
		
    }

	/**
     * @Route("/edit/user/{id}",name="edit_user_profile")
     * @Template()
     */ 	
	public function editUserProfileAction(Request $request)
	{
		// if have to change the image then
		if($_FILES) {
			$id=$request->get('id');
			$em = $this->getDoctrine()->getManager();
			$entity = $em->getRepository('CampsiteAdminBundle:Users')->find($id);
			$oldImage = $entity->getImg();
			$entity->upload($_FILES);
            $em->persist($entity);
            $em->flush();
			$oldimagePath=$entity->getUploadRootDir().'/'.$oldImage;
			unset($oldimagePath);
			echo $this->container->get('templating.helper.assets')->getUrl('img/users/'.$entity->getImg());
			//echo $entity->getImg();
			exit;
		}

		$fieldName = $request->get('element_id');
		$id = $request->get('id');
		$value =$request->get('update_value');
		
		if(!empty($value)) {
			$em = $this->getDoctrine()->getManager();
			$userProfile = $em->getRepository('CampsiteAdminBundle:Users')->find($id);
			
			switch($fieldName) {
				case 'firstName':
					$userProfile->setFirstName($value);
					break;
				case 'lastName':
					$userProfile->setLastName($value);
					break;	
				case 'title':
					$userProfile->setTitle($value);
					break;		
				case 'company':
					$userProfile->setCompany($value);
					break;	
				case 'description':
					$userProfile->setDescription($value);
					break;		
					
			}
			$em->persist($userProfile);
			$em->flush();	
		}
		return new Response ($value); 		
		exit;
	}
}
