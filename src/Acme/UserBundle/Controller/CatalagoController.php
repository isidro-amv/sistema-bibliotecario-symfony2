<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\UserBundle\Entity\Book;
use Acme\UserBundle\Entity\Material;
use Acme\UserBundle\Entity\Author;

use Acme\UserBundle\Form\BookType;
use Acme\UserBundle\Form\BookSimpleSearchType;
use Acme\UserBundle\Form\MaterialType;
use Acme\UserBundle\Form\MaterialSimpleSearchType;
use Acme\UserBundle\Form\AuthorType;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Catalago controller.
 *
 * @Route("admin/catalago")
 */
class CatalagoController extends Controller{
    public function Action($name){
        
    }

    public function holaAction(){
        return $this->render('AcmeUserBundle:Default:hola.html.twig');
        /*
            "Test Hola"
            return $this->render('AcmeUserBundle:Default:index.html.twig', array('name' => $name));
        */
    }

    public function indexAction(Request $request){
        $em          = $this->getDoctrine()->getEntityManager();
        $msg_success = '';
        $msg_error  = '';
        $defaultData = array('message' => '');
        $book     = new Book();
        $material = new Material();
        $author_1 = new Author();
        $author_2 = new Author();
        $author_3 = new Author();

        //$search = new Search();
        //$search->setPalabras('this some ones words'); //pone un valor a palabras
        $formBook = $this->createFormBuilder($defaultData)
            ->add('palabras','text', array(
                'label' => 'Palabras: ',
                'attr'  => array('placeholder' => 'Escribe algo')))
            ->getForm();

        $formMaterial = $this->createFormBuilder($defaultData)
            ->add('palabras','text', array(
                'label' => 'Palabras: ',
                'attr' => array('placeholder' => 'Escribe algo')))
            ->getForm();


        $bookSimple = $this->createForm(new BookSimpleSearchType(),$book);
        $materialSimple = $this->createForm(new MaterialSimpleSearchType(),$material);
        $formNewBook = $this->createForm(new BookType()/*,$book*/);
        $formNewMaterial = $this->createForm(new MaterialType(),$material);
        /*$formNewAuthor = $this->createForm(new AuthorType(),$author);*/

        ///// BUSCAR TODOS LOS AUTORES Y ORDENAR POR NOMBRE
        //$authors = $em->getRepository('AcmeUserBundle:Author')->findAllOrderedByNombre();

        if ('POST' === $request->getMethod()) {
            
            ///////////////////  AGREGAR lIBROS   ////////////////////
            //$formNewBook->bindRequest($request);
            if ($request->request->has($formNewBook->getName())) {
                
                /// agrega los datos normales
                $postData = $request->request->get($formNewBook->getName());   
                $book->setTitulo($postData['titulo']);
                $book->setCantidad($postData['cantidad']);
                $book->setClasificacion($postData['clasificacion']);
                $book->setSignaturaTopografica($postData['signatura_topografica']);
                $book->setTema($postData['tema']);
                $book->setEditorial($postData['editorial']);
                $book->setLugarPublicacion($postData['lugar_publicacion']);
                $book->setFechaEdicion(new \DateTime($postData['fecha_edicion']));
                $book->setIdioma($postData['idioma']);
                $book->setTamano($postData['tamano']);
                $book->setDescripFisica($postData['descrip_fisica']);
                $book->setFormato($postData['formato']);
                $book->setNotas($postData['notas']);
                $book->setIsbn($postData['isbn']);
                $book->setVolumen($postData['volumen']);
                $book->setPaginas($postData['paginas']);
                $book->setEdicion($postData['edicion']);
                /*$book->setStatusRecord($postData['status_record']);*/
                $book->setEstadoFisico($postData['estado_fisico']);
                $book->setHits(0);

                /// agregar autor 1 si existe
                if (
                    (isset($postData['autor_nombre_1']) and $postData['autor_nombre_1']!='') or 
                    (isset($postData['autor_ap_1'])     and $postData['autor_ap_1']!='' )
                ) {

                    $author = $this->getQueryAuthor($em,
                        $postData['autor_nombre_1'],
                        $postData['autor_ap_1'],
                        $postData['autor_am_1'],
                        $postData['autor_pais_1']);
                    
                    if ($author) {
                        #$author->addBook($book);
                        #$em->persist($author);
                        #$em->flush();

                        $book->addAuthor($author);
                        //return new Response('Hola!!'.$author->getId());
                    }else{
                        $author_1->setNombre($postData['autor_nombre_1']);
                        $author_1->setApellidoPaterno($postData['autor_ap_1']);
                        $author_1->setApellidoMaterno($postData['autor_am_1']);
                        $author_1->setPais($postData['autor_pais_1']);
                        //$author_1->addBook($book);
                        $em->persist($author_1);
                        $em->flush();
                        $book->addAuthor($author_1);
                    }

                    
                }
                 
                /// agregar autor 2 si existe
                if (
                    (isset($postData['autor_nombre_2']) and $postData['autor_nombre_2']!='') or 
                    (isset($postData['autor_ap_2'])     and $postData['autor_ap_2']!='' )           
                ) {
                    $author = $this->getQueryAuthor($em,
                        $postData['autor_nombre_2'],
                        $postData['autor_ap_2'],
                        $postData['autor_am_2'],
                        $postData['autor_pais_2']);

                    if ($author) {
                        $book->addAuthor($author);
                    }else{
                        $author_2->setNombre($postData['autor_nombre_2']);
                        $author_2->setApellidoPaterno($postData['autor_ap_2']);
                        $author_2->setApellidoMaterno($postData['autor_am_2']);
                        $author_2->setPais($postData['autor_pais_2']);
                        $em->persist($author_2);
                        $em->flush();
                        $book->addAuthor($author_2);
                    }
                    
                }

                /// agregar autor 2 si existe
                if (
                    (isset($postData['autor_nombre_3']) and $postData['autor_nombre_3']!='') or 
                    (isset($postData['autor_ap_3'])     and $postData['autor_ap_3']!='' )
                ) {
                    $author = $this->getQueryAuthor($em,
                        $postData['autor_nombre_3'],
                        $postData['autor_ap_3'],
                        $postData['autor_am_3'],
                        $postData['autor_pais_3']);

                    if ($author) {
                        $book->addAuthor($author);
                    }else{
                        $author_3->setNombre($postData['autor_nombre_3']);
                        $author_3->setApellidoPaterno($postData['autor_ap_3']);
                        $author_3->setApellidoMaterno($postData['autor_am_3']);
                        $author_3->setPais($postData['autor_pais_3']);
                        $em->persist($author_3);
                        $em->flush();
                        $book->addAuthor($author_3);
                    }
                }

                try{
                    $em->persist($book);
                    $em->flush();
                    $msg_success = "Se ha ingresado nuevo libro correctamente";  
                }catch (Exception $e) {
                    $msg_error  = "No se ha ingresado nuevo libro correctamente";
                }
    
            }

            /////////////////////////////////////////////////////////
            ///////////////////  AGREGAR Materiales   ////////////////////
            //$formNewMaterial->bindRequest($request);
            if ($request->request->has($formNewMaterial->getName())) {
                $postData = $request->request->get($formNewMaterial->getName());   
                
                $material->setNombre($postData['nombre']);
                $material->setAutor($postData['autor']);
                $material->setTipo($postData['tipo']);
                $material->setSignaTopo($postData['signa_topo']);
                $material->setClasificacion($postData['clasificacion']);
                $material->setIdioma($postData['idioma']);
                $material->setCantidad($postData['cantidad']);
                $material->setPrecio($postData['precio']);
                $material->setNota($postData['nota']);
                try{
                    $em->persist($material);
                    $em->flush();
                    $msg_success = "Se ha ingresado nuevo material correctamente";
                }catch(Exception $e) {
                    $msg_error  = "No  Se ha ingresado nuevo material correctamente";
                }
                
                
            }
            /////////////////////////////////////////////////////////
        }
        

         return $this->render('AcmeUserBundle:Admin:catalago.html.twig',array(
             'formBook'           => $formBook->createView(),
             'formBookSimple'     => $bookSimple->createView(),
             'formNewBook'        => $formNewBook->createView(),
             'formMaterial'       => $formBook->createView(),
             'formMaterialSimple' => $materialSimple->createView(),
             'formNewMaterial'    => $formNewMaterial->createView(),
             'pestana'            =>'catalago',
             'path_action'        => 'AcmeUserBundle_findBook',
             'is_select_1'        =>'botonTabSelect',
             'msg_success'        => $msg_success,
             'msg_error'         => $msg_error,
              /*'formNewAuthor'      => $formNewAuthor->createView(),*/
             //'authors'            => $authors,
             //'path_actionSearchAdvanced'=> 'AcmeUserBundle_findBook',

             /*
             -----Para agregar nuevo libro----------------
             'entity' => $entity,
             'form'   => $form->createView()*/
         ));     
    }

