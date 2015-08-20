<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
 * Catalago controller.
 *
 * @Route("admin/catalago")
 */
class UsuariosController extends Controller{
    public function Action($name){
        
    }

    public function holaAction(){
        return $this->render('AcmeUserBundle:Default:hola.html.twig');
    }

    public function indexAction($msg_success = "", $msg_error = ""){
        $request = $this->getRequest();
        $person       = new Person();

        //////////////////  crea un manejador de doctrine /////////////////////
        $em = $this->getDoctrine()->getEntityManager();
        $personSimple = $this->createForm(new PersonSimpleSearchType());


        /////////////////////////// Crea los formularios de consulta rápida ///////////
        $defaultData = array('message' => '');
        $formPerson = $this->createFormBuilder($defaultData)
            ->add('palabras','text', array('attr' => array('placeholder' => 'Escribe algo')))
            ->getForm();

        $formUser = $this->createFormBuilder($defaultData)
            ->add('palabras','text', array('attr' => array('placeholder' => 'Escribe algo')))
            ->getForm();
        ///////////////////////////////////////////////////////////////////////////////////




        return $this->render('AcmeUserBundle:Admin:usuarios.html.twig',array(
             ///////////////// Selecciona la pesta #2     ///////////////////
             'is_select_2'          =>'botonTabSelect',
             /////////////////// formularios de entidad persona /////////////
             'formPerson'           => $formPerson->createView(),
             'formPersonSimple'     => $personSimple->createView(),
             'formUser'             => $formUser->createView(),
             'msg_success'          => $msg_success,
             'msg_error'            => $msg_error,

         ));    
    }

    public function nuevoUsuarioAction(){
        $msg_success = "";
        $msg_error   = "";
        $request = $this->getRequest();
        //////////////////  crea un manejador de doctrine /////////////////////
        $em = $this->getDoctrine()->getEntityManager();

        $person       = new Person();
        $municipality = new Municipality();
        $address      = new Address();
        $phone        = new Phone();

 
        $personNew    = $this->createForm(new PersonType());
        if ('POST' === $request->getMethod()) {
            ///////////////////  AGREGAR USUARIOS   ////////////////////
            if ($request->request->has($personNew->getName())) {
                $postData = $request->request->get($personNew->getName());


                $phone->setTelefono1($postData['telefono_1']);
                $phone->setTelefono2($postData['telefono_2']);
                $phone->setCelular($postData['celular']);

                $municipality = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Municipality')
                     ->find($postData['municipio']);

                $address->setMunicipalityId($municipality);
                $address->setAddress($postData['direccion']);

                $person->setNombre($postData['nombre']);
                $person->setApellidoPaterno($postData['apellido_paterno']);
                $person->setApellidoMaterno($postData['apellido_materno']);
                $person->setFechaNacimiento( new \DateTime($postData['fecha_nacimiento']));
                $person->setOcupacion($postData['ocupacion']);
                $person->setEscuela($postData['escuela']);
                $person->setPeriodoEscolar($postData['periodo_escolar']);
                $person->setEmail($postData['email']);
                $person->setStatus($postData['status']);
                $person->setClave($postData['clave']);
                $person->setFechaRegistro( new \DateTime());

                $person->setAddressId($address);
                $person->setTelefono($phone);

                try{
                    $em->persist($phone);
                    $em->flush();

                    $em->persist($address);
                    $em->flush();
                    
                    $em->persist($person);
                    $em->flush();

                    $msg_success = "se ha ingresado correctamente un nuevo usuario";
                }catch(Exception $e) {
                    $mgs_error= "No se ha ingresado correctamente un nuevo usuario";
                }                


                #return $this->redirect($this->generateUrl('AcmeUserBundle_usuarios'));
                #return new Response('<html>'.var_dump($_POST).'</html>');
               

                $response = $this->forward('AcmeUserBundle:Usuarios:index', array(
                    'msg_success'  =>  $msg_success,
                    'msg_error'    =>  $msg_error,
                ));
                return $response;
            }
        }

        

        return $this->render('AcmeUserBundle:Admin:new_user.html.twig',array(
             ///////////////// Selecciona la pesta #2     ///////////////////
             'is_select_2'          =>'botonTabSelect',
             'formNewPerson'        => $personNew->createView(),
         ));    
    }

    public function findPersonAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        $personSimple = $this->createForm(new PersonSimpleSearchType());
        if ('POST' === $request->getMethod()) {
            ///////////////////  AGREGAR USUARIOS   ////////////////////
            if ($request->request->has($personSimple->getName())) {
                $postData = $request->request->get($personSimple->getName());

                $query  =  $em->createQuery($this->generateQueryRecordUsuarios($postData));
                $result = $query->getResult();
                //return new Response('<html>'.var_dump($postData).'</html>');
            }else{
                $result = $em->getRepository('AcmeUserBundle:Person')->findAll();
            }
        }else{
            $result = $em->getRepository('AcmeUserBundle:Person')->findAll();
        }

        /*if ('POST' === $request->getMethod()) {
            $postData = $request->request->get('form','N');
            if ($postData !='N') {
                $words = $postData['palabras'];
                ////////////////// BUSQUEDA DE USUARIOS POR UNA PALABRA
                $query = $em->createQuery(
                    'SELECT p FROM AcmeUserBundle:Person p
                        WHERE p.nombre LIKE :words OR p.apellido_paterno LIKE :words  OR p.apellido_materno LIKE :words 
                            OR p.escuela LIKE :words OR p.id LIKE :words
                        ORDER BY p.nombre ASC'
                )->setParameter('words',"%$words%");
            }else{
                $postData = $request->request->get('acme_userbundle_personSimpleSearchtype','N');
                if ($postData !='N') {
                    $nombre           = $postData['nombre'];
                    $apellido_paterno = $postData['apellido_paterno'];
                    $apellido_materno = $postData['apellido_materno'];
                    $fecha_nacimiento = $postData['fecha_nacimiento'];
                    $ocupacion        = $postData['ocupacion'];
                    $escuela          = $postData['escuela'];
                    $email            = $postData['email'];
                    $clave            = $postData['clave'];
                    
                    ///////// CONSULTA DQL DE BUSQUEDA AVANZADA
                    $query = $em->createQuery(
                        'SELECT p FROM AcmeUserBundle:Person p
                            WHERE p.nombre LIKE :nombre OR p.apellido_paterno LIKE :ap AND p.apellido_materno LIKE :am 
                                AND p.fecha_nacimiento LIKE :fn AND p.ocupacion LIKE :ocupacion AND p.escuela LIKE :escuela 
                                AND p.email = :email AND p.clave = :clave
                            ORDER BY p.nombre ASC'
                    )->setParameters(array(
                        'nombre' => "%$nombre%",
                        'ap'  => "%$apellido_paterno%",
                        'am'  => "%$apellido_materno%",
                        'fn'   => "%$fecha_nacimiento%",
                        'ocupacion' => "%$ocupacion%",
                        'escuela'   => "%$escuela%",
                        'email'  => "%$email%",
                        'clave' => "%$clave%"
                    ));
                }
            }

            $result = $query->getResult();            
        }else{
            $result = $em->getRepository('AcmeUserBundle:Person')->findAll();
        }*/
        $em->flush();
        return $this->render('AcmeUserBundle:Admin:result.html.twig',array(
            'view' => 'AcmeUserBundle:Person:index.html.twig',
            'is_select_2'=>'botonTabSelect',
            'entities' => $result,
        ));
    }

    public function findAdminAction(Request $request){
        //return new Response('<html><body>Hello '.var_dump($_POST).'!</body></html>');
        $em = $this->getDoctrine()->getEntityManager();
        if ('POST' === $request->getMethod()) {
            $postData = $request->request->get('form','N');
            if ($postData !='N') {
                $words = $postData['palabras'];
                //CONSULTA DE USUARIOS POR 
                $query = $em->createQuery(
                    'SELECT u FROM AcmeUserBundle:User u
                        WHERE u.username LIKE :words OR u.apellido_paterno LIKE :words  OR u.apellido_materno LIKE :words 
                        ORDER BY u.nombre ASC'
                )->setParameter('words',"%$words%");
            }

            $result = $query->getResult();            
        }else{
            $result = $em->getRepository('AcmeUserBundle:User')->findAll();
        }
        $em->flush();
        return $this->render('AcmeUserBundle:Admin:result.html.twig',array(
            'view' => 'AcmeUserBundle:User:index.html.twig',
            'is_select_2'=>'botonTabSelect',
            'entities' => $result,
        ));
    }

    function generateQueryRecordUsuarios($post){
        $params = '';
        $thereisbehind = false;  //para saber si algun parametro ya ha sido incluido

        if (isset($post['nombre']) and $post['nombre']!='') {
            $params .= $this->addAND($thereisbehind)."p.nombre = '".$post['nombre']."'";
            $thereisbehind = true;
        }

        if (isset($post['apellido_paterno']) and $post['apellido_paterno']!='' ) {
            $params .= $this->addAND($thereisbehind)."p.apellido_paterno = '".$post['apellido_paterno']."'";
            $thereisbehind = true;
        }

        if (isset($post['apellido_materno']) and $post['apellido_materno']!='' ) {
            $params .= $this->addAND($thereisbehind)."p.apellido_materno = '".$post['apellido_materno']."'";
            $thereisbehind = true;
        }

        if (isset($post['fecha_nacimiento']) and $post['fecha_nacimiento']!='' ) {
            $params .= $this->addAND($thereisbehind)."p.fecha_nacimiento = '".$post['fecha_nacimiento']."'";
            $thereisbehind = true;
        }

        if (isset($post['escuela']) and $post['escuela']!='' ) {
            $params .= $this->addAND($thereisbehind)."p.escuela = '".$post['escuela']."'";
            $thereisbehind = true;
        }

        if (isset($post['email']) and $post['email']!='' ) {
            $params .= $this->addAND($thereisbehind)."p.email = '".$post['email']."'";
            $thereisbehind = true;
        }

        if ($params =='') {
            return "SELECT p FROM AcmeUserBundle:Person p";
        }else{
            return "SELECT p FROM AcmeUserBundle:Person p WHERE $params ";
        }
        
    }


    public function addAND($thereisbehind){
        if ($thereisbehind) {
            return ' AND ';
        }else{
            return '';
        }
    }
}


