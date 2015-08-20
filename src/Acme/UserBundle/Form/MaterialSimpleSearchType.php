<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MaterialSimpleSearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('autor','text', array('label' => 'Autor: '))
            ->add('nombre','text', array('label' => 'Nombre: '))
            ->add('tipo','text', array('label' => 'Tipo: '))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_materialSimpleSearchtype';
    }
}
