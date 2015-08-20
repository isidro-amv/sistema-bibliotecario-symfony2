<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\UserBundle\Entity\Person;
use Acme\UserBundle\Form\PersonType;
use Acme\UserBundle\Form\PersonSimpleSearchType;

use Acme\UserBundle\Entity\Country;
use Acme\UserBundle\Entity\State;
use Acme\UserBundle\Entity\Municipality;
use Acme\UserBundle\Entity\Address;
use Acme\UserBundle\Form\AddressType;

use Acme\UserBundle\Entity\Phone;
use Acme\UserBundle\Form\PhoneType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Person controller.
 *
 * @Route("/person")
 */
class PersonController extends Controller
{
    /**
     * Lists all Person entities.
     *
     * @Route("/", name="person")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeUserBundle:Person')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Person entity.
     *
     * @Route("/{id}/show", name="person_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeUserBundle:Person')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Person entity.
     *
     * @Route("/new", name="person_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Person();
        $form   = $this->createForm(new PersonType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Person entity.
     *
     * @Route("/create", name="person_create")
     * @Method("post")
     * @Template("AcmeUserBundle:Person:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Person();
        $request = $this->getRequest();
        $form    = $this->createForm(new PersonType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('person_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Person entity.
     *
     * @Route("/{id}/edit", name="person_edit")
     * @Template()
     */
    public function editAction($id)
    {
        //crea un estancia de manejador de entidades
        $em = $this->getDoctrine()->getEntityManager();

        //busca la entidad persona
        $entity = $em->getRepository('AcmeUserBundle:Person')->find($id);

        //si no se encuentra lanza una excepción
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        //obtiene la entidad de teléfono
        $phone = $entity->getTelefono();
        //obtiene la entidad de Dirección
        $address = $entity->getAddressId();
        //obtiene la entidad de Municipio
        $municipio = $address->getMunicipalityId();

        //crea una nueva estancia del formulario pesona
        $editForm = $this->createForm(new PersonType());

        //Le asigna valores a cada uno de los campos del formlarios obtienidos de la entidad
        $editForm->get('nombre')->setData( $entity->getNombre() );
        $editForm->get('apellido_paterno')->setData( $entity->getApellidoPaterno() );
        $editForm->get('apellido_materno')->setData( $entity->getApellidoMaterno() );
        $editForm->get('fecha_nacimiento')->setData( $entity->getFechaNacimiento() );
        $editForm->get('ocupacion')->setData( $entity->getOcupacion() );
        $editForm->get('escuela')->setData( $entity->getEscuela() );
        $editForm->get('periodo_escolar')->setData( $entity->getPeriodoEscolar() );
        $editForm->get('email')->setData( $entity->getEmail() );
        $editForm->get('status')->setData( $entity->getStatus() );
        $editForm->get('clave')->setData( $entity->getClave() );
        $editForm->get('comentario')->setData( $entity->getComentario() );
        $editForm->get('telefono_1')->setData( $phone->getTelefono1() );
        $editForm->get('telefono_2')->setData( $phone->getTelefono2() );
        $editForm->get('celular')->setData( $phone->getCelular() );
        $editForm->get('municipio')->setData( $municipio->getMunicipality() );
        $editForm->get('direccion')->setData( $address->getAddress() );

        // crea el formlario para eliminar la entidad ?
        $deleteForm = $this->createDeleteForm($id);

        //retorna que manda al template
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Person entity.
     *
     * @Route("/{id}/update", name="person_update")
     * @Method("post")
     * @Template("AcmeUserBundle:Person:edit.html.twig")
     */
    public function updateAction($id)
    {

        //crear estancia del formlario de personas
        $form_edit = new PersonType();

        //inicializa varibles de status
        $msg_success = '';
        $msg_error   = '';

        //necesario para hacer uso del request
        $request = $this->getRequest();

        //declaración de manejador de entidades
        $em = $this->getDoctrine()->getEntityManager();

        //obtinen la entidad persona en base al id
        $person = $em->getRepository('AcmeUserBundle:Person')->find($id);

        //En caso de que el usuario no se encuentre lanzará un excepción
        if (!$person) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        //declara 2 estancia de entidades
        $phone     = new Phone();
        $address   = new Address();

        //obtiene los valores POST de un formulario pasándole como parametro el nombre de este
        $postData = $request->request->get($form_edit->getName());

        //Le asigna valores a un nuevo teléfono
        $phone    ->setTelefono1($postData['telefono_1']);
        $phone    ->setTelefono2($postData['telefono_2']);
        $phone    ->setCelular($postData['celular']);

        //obtiene el municipio en recibiendo como parámetro el id
        $municipality = $this->getDoctrine()
                ->getRepository('AcmeUserBundle:Municipality')
                ->find($postData['municipio']);

        //le asigna valores a una entidad dirección
        $address->setMunicipalityId($municipality);
        $address->setAddress($postData['direccion']);

        try {
            //intenta guardar la dirección
             $em ->persist($address);
             $em ->flush();
             $person->setAddressId($address);
        } catch (Exception $e) { 
            $mgs_error= "No se pudo actualizar la dirección";
        }

        //establece los valores a la entidad
        $person ->setNombre($postData['nombre']);
        $person->setApellidoPaterno($postData['apellido_paterno']);
        $person->setApellidoMaterno($postData['apellido_materno']);
        $person->setFechaNacimiento( new \DateTime($postData['fecha_nacimiento']));
        $person->setOcupacion($postData['ocupacion']);
        $person->setEscuela($postData['escuela']);
        $person->setPeriodoEscolar($postData['periodo_escolar']);
        $person->setEmail($postData['email']);
        $person->setStatus($postData['status']);
        $person->setClave($postData['clave']);
        $person->setTelefono($phone);

        //intenta guardar los datos insertados
        try{
            $em ->persist($phone);
            $em ->flush();

            $em ->persist($person);
            $em ->flush();

            $msg_success = "se ha actualizado un usuario";
        }catch(Exception $e) {
            $mgs_error= "No se ha actualizado el usuario";
        }                

        //redirecciona al controllador de usuarios en el método index
        $response = $this->forward('AcmeUserBundle:usuarios:index', array(
            'msg_success'          => $msg_success,
            'msg_error'            => $msg_error,
        ));

        return $response;
    }

    /**
     * Deletes a Person entity.
     *
     * @Route("/{id}/delete", name="person_delete")
     * @Method("post")
     */
    public function deleteAction()
    {
        /*
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeUserBundle:Person')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Person entity.');
            }

            $em->remove($entity);
            $em->flush();
        }*/
        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            if (isset($_POST['id'])) {
               $id = $_POST['id'];
                $em = $this->getDoctrine()->getEntityManager();
                $entity = $em->getRepository('AcmeUserBundle:Person')->find($id);

               if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Person entity.');
                }

                $em->remove($entity);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('AcmeUserBundle_usuarios'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
