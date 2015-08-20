<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RecordEntradaMaterialType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder
            ->add('material_id','number')
            ->add('person_id','number',array(
                 'label' => 'Usuario Id ',
            ))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_recordEntradaMaterialType';
    }

}