    public function findBookAction(Request $request){
        //return new Response('<html><body>Hello '.var_dump($_POST).'!</body></html>');
        //acme_userbundle_bookSimpleSearchtype
        $em = $this->getDoctrine()->getEntityManager();

        if ('POST' === $request->getMethod()) {
            $postData = $request->request->get('form','N');
            if ($postData !='N') {
                $words = $postData['palabras'];

                //////////// CONSULTA DQL DE BUSQUEDA SIMPLE
                $query = $em->createQuery(
                    'SELECT b FROM AcmeUserBundle:Book b JOIN b.author a
                        WHERE b.titulo LIKE :words OR a.nombre LIKE :words  OR a.apellido_paterno LIKE :words 
                            OR a.apellido_materno LIKE :words OR b.isbn LIKE :words
                        ORDER BY b.titulo ASC'
                )->setParameter('words',"%$words%");
            }else{
                $postData = $request->request->get('acme_userbundle_bookSimpleSearchtype','N');
                if ($postData !='N') {
                    $titulo = $postData['titulo'];
                    $signatura_topografica = $postData['signatura_topografica'];
                    $isbn = $postData['isbn'];
                    $author = $postData['author'];
                    
                    ///////// CONSULTA DQL DE BUSQUEDA AVANZADA
                    /*$query = $em->createQuery(
                        'SELECT b FROM AcmeUserBundle:Book b JOIN b.author a
                            WHERE b.titulo LIKE :titulo AND b.signatura_topografica LIKE :signa 
                                AND b.isbn LIKE :isbn AND a.nombre LIKE :author  OR a.apellido_paterno 
                                LIKE :author OR a.apellido_materno LIKE :author
                            ORDER BY b.titulo ASC'
                    )->setParameters(array(
                        'titulo' => "%$titulo%",
                        'signa'  => "%$signatura_topografica%",
                        'isbn'   => "%$isbn%",
                        'author' => "%$author%"
                    ));*/
                    $query  =  $em->createQuery($this->generateQueryRecordBook($postData));
                     //return new Response('<html><body>Hello '.$this->generateQueryRecordBook($postData).'!</body></html>');
                }
            }

            $products = $query->getResult();            
        }else{
            $products = $em->getRepository('AcmeUserBundle:Book')->findAll();
        }
        $em->flush();

        return $this->render('AcmeUserBundle:Admin:result.html.twig',array(
                'entities' => $products,
                'view' => 'AcmeUserBundle:Book:index.html.twig',
                'is_select_1'=>'botonTabSelect',
            ));
    }

