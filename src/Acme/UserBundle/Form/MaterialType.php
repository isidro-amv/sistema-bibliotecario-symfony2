<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MaterialType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
           ->add('nombre','text', array('label' => 'Nombre: '))
            ->add('autor','text', array('label' => 'Autor: '))
            ->add('tipo','text', array('label' => 'Tipo: '))
            ->add('signa_topo','text', array('label' => 'Signatura topográfica: '))
            ->add('precio','text', array('label' => 'Precio: ',))
            ->add('clasificacion','text', array('label' => 'Clasificación: '))
            ->add('idioma','text', array('label' => 'Idioma: '))
            ->add('cantidad','text', array('label' => 'Cantidad: '))
            ->add('nota','text', array('label' => 'Nota: '))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_materialtype';
    }
}
