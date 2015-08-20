<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('celular')
            ->add('telefono_1')
            ->add('telefono_2')
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_phonetype';
    }
}
