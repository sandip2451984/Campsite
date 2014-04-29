<?php

namespace Campsite\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Campsite\AdminBundle\Entity\Session;
use Campsite\AdminBundle\Form\SessionType;
use Campsite\AdminBundle\Entity\UserTopicVote;
/**
 * Session controller.
 *
 * @Route("/session")
 */
class SessionController extends Controller
{
    /**
     * Lists all Session entities.
     *
     * @Route("/{communityId}", name="session")
     * @Template()
     */
    public function indexAction(Request $request)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		$user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampsiteAdminBundle:Session')->findByUserId($user->getId());

        return array(
            'entities' => $entities,
			'communityId' => $communityId
        );
    }

    /**
     * Finds and displays a Session entity.
     *
     * @Route("/show/{id}/{communityId}", name="session_show")
     * @Template()
     */
    public function showAction(Request $request,$id)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Displays a form to create a new Session entity.
     *
     * @Route("/new/{eventId}/{communityId}", name="session_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		$user = $this->container->get('security.context')->getToken()->getUser();
		$eventId=$request->get('eventId');
        $entity = new Session();
        $form   = $this->createForm(new SessionType(), $entity);
		
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
			'userId' => $user->getId(),
			'communityId' => $communityId,
			'eventId' => $eventId
        );
    }

    /**
     * Creates a new Session entity.
     *
     * @Route("/create/{communityId}", name="session_create")
     * @Method("POST")
     * @Template("CampsiteAdminBundle:Session:new.html.twig")
     */
    public function createAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
        $entity  = new Session();
        $form = $this->createForm(new SessionType(), $entity);
		$communityId=$request->request->get('communityId');
		$eventId=$request->request->get('eventId');
		$event = $em->getRepository('CampsiteAdminBundle:Events')->find($eventId);
        $form->bind($request);

        //if ($form->isValid()) {
            $entity->setEvent($event);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('session', array('communityId'=>$communityId)));
        //}

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Displays a form to edit an existing Session entity.
     *
     * @Route("/edit/{id}/{communityId}", name="session_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        $editForm = $this->createForm(new SessionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
			'communityId' =>$communityId
        );
    }

    /**
     * Edits an existing Session entity.
     *
     * @Route("/update/{id}", name="session_update")
     * @Method("POST")
     * @Template("CampsiteAdminBundle:Session:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
		$communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SessionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('session_edit', array('id' => $id,'communityId'=>$communityId)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Deletes a Session entity.
     *
     * @Route("/delete/{id}/{communityId}", name="session_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
		$communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampsiteAdminBundle:Session')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Session entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('session', array('communityId'=>$communityId)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    /**
     * Add Vote
     *
     * @Route("/add/vote", name="add_vote")
     * @Method("POST")
     */
	public function addVoteAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		//var_dump($request);exit;
		
		$userId =  $request->get('userId');
		$sessionId = $request->get('sessionId');
		$rating =  $request->get('vote_rating');
		$communityId = 1;
		$eventId = $request->get('eventId');
		
		
		// first we have to ceheck if record is Exist
	
		$session = $em->getRepository('CampsiteAdminBundle:Session')->find($sessionId);
		$user = $em->getRepository('CampsiteAdminBundle:Fosuser')->find($userId);
		
		$em = $this->getDoctrine()->getManager();
		$userTopicVoteObj = $em->getRepository('CampsiteAdminBundle:UserTopicVote')->findBy(array('session'=>$sessionId,'fosuser'=>$userId));
		
		// if found edit the record
		if(count($userTopicVoteObj)>0){
			 $userTopicVoteObj1 = $em->getRepository('CampsiteAdminBundle:UserTopicVote')->find($userTopicVoteObj[0]->getId());
			 $userTopicVoteObj1->setVote($rating);
			 $em->persist($userTopicVoteObj1);
             $em->flush();

		}
		else {
			$userTopicVoteObj1 = new UserTopicVote();
			$userTopicVoteObj1->setSession($session);
			$userTopicVoteObj1->setFosuser($user);
			$userTopicVoteObj1->setVote($rating);
			$em->persist($userTopicVoteObj1);
            $em->flush();
			
		}
		if($request->isXmlHttpRequest()) {
			// Get The Total No of Voting of Session id
			$userTopicVoteObj1 = $em->getRepository('CampsiteAdminBundle:Session')->getTotalVoteOfSession($sessionId);
			$rating = $userTopicVoteObj1[0][1];	
			$html= '<p><strong>'.$rating.'</strong><br><span class="tnytxt gry">votes</span></p>';
			return new Response($html);	

		} else {
			return $this->redirect($this->generateUrl('marketingcamp', 
			array('id'=>$eventId,'communityId'=>$communityId)));
		}	
				exit;
	}
}
