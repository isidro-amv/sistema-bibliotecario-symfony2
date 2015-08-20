<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RecordEntradaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder
            ->add('book_id','number',array(
                 'label' => 'Libro Id ',
            ))
            ->add('person_id','number',array(
                 'label' => 'Usuario Id ',
            ))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_recordEntradaType';
    }

}
