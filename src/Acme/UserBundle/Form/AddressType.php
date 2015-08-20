<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('address')
            ->add('municipality_id','entity' , array(
                      'class'    => 'AcmeUserBundle:Municipality' ,
                      'property' => 'id' ,
                      'multiple' => false ,
                      'expanded' => true ))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_addresstype';
    }
}
