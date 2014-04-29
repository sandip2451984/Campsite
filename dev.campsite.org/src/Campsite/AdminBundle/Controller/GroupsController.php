<?php

namespace Campsite\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Campsite\AdminBundle\Entity\Groups;
use Campsite\AdminBundle\Form\GroupsType;

/**
 * Groups controller.
 *
 * @Route("/groups")
 */
class GroupsController extends Controller
{
    /**
     * Lists all Groups entities.
     *
     * @Route("/{communityId}", name="groups")
	 * defaults={"communityId"="1"}
     * @Template()
     */
    public function indexAction(Request $request)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $user = $this->container->get('security.context')->getToken()->getUser();
    
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CampsiteAdminBundle:Groups')->findByUserId($user->getId());

        return array(
            'entities' => $entities,
			'communityId' => $communityId
        );
    }

    /**
     * Finds and displays a Groups entity.
     *
     * @Route("/show/{id}/{communityId}", name="groups_show")
     * @Template()
     */
    public function showAction(Request $request,$id)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Groups')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Groups entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Displays a form to create a new Groups entity.
     *
     * @Route("/new/{communityId}", name="add_group")
     * @Template()
     */
    public function newAction(Request $request)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
		$user = $this->container->get('security.context')->getToken()->getUser();
        $entity = new Groups();
		
        $form   = $this->createForm(new GroupsType(), $entity);
		
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
			'communityId' => $communityId,
			'userId' => $user->getId()
        );
    }

    /**
     * Creates a new Groups entity.
     *
     * @Route("/create/{communityId}", name="groups_create")
	 * defaults={"communityId"="1"}
     * @Method("POST")
     * @Template("CampsiteAdminBundle:Groups:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Groups();
		$em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new GroupsType(), $entity);
		$communityId=$request->request->get('communitiID');
		
		$community = $em->getRepository('CampsiteAdminBundle:Community')->find($communityId);
		$form->bind($request);
			
		//if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			$entity->setCommunity($community);
            $em->persist($entity);
            $em->flush();
			//return $this->redirect($this->generateUrl('client', array('communityId'=>$communityId)));
            return $this->redirect($this->generateUrl('groups', array('communityId'=>$communityId)));
        //}

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Displays a form to edit an existing Groups entity.
     *
     * @Route("/edit/{id}/{communityId}", name="groups_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Groups')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Groups entity.');
        }

        $editForm = $this->createForm(new GroupsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
			'communityId' => $communityId
        );
    }

    /**
     * Edits an existing Groups entity.
     *
     * @Route("/update/{id}", name="groups_update")
     * @Method("POST")
     * @Template("CampsiteAdminBundle:Groups:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CampsiteAdminBundle:Groups')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Groups entity.');
        }
	
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GroupsType(), $entity);
        $editForm->bind($request);
		$communityId=$request->request->get('communitiID');
		
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('groups_edit', array('id' => $id,'communityId'=>$communityId)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Groups entity.
     *
     * @Route("/{id}/delete", name="groups_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
	    $communityId = ($request->get('communityId')!='') ? $request->get('communityId') :  $this->container->getParameter('default_communityId');
	
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CampsiteAdminBundle:Groups')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Groups entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('groups', array('communityId'=>$communityId)));
    }

	
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
