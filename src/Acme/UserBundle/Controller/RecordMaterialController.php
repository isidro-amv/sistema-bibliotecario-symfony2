<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\UserBundle\Entity\RecordMaterial;
use Acme\UserBundle\Form\RecordMaterialType;

/**
 * RecordMaterial controller.
 *
 * @Route("/recordmaterial")
 */
class RecordMaterialController extends Controller
{
    /**
     * Lists all RecordMaterial entities.
     *
     * @Route("/", name="recordmaterial")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeUserBundle:RecordMaterial')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a RecordMaterial entity.
     *
     * @Route("/{id}/show", name="recordmaterial_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeUserBundle:RecordMaterial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RecordMaterial entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new RecordMaterial entity.
     *
     * @Route("/new", name="recordmaterial_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RecordMaterial();
        $form   = $this->createForm(new RecordMaterialType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new RecordMaterial entity.
     *
     * @Route("/create", name="recordmaterial_create")
     * @Method("post")
     * @Template("AcmeUserBundle:RecordMaterial:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new RecordMaterial();
        $request = $this->getRequest();
        $form    = $this->createForm(new RecordMaterialType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recordmaterial_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing RecordMaterial entity.
     *
     * @Route("/{id}/edit", name="recordmaterial_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeUserBundle:RecordMaterial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RecordMaterial entity.');
        }

        $editForm = $this->createForm(new RecordMaterialType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing RecordMaterial entity.
     *
     * @Route("/{id}/update", name="recordmaterial_update")
     * @Method("post")
     * @Template("AcmeUserBundle:RecordMaterial:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeUserBundle:RecordMaterial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RecordMaterial entity.');
        }

        $editForm   = $this->createForm(new RecordMaterialType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recordmaterial_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a RecordMaterial entity.
     *
     * @Route("/{id}/delete", name="recordmaterial_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeUserBundle:RecordMaterial')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RecordMaterial entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recordmaterial'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
