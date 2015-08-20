<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\UserBundle\Entity\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Acme\UserBundle\Entity\Person;
use Acme\UserBundle\Entity\Book;
use Acme\UserBundle\Entity\Material;

use Acme\UserBundle\Entity\Record;
use Acme\UserBundle\Form\RecordSalidaType;
use Acme\UserBundle\Form\RecordEntradaType;

use Acme\UserBundle\Entity\RecordMaterial;
use Acme\UserBundle\Form\RecordSalidaMaterialType;
use Acme\UserBundle\Form\RecordEntradaMaterialType;




/**
 * Catalago controller.
 *
 * @Route("admin/catalago")
 */
class CirculacionController extends Controller{


    public function indexAction(){
        $request = $this->getRequest();
        //////////////////  crea un manejador de doctrine /////////////////////
        $em = $this->getDoctrine()->getEntityManager();

        $person         = new Person();
        $book           = new Book();
        $material       = new Material();
        $record         = new Record();
        $recordMaterial = new RecordMaterial();

        $user = $this->container->get('security.context')->getToken()->getUser();

        // fecha de inicio de los formularios
        $record->setDiaRegreso(date("m.d.y"));

        $form_record_salida = $this->createForm(new RecordSalidaType, $record);
        $form_record_entrada = $this->createForm(new RecordEntradaType, $record);

        $recordMaterial->setDiaRegreso(date("m.d.y"));
        $form_recordMaterial_salida = $this->createForm(new RecordSalidaMaterialType, $recordMaterial);
        $form_recordMaterial_entrada = $this->createForm(new RecordEntradaMaterialType, $recordMaterial);

        /// efrl = (Error Form record Libros) Mensaje de error  
        $efrl = "";
        /// sfrl = (Success Form record Libros) Mensaje de exito 
        $sfrl = "";
        /// efrm = (Error Form record Material) Mensaje de error  
        $efrm = "";
        /// sfrm = (Success Form record Material) Mensaje de exito 
        $sfrm = "";
        
        if ('POST' === $request->getMethod()) {
            if ($request->request->has($form_record_salida->getName())) {
                $postData = $request->request->get($form_record_salida->getName());
                //$efrl = $postData['book_id'];

                $book = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Book')
                     ->find($postData['book_id']);

                $person = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Person')
                     ->find($postData['person_id']);

                $fecha_regreso = $postData['dia_regreso'];
                $fecha_regreso = $fecha_regreso['day']."-".$fecha_regreso['month']."-".$fecha_regreso['year'];
                if ($book and $person) {
                    $record->setBookId($book);
                    $record->setPersonId($person);
                    $record->setDiaSacado(new \DateTime(date("m.d.y")));
                    $record->setAdminEntrega($user);
                    $record->setRecibido(false);
                    $record->setDiaRegreso(new \DateTime($fecha_regreso));
                    //$em->persist($record);
                    $em->flush();
                    $sfrl = "se ha registrado una salida correctamente de <<".$book->getTitulo().">> para <<".$person.">>";
                }else{
                    $efrl = "No se encontró el libro";
                    if (!$person) {
                        $efrl = "No se encontró el Usuario";
                    }
                    $efrl = "No se realizó el registro de salida porque ".$efrl;
                }
            }elseif($request->request->has($form_record_entrada->getName())){
               $postData = $request->request->get($form_record_entrada->getName());

                $book = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Book')
                     ->find($postData['book_id']);

                $person = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Person')
                     ->find($postData['person_id']);

                if ($book and $person) {
                    $query = $em->createQuery(
                        'SELECT p FROM AcmeUserBundle:Record p WHERE p.book_id = :book_id  and p.person_id = :person_id
                        and p.recibido = :recibido'
                    )->setParameters(array(
                        'book_id'    => $book->getId(),
                        'person_id'  => $person->getId(),
                        'recibido'   => false,
                    ));
                    # $record = $query->getResult(); //por si se quiere extraer todos los resultados
                    # $record = $query->getSingleResult(); //por si se qquiere obligar a obtener un resultado
                    $record = $query->getOneOrNullResult();
                    if ($record) {
                        $record->setDiaRegresado(new \DateTime(date("m.d.y")));
                        $record->setRecibido(true);
                        $record->setAdminRecibe($user);
                        //$em->persist($record);
                        $em->flush();
                        $sfrl = "se ha registrado entrada del libro <<".$book->getTitulo().">> del usuario <<".$person.">>";
                    }else{
                        $efrl = "no se ha encontrado ningún préstamo para el usuario <<".$person.">>";
                    }
                }else{
                    $efrl = "No se encontró el libro";
                    if (!$person) {
                        $efrl = "No se encontró el Usuario";
                    }
                    $efrl = "No se realizó el registro de entrada porque ".$efrl;
                }
            }elseif($request->request->has($form_recordMaterial_salida->getName())) {
                $postData = $request->request->get($form_recordMaterial_salida->getName());

                $material = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Material')
                     ->find($postData['material_id']);

                $person = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Person')
                     ->find($postData['person_id']);

                $fecha_regreso = $postData['dia_regreso'];
                $fecha_regreso = $fecha_regreso['day']."-".$fecha_regreso['month']."-".$fecha_regreso['year'];
                
                if ($material and $person) {
                    $recordMaterial->setMaterialId($material);
                    $recordMaterial->setPersonId($person);
                    $recordMaterial->setDiaSacado(new \DateTime(date("m.d.y")));
                    $recordMaterial->setAdminEntrega($user);
                    $recordMaterial->setRecibido(false);
                    $recordMaterial->setDiaRegreso(new \DateTime($fecha_regreso));
                    $em->persist($recordMaterial);
                    //$em->flush();

                    $sfrm = "se ha registrado una salida correctamente de <<".$material->getNombre().">> para <<".$person.">>";
                }else{
                    $efrm = "No se encontró el Material";
                    if (!$person) {
                        $efrm = "No se encontró el Usuario";
                    }
                    $efrm = "No se realizó el registro de salida porque ".$efrm;
                }
            }elseif($request->request->has($form_recordMaterial_entrada->getName())) {
                $postData = $request->request->get($form_recordMaterial_entrada->getName());

                $material = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Material')
                     ->find($postData['material_id']);

                $person = $this->getDoctrine()
                     ->getRepository('AcmeUserBundle:Person')
                     ->find($postData['person_id']);

                if ($material and $person) {
                    $query = $em->createQuery(
                        'SELECT p FROM AcmeUserBundle:RecordMaterial p WHERE p.material_id = :material_id  and
                        p.person_id = :person_id and p.recibido = :recibido'
                    )->setParameters(array(
                        'material_id'    => $material->getId(),
                        'person_id'  => $person->getId(),
                        'recibido'   => false,
                    ));
                    # $record = $query->getResult(); //por si se quiere extraer todos los resultados
                    # $record = $query->getSingleResult(); //por si se qquiere obligar a obtener un resultado
                    $record = $query->getOneOrNullResult();
                    if ($record) {
                        
                        $record->setDiaRegresado(new \DateTime(date("m.d.y")));
                        $record->setRecibido(true);
                        $record->setAdminRecibe($user);
                        $em->persist($record);
                        $em->flush();
                        $sfrm = "se ha registrado entrada del material <<".$material->getNombre().">> del usuario <<".$person.">>";
                    }else{
                        $efrm = "no se ha encontrado ningún préstamo para el usuario <<".$person.">>";
                    }
                }else{
                    $efrm = "No se encontró el material";
                    if (!$person) {
                        $efrm = "No se encontró el Usuario";
                    }
                    $efrm = "No se realizó el registro de entrada porque ".$efrm;
                }
            }        
        }



         return $this->render('AcmeUserBundle:Admin:circulacion.html.twig',array(
            'form_record_salida'          => $form_record_salida->createView(),
            'form_record_entrada'         => $form_record_entrada->createView(),
            'form_recordMaterial_salida'  => $form_recordMaterial_salida->createView(),
            'form_recordMaterial_entrada' => $form_recordMaterial_entrada->createView(),
            'pestana'                     => 'circulacion',
            'error_form_record_libros'    => $efrl,
            'suucces_form_record_libros'  => $sfrl,
            'error_form_record_material'    => $efrm,
            'suucces_form_record_material'  => $sfrm,
            'is_select_3'                 =>'botonTabSelect'));
        //return $this->redirect($this->generateUrl('/hola'));
    }

