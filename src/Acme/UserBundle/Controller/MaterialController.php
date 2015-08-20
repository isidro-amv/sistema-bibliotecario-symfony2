<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\UserBundle\Entity\Material;
use Acme\UserBundle\Form\MaterialType;

/**
 * Material controller.
 *
 * @Route("/material")
 */
class MaterialController extends Controller
{
    /**
     * Lists all Material entities.
     *
     * @Route("/", name="material")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeUserBundle:Material')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Material entity.
     *
     * @Route("/{id}/show", name="material_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeUserBundle:Material')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Material entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Material entity.
     *
     * @Route("/new", name="material_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Material();
        $form   = $this->createForm(new MaterialType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Material entity.
     *
     * @Route("/create", name="material_create")
     * @Method("post")
     * @Template("AcmeUserBundle:Material:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Material();
        $request = $this->getRequest();
        $form    = $this->createForm(new MaterialType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('material_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Material entity.
     *
     * @Route("/{id}/edit", name="material_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeUserBundle:Material')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Material entity.');
        }

        $editForm = $this->createForm(new MaterialType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Material entity.
     *
     * @Route("/{id}/update", name="material_update")
     * @Method("post")
     * @Template("AcmeUserBundle:Material:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeUserBundle:Material')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Material entity.');
        }

        $editForm   = $this->createForm(new MaterialType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('material_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Material entity.
     *
     * @Route("/{id}/delete", name="material_delete")
     * @Method("post")
     */
    public function deleteAction()
    {
        /*$form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeUserBundle:Material')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Material entity.');
            }

            $em->remove($entity);
            $em->flush();
        }*/

        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            if (isset($_POST['id'])) {
               $id = $_POST['id'];
                $em = $this->getDoctrine()->getEntityManager();
                $entity = $em->getRepository('AcmeUserBundle:Material')->find($id);

               if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Book entity.');
                }

                $em->remove($entity);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('AcmeUserBundle_catalago'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
