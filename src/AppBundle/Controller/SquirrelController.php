<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Squirrel;
use AppBundle\Form\SquirrelType;

/**
 * Squirrel controller.
 *
 * @Route("/admin/squirrel")
 */
class SquirrelController extends Controller
{

    /**
     * Lists all Squirrel entities.
     *
     * @Route("/", name="admin_squirrel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Squirrel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Squirrel entity.
     *
     * @Route("/", name="admin_squirrel_create")
     * @Method("POST")
     * @Template("AppBundle:Squirrel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Squirrel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_squirrel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Squirrel entity.
     *
     * @param Squirrel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Squirrel $entity)
    {
        $form = $this->createForm(new SquirrelType(), $entity, array(
            'action' => $this->generateUrl('admin_squirrel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Squirrel entity.
     *
     * @Route("/new", name="admin_squirrel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Squirrel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Squirrel entity.
     *
     * @Route("/{id}", name="admin_squirrel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Squirrel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Squirrel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Squirrel entity.
     *
     * @Route("/{id}/edit", name="admin_squirrel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Squirrel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Squirrel entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Squirrel entity.
    *
    * @param Squirrel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Squirrel $entity)
    {
        $form = $this->createForm(new SquirrelType(), $entity, array(
            'action' => $this->generateUrl('admin_squirrel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Squirrel entity.
     *
     * @Route("/{id}", name="admin_squirrel_update")
     * @Method("PUT")
     * @Template("AppBundle:Squirrel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Squirrel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Squirrel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_squirrel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Squirrel entity.
     *
     * @Route("/{id}", name="admin_squirrel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Squirrel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Squirrel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_squirrel'));
    }

    /**
     * Creates a form to delete a Squirrel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_squirrel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
