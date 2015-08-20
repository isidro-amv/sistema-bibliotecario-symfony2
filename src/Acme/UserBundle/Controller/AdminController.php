<?php

namespace Acme\UserBundle\Controller;

use Acme\UserBundle\Entity\Search;
use Acme\UserBundle\Entity\Book;
use Acme\UserBundle\Form\BookSimpleType;
use Acme\UserBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    
    public function indexAction(){
    }

    public function catalagoAction()
    {
        //$words = $words['palabras'];
        //$book = new Book();
        //$search->setPalabras('this some ones words'); //pone un valor a palabras
        //$form = $this->createForm(new BookType(),$book);
        return $this->render('AcmeUserBundle:Admin:catalago.html.twig',array(
            //'form' => $form->createView(),
            'pestana' => 'catalogo',
            'is_select_1'=>'botonTabSelect',
            //'path_action'=> 'AcmeUserBundle_admin',
        ));
        //return $this->render('AcmeUserBundle:Admin:hola.html.twig',array('pestana' => 'catalogo','is_select_1'=>'botonTabSelect'));
    }

    public function usuariosAction()
    {
        return $this->render('AcmeUserBundle:Admin:hola.html.twig',array('pestana' => 'usuarios','is_select_2'=>'botonTabSelect'));
        //return $this->redirect($this->generateUrl('/hola'));
    }

    public function circulacionAction()
    {
        return $this->render('AcmeUserBundle:Admin:hola.html.twig',array('pestana' => 'circulacion','is_select_3'=>'botonTabSelect'));
        //return $this->redirect($this->generateUrl('/hola'));
    }

    public function reportesAction()
    {
        return $this->render('AcmeUserBundle:Admin:hola.html.twig',array('pestana' => 'reportes','is_select_4'=>'botonTabSelect'));
        //return $this->redirect($this->generateUrl('/hola'));
    }

    public function findBookAction(Request $request)
    {
        $search = new Search();
         //$search->setPalabras('this some ones words'); //pone un valor a palabras
         
        if($request->getMethod()=='POST'){
            $words ="";
            //Obtiene de que formulario probiene el request (POST) en caso de que no exista le asigna la letra N
             $postData = $request->request->get('quick_search_book','N');
            
            //$postData = $request->request->get('form','a');
            //$postData2 = $request->request->get('acme_userbundle_bookSimpletype','b'); //obtiene el post de BookSimpleType
            //$words = $postData['palabras'];
            
             if($postData!='N'){ 
                $words = $postData['palabras'];//accede a metodo getPalabras del Entity del formulario (POST)
             }else{
                //acme_userbundle_bookSimpletype es el nombre del Formulario BookSimpleType
                $postData = $request->request->get('acme_userbundle_bookSimpletype','N');
                //$autor = $postData['autor'];
                $titulo = $postData['titulo'];  
                $clasificacion = $postData['clasificacion']; 
            
                $repository = $this->getDoctrine()
                    ->getRepository('AcmeUserBundle:Book');
                $book = $repository->findAll();

                /*$em = $this->getDoctrine()->getEntityManager();
                $dql = "select a from AcmeUserBundle:Book a where a.autor=:autor";
                $query = $em->createQuery($dql);
                $query->setParameter('autor', $autor);
                $book = $query->getResult();*/

                if (!$book) {
                    //throw $this->createNotFoundException('No Book found for id '.$autor);
                }else{
                    //return new Response('Se ha encontrado: '.$book->getId());
                }
                /*$autor = $postData['autor']; 
                $book = new Book();
                $book->setAutor($autor);
                $book->setTitulo($titulo);
                $book->setClasificacion($clasificacion);
                $book->setCantidad(2);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($book);
                $em->flush();*/
             }
            //return new Response('Created product id '.$book->getId());
            return $this->render('AcmeUserBundle:Admin:result.html.twig',array('books' => $book,));
        }else{
               return new Response('<html><body>Hello GET!</body></html>');  
        }
    }

    public function findBookActionAdvaced()
    {
        $request = Request::createFromGlobals();
        if($request->getMethod()=='POST'){
             $words = $request->request->get('acme_userbundle_bookSimpletype','N');
             $words = $words['titulo'];    
            return $this->render('AcmeUserBundle:Admin:result.html.twig',array('palabra' => $words,));
         }else{
             
        }
     }


    public function managerBook(){
        $request = Request::createFromGlobals();
        if($request->getMethod()=='POST'){
            $form = $request->request->get('form','Nothing variable');
            $cantidad = $form['cantidad'];
            $titulo = $form['titulo'];

            $book = new Book();
            $book->setTitle($title);
            $book->setCantidad($cantidad); 
            $book->save(); 
        }
    }

}
