<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RecordType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('dia_sacado')
            ->add('dia_regreso')
            ->add('dia_regresado')
            ->add('comentario')
            ->add('recibido')
            ->add('book_id', 'entity' , array(
                      'class'    => 'AcmeUserBundle:Book' ,
                      'property' => 'id'))
            ->add('person_id', 'entity' , array(
                      'class'    => 'AcmeUserBundle:Person' ,
                      'property' => 'id' ))
            ->add('admin_entrega', 'entity' , array(
                      'class'    => 'AcmeUserBundle:User' ,
                      'property' => 'id' ))
            ->add('admin_recibe', 'entity' , array(
                      'class'    => 'AcmeUserBundle:User' ,
                      'property' => 'id' ))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_recordtype';
    }
}

?>