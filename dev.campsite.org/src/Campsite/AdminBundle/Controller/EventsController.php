<?php

namespace Campsite\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Campsite\AdminBundle\Entity\Events;
use Campsite\AdminBundle\Form\EventsType;

/**
 * Events controller.
 *
 * @Route("/events")
 */
class EventsController extends Controller
{
    /**
	 *    TO Hold Messages
     */
	   
	const NOT_ALLOWED_ADD_EVENT = 'You are Not Allowed to Add Event',
	      NOT_ALLOWED_EDIT_EVENT = 'You are Not Allowed to Edit Event';

    /**
     * Lists all Events entities.
     *
     * @Route("/{communityId}", name="events")
	 * 
     * @Template()
     */
    public function indexAction(Request $request)
    {
		
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampsiteAdminBundle:Events')->findByUserId($user->getId());

        return array(
            'entities' => $entities,
			'communityId' => $communityId
        );
    }

    /**
     * Finds and displays a Events entity.
     *
     * @Route("/show/{id}/{communityId}", name="events_show")
     * @Template()
     */
    public function showAction(Request $request,$id)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Events')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Events ShowAction entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Displays a form to create a new Events entity.
     *
     * @Route("/new/{groupId}/{communityId}", name="events_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $user = $this->container->get('security.context')->getToken()->getUser();
       
        $entity = new Events();
        $form   = $this->createForm(new EventsType(), $entity);
		
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'userId' => $user->getId(),
			'communityId' => $communityId,
			'groupId'=>$request->get('groupId')
        );
    }

    /**
     * Creates a new Events entity.
     *
     * @Route("/create/{communityId}", name="events_create")
     * @Method("POST")
     * @Template("CampsiteAdminBundle:Events:new.html.twig")
     */
    public function createAction(Request $request)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	    $em = $this->getDoctrine()->getManager();
        $entity  = new Events();
        $form = $this->createForm(new EventsType(), $entity);
		$communityId=$request->request->get('communityId');
		$groupId=$request->request->get('groupId');
		$group = $em->getRepository('CampsiteAdminBundle:Groups')->find($groupId);
        $form->bind($request);
	    // here we have to check if particular user is join the group then we have to Add the Event 
	    $userId= $form["userId"]->getData();
	
		$em = $this->getDoctrine()->getManager();
		$userGroups = $em->getRepository('CampsiteAdminBundle:UsersGroups')->findBy(array('fosuser'=>$userId,'group'=>$groupId));
		if(count($userGroups) > 0) {
			$entity->setGroups($group);
			$em->persist($entity);
			$em->flush();
		}
		else {
		  $this->get('session')->setFlash('notice', self::NOT_ALLOWED_ADD_EVENT);
		}
	
        return $this->redirect($this->generateUrl('events', array('communityId' => $communityId)));

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Displays a form to edit an existing Events entity.
     *
     * @Route("/edit/{id}/{communityId}", name="events_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Events')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edit Events entity.');
        }

        $editForm = $this->createForm(new EventsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Edits an existing Events entity.
     *
     * @Route("/update/{id}", name="events_update")
     * @Method("POST")
     * @Template("CampsiteAdminBundle:Events:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Events')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Events Update entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EventsType(), $entity);
        $editForm->bind($request);
		$communityId=$request->request->get('communitiID');
		
		$userId= $entity->getUserId();
		$groupId = $entity->getGroups()->getId();
	
		$em = $this->getDoctrine()->getManager();
		$userGroups = $em->getRepository('CampsiteAdminBundle:UsersGroups')->findBy(array('fosuser'=>$userId,'group'=>$groupId));
		
		if(count($userGroups) > 0) {
			$em->persist($entity);
            $em->flush();
		}
		else {
		  $this->get('session')->setFlash('notice', self::NOT_ALLOWED_EDIT_EVENT);
		}
	     //if ($editForm->isValid()) {
        return $this->redirect($this->generateUrl('events', array('communityId'=>$communityId)));
        //}

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Deletes a Events entity.
     *
     * @Route("/delete/{id}/{communityId}", name="events_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
		$communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampsiteAdminBundle:Events')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Events Delete entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('events', array('communityId'=>$communityId)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

	
}