    public function findMaterialAction(Request $request){

        ///////////// NECESARIO PARA MANEJAR ENTIDADES
        $em = $this->getDoctrine()->getEntityManager();
        
        ///////////// COMPARA QUE EL REQUEST SEA POR METODO POST /////////////////
        if ('POST' === $request->getMethod()) {

            //////////////////  OBTIENE LOS DATOS DEL FORMULARIO form en CASO DE QUE NO EXISTE PODRA N
            $postData = $request->request->get('form','N');
            if ($postData !='N') {
                $words = $postData['palabras: '];

                ////////////// CONSULTA DE ACERVO POR UNA PALABRA
                $query = $em->createQuery(
                    'SELECT m FROM AcmeUserBundle:Material m WHERE 
                        m.autor LIKE :words OR m.nombre LIKE :words OR m.clasificacion LIKE :words'
                )->setParameter('words',"%$words%");
            }else{
                $postData = $request->request->get('acme_userbundle_materialSimpleSearchtype','N');
                if ($postData !='N') {
                    /*$autor = $postData['autor'];
                    $nombre = $postData['nombre'];
                    $tipo = $postData['tipo'];*/

                    
                    ///////// CONSULTA DQL DE BUSQUEDA AVANZADA
                    /*$query = $em->createQuery(
                        'SELECT m FROM AcmeUserBundle:Material m WHERE
                            m.autor LIKE :autor AND m.nombre LIKE :nombre AND m.tipo LIKE :tipo '
                    )->setParameters(array(
                        'autor' => "%$autor%",
                        'nombre'  => "%$nombre%",
                        'tipo'  => "%$tipo%",
                    ));*/
                    $query = $em->createQuery($this->generateQueryRecordMaterial($postData));
                }
            }

            $products = $query->getResult();  
        }else{
            $products = $em->getRepository('AcmeUserBundle:Material')->findAll();
        }
        $em->flush();
        return $this->render('AcmeUserBundle:Admin:result.html.twig',array(
                'entities' => $products,
                'view' => 'AcmeUserBundle:Material:index.html.twig',
                'is_select_1'=>'botonTabSelect',
            ));
    }

    public function generateQueryRecordBook($post){
        $params = '';
        $thereisbehind = false;  //para saber si algun parametro ya ha sido incluido


        if (isset($post['titulo']) and $post['titulo']!='') {
            $params .= $this->addAND($thereisbehind)."b.titulo = '".$post['titulo']."'";
            $thereisbehind = true;
        }

        if (isset($post['signatura_topografica']) and $post['signatura_topografica']!='' ) {
            $params .= $this->addAND($thereisbehind)."b.signatura_topografica = '".$post['signatura_topografica']."'";
            $thereisbehind = true;
        }

        if (isset($post['isbn']) and $post['isbn']!='' ) {
            $params .= $this->addAND($thereisbehind)."b.isbn = '".$post['isbn']."'";
            $thereisbehind = true;
        }

        if (isset($post['author']) and $post['author']!='' ) {
            $autor = $post['author'];
            $params .= $this->addAND($thereisbehind)."a.nombre LIKE '%$autor%'  OR a.apellido_paterno  LIKE '%$autor%' 
                OR a.apellido_materno LIKE '%$autor%'";
            $thereisbehind = true;
        }

        return "SELECT b FROM AcmeUserBundle:Book b JOIN b.author a WHERE $params  ORDER BY b.titulo ASC";        
    }

    public function getQueryAuthor($em, $nombre, $ap, $am, $pais){   
       ///////// CONSULTA DQL DE BUSQUEDA AVANZADA

        $query = $em->createQuery(
            'SELECT a FROM AcmeUserBundle:Author a WHERE
                a.nombre = :nombre AND a.apellido_paterno = :ap AND a.apellido_materno = :am AND a.pais = :pais'
        )->setParameters(array(
            'nombre' => $nombre,
            'ap'     => $ap,
            'am'     => $am,
            'pais'   => $pais,
        ))
        ->setMaxResults(1);
        $author = $query->getOneOrNullResult();
        return $author;
    }


    public function generateQueryRecordMaterial($post){
        $params = '';
        $thereisbehind = false;  //para saber si algun parametro ya ha sido incluido

        if (isset($post['autor']) and $post['autor']!='') {
            $params .= $this->addAND($thereisbehind)."m.autor = '".$post['autor']."'";
            $thereisbehind = true;
        }

        if (isset($post['nombre']) and $post['nombre']!='' ) {
            $params .= $this->addAND($thereisbehind)."m.nombre = '".$post['nombre']."'";
            $thereisbehind = true;
        }

        if (isset($post['tipo']) and $post['tipo']!='' ) {
            $params .= $this->addAND($thereisbehind)."m.tipo = '".$post['tipo']."'";
            $thereisbehind = true;
        }

        return "SELECT m FROM AcmeUserBundle:Material m WHERE $params ";        
    }

    public function addAND($thereisbehind){
        if ($thereisbehind) {
            return ' AND ';
        }else{
            return '';
        }
    }
}


