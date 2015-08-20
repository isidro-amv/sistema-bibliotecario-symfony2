<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PersonSimpleSearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido_paterno','text')
            ->add('apellido_materno')
            ->add('fecha_nacimiento', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array('class' => 'datepicker')
            ))
            ->add('escuela')
            ->add('email')
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_personSimpleSearchtype';
    }

}