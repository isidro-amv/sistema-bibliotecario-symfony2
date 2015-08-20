<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido_paterno')
            ->add('apellido_materno')
            ->add('fecha_nacimiento')
            ->add('puesto')
            ->add('apellido_paterno')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('roles')

        ;
    }

    public function getName()
    {
        return 'acme_userbundle_usertype';
    }
}
