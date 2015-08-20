<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido_paterno')
            ->add('apellido_materno')
            ->add('pais')
            ->add('book', 'entity' , array(
                      'class'    => 'AcmeUserBundle:Book' ,
                      'property' => 'titulo' ,
                      'expanded' => true ,
                      'multiple' => true , ))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_authortype';
    }
}
