<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class BookType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            /*->add('autor','entity',array(
                 'class'=>'Acme\UserBundle\Entity\Author','property'=>'nombreCompleto','multiple' => true)) //->esta es una forma */
            /*->add('author', 'entity' , array(
                      'class'    => 'AcmeUserBundle:Author' ,
                      //'property' => 'nombre' ,
                      'expanded' => true ,
                      'multiple' => true , ))*/


            /*->add('author', 'entity', array(
                    'class' => 'AcmeUserBundle:Author',
                    'multiple' => true ,
                    'expanded' => true ,
                    //realiza una consulata a la entidad author como a
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->orderBy('a.nombre', 'ASC');
                    },))*/
            ->add('autor_nombre_1','text', array('required' => false,))
            ->add('autor_ap_1' , 'text', array('required' => false))
            ->add('autor_am_1' , 'text', array('required' => false))
            ->add('autor_pais_1' , 'text', array('required' => false))

            ->add('autor_nombre_2' , 'text', array('required' => false))
            ->add('autor_ap_2' , 'text', array('required' => false))
            ->add('autor_am_2' , 'text', array('required' => false))
            ->add('autor_pais_2' , 'text', array('required' => false))

            ->add('autor_nombre_3' , 'text', array('required' => false))
            ->add('autor_ap_3' , 'text', array('required' => false))
            ->add('autor_am_3' , 'text', array('required' => false))
            ->add('autor_pais_3' , 'text', array('required' => false))

            ->add('titulo', 'text', array('label' => 'Título*: '))
            ->add('cantidad', 'number', array('label' => 'Cantidad*: ','data'=>'1'))
            ->add('clasificacion', 'text', array('required' => false,'label' => 'Clasificación: '))
            ->add('precio', 'number', array('required' => false,'label' => 'Precio: ','data'=>0,))
            ->add('signatura_topografica', 'text', array('label' => 'Signatura topográfica: '))
            ->add('tema', 'text', array('required' => false,'label' => 'Tema: '))
            ->add('editorial', 'text', array('required' => false,'label' => 'Editorial: '))
            ->add('lugar_publicacion', 'text', array('required' => false,'label' => 'Lugar de publicación: '))
            ->add('fecha_edicion', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'attr' => array('class' => 'datepicker'),
                    'required' => false,
                    'label' => 'Fecha de edición: '
                  ))
            ->add('idioma', 'text', array('required' => false,'label' => 'Idioma: '))
            ->add('tamano', 'text', array('required' => false,'label' => 'Tamaño: '))
            ->add('descrip_fisica', 'text', array('required' => false,'label' => 'Descripción física: '))
            ->add('formato', 'text', array('required' => false,'label' => 'Formato: '))
            ->add('notas', 'text', array('required' => false,'label' => 'Notas: '))
            ->add('isbn', 'text', array('required' => false,'label' => 'ISBN: '))
            ->add('volumen', 'text', array('required' => false,'label' => 'Volumen: '))
            ->add('paginas', 'number', array('required' => false,'label' => 'Páginas: '))
            ->add('edicion', 'number', array('required' => false,'label' => 'Edición: '))
            /*->add('status_record')*/
            ->add('estado_fisico', 'text', array('required' => false,'label' => 'Estado físico: '));
    }

    public function getName()
    {
        return 'acme_userbundle_booktype';
    }
}
