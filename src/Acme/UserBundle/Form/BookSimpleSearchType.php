<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BookSimpleSearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('titulo','text', array('label' => 'Título: '))
            ->add('author','text', array('label' => 'Autor: '))
            ->add('signatura_topografica','text', array('label' => 'Signatura Topográfica: '))
            ->add('isbn','text', array('label' => 'ISBN: '))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_bookSimpleSearchtype';
    }

}