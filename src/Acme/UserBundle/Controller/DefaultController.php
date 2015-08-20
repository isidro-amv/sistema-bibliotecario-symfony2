<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\UserBundle\Entity\Search;
use Acme\UserBundle\Entity\Book;
use Acme\UserBundle\Form\BookSimpleType;
use Acme\UserBundle\Form\BookType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('AcmeUserBundle:Default:index.html.twig');
    }

    public function holaAction($name){
    	return $this->render('AcmeUserBundle:Default:hola.html.twig', array('name' => $name));
    }

    public function testAction(){
    	//return $this->render('AcmeUserBundle:Default:hola.html.twig', array('name' => $name));
        $em = $this->getDoctrine()->getEntityManager();
        $book = $em->getRepository('AcmeUserBundle:Book')->find(1);
        $autor = $em->getRepository('AcmeUserBundle:Author')->find(1);

        $book->addAuthor($autor);
        $book->setTitulo("hola mun");
        $em->persist($book);
        $em->flush();
        //$titulo = $book->getTitulo;

        if (!$em) {
            throw $this->createNotFoundException('No Book found for id '.'4');
        }else{
            return new Response('Se ha encontrado: '."tes");
        }
        //return $this->render('AcmeUserBundle:Admin:index.html.twig', array('autores' => $autores));
    }
}