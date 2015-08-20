<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BookSimpleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('signatura_topografica')
            ->add('isbn')
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_bookSimpletype';
    }
}