    public function findRecordAction(){
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $view = 'AcmeUserBundle:Record:index.html.twig';
        if ($request->getMethod()==='POST') {
            $query  =  $em->createQuery($this->generateQueryRecord($_POST));
            $em->flush();
            $result = $query->getResult();

            if (isset($_POST['type']) and $_POST['type']=='ma') {
                $view = 'AcmeUserBundle:RecordMaterial:index.html.twig';
            }

        }else{
            $result = $em->getRepository('AcmeUserBundle:Record')->findAll();
        }

        return $this->render('AcmeUserBundle:Admin:result.html.twig',array(
            'view' => $view,
            'is_select_3'=>'botonTabSelect',
            'entities' => $result,
        ));
    }

    public function generateQueryRecord($post){
        $q = '';
        $tabla = '';
        $params = '';
        $order = '';
        $thereisbehind = false;  //para saber si algun parametro ya ha sido incluido

        if (isset($post['type']) and $post['type']!='') {
            if ($post['type']=='li') {
                $tabla = 'Record';
                $type = 'book';
            }elseif ($post['type']=='ma') {
                $tabla = 'RecordMaterial';
                $type = 'material';
            }

            if (isset($post['id-a']) and $post['id-a']!='') {
                $params .= $this->addAND($thereisbehind)."r.".$type."_id = '".$post['id-a']."'";
                $thereisbehind = true;
            }

            if (isset($post['id-u']) and $post['id-u']!='' ) {
                $params .= $this->addAND($thereisbehind)."r.person_id = '".$post['id-u']."'";
                $thereisbehind = true;
            }

            if (isset($post['date-ini']) and $post['date-ini']!='' ) {
                $params .= $this->addAND($thereisbehind)."r.dia_sacado > '".$post['date-ini']."'";
                $thereisbehind = true;
            }

            if (isset($post['date-fin']) and $post['date-fin']!='' ) {
                $params .= $this->addAND($thereisbehind)."r.dia_sacado < '".$post['date-fin']."'";
                $thereisbehind = true;
            }


            if ($params =='') {
                return "SELECT r FROM AcmeUserBundle:$tabla r ";
            }else{
                return "SELECT r FROM AcmeUserBundle:$tabla r WHERE $params";
            }

        }else{
            return false;
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


