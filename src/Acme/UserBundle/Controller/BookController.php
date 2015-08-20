<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\UserBundle\Entity\Book;
use Acme\UserBundle\Entity\Author;
use Acme\UserBundle\Form\BookType;
use Acme\UserBundle\Form\Book2Type;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Book controller.
 *
 * @Route("/admin/book")
 */
class BookController extends Controller
{
    /**
     * Lists all Book entities.
     *
     * @Route("/", name="admin_book")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeUserBundle:Book')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Book entity.
     *
     * @Route("/{id}/show", name="admin_book_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();     

        $entity = $em->getRepository('AcmeUserBundle:Book')->find($id);
        $entity_autor = $entity->getAuthor();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        return array(
            'entity'      => $entity,
            'entity_autor'=> $entity_autor,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Book entity.
     *
     * @Route("/new", name="admin_book_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Book();
        $form   = $this->createForm(new BookType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Book entity.
     *
     * @Route("/create", name="admin_book_create")
     * @Method("post")
     * @Template("AcmeUserBundle:Book:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Book();
        $request = $this->getRequest();
        $form    = $this->createForm(new BookType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_book_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Book entity.
     *
     * @Route("/{id}/edit", name="admin_book_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();     

        $entity = $em->getRepository('AcmeUserBundle:Book')->find($id);
        $entity_autor = $entity->getAuthor();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        $editForm = $this->createForm(new BookType()/*,$entity*/);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'   => $entity,
            'entity_autor' => $entity_autor,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Book entity.
     *
     * @Route("/{id}/update", name="admin_book_update")
     * @Method("post")
     * @Template("AcmeUserBundle:Book:edit.html.twig")
     */
    public function updateAction($id)
    {
        
        $request = Request::createFromGlobals();
        $em          = $this->getDoctrine()->getEntityManager();
        $book        = $em->getRepository('AcmeUserBundle:Book')->find($id);
        $author_1    = new Author();
        $author_2    = new Author();
        $author_3    = new Author();
        $formEditBook = $this->createForm(new BookType()/*,$book*/);

        if ('POST' === $request->getMethod()) {
            
            ///////////////////  AGREGAR lIBROS   ////////////////////
            //$formEditBook->bindRequest($request);
            if ($request->request->has($formEditBook->getName())) {
                
                /// agrega los datos normales
                $postData = $request->request->get($formEditBook->getName());   
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


                
                foreach ($book->getAuthors() as $author) {
                    $book->removeAuthor($author);
                }
                     
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
                        $book->addAuthor($author);
                    }else{
                        $author_1->setNombre($postData['autor_nombre_1']);
                        $author_1->setApellidoPaterno($postData['autor_ap_1']);
                        $author_1->setApellidoMaterno($postData['autor_am_1']);
                        $author_1->setPais($postData['autor_pais_1']);
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
                    $em->flush();
                    $msg_success = "Se ha ingresado nuevo Libro correctamente";  
                }catch (Exception $e) {
                    $msg_error  = "No  Se ha ingresado nuevo Libro correctamente";
                }
    
            }

            /////////////////////////////////////////////////////////
        }
        
        $entity = $em->getRepository('AcmeUserBundle:Book')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        $editForm   = $this->createForm(new BookType());
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        /* ---- -------------------------------------
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('admin_book_edit', array('id' => $id)));
            //return new Response($titulo[0]);
        } 
        ---------------------------------------------------
        */

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Book entity.
     *
     * @Route("/{id}/delete", name="admin_book_delete")
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
            $entity = $em->getRepository('AcmeUserBundle:Book')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Book entity.');
            }

            $em->remove($entity);
            $em->flush();
        }*/
        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            if (isset($_POST['id'])) {
               $id = $_POST['id'];
                $em = $this->getDoctrine()->getEntityManager();
                $entity = $em->getRepository('AcmeUserBundle:Book')->find($id);

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

    public function getQueryAuthor($em, $nombre, $ap, $am, $pais){   
       ///////// CONSULTA DQL DE BUSQUEDA AVANZADA

        $query = $em->createQuery(
            'SELECT a FROM AcmeUserBundle:Author a WHERE
                a.nombre = :nombre AND a.apellido_paterno = :ap AND a.apellido_materno = :am AND a.pais = :pais'
        )
        ->setParameters(array(
            'nombre' => $nombre,
            'ap'     => $ap,
            'am'     => $am,
            'pais'   => $pais,
        ))
        ->setMaxResults(1);
        $author = $query->getOneOrNullResult();

        return $author;
    }

}
