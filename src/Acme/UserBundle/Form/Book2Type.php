<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class Book2Type extends AbstractType
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
                    'expanded' => false ,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('a')
                            ->orderBy('a.nombre', 'ASC');
                    },))*/
            ->add('titulo')
            ->add('cantidad')
            ->add('clasificacion')
            ->add('precio')
            ->add('signatura_topografica')
            ->add('tema')
            ->add('editorial')
            ->add('lugar_publicacion')
            ->add('fecha_edicion')
            ->add('idioma')
            ->add('tamano')
            ->add('descrip_fisica')
            ->add('formato')
            ->add('notas')
            ->add('isbn')
            ->add('volumen')
            ->add('paginas')
            ->add('edicion')
            ->add('status_record')
            ->add('estado_fisico')
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_book2type';
    }
}
