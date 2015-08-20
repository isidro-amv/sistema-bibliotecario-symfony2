<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RecordMaterialType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('dia_regreso')
            ->add('dia_regresado')
            ->add('comentario')
            ->add('material_id', 'entity' , array(
                      'class'    => 'AcmeUserBundle:Material' ,
                      'property' => 'id'))
            ->add('person_id', 'entity' , array(
                      'class'    => 'AcmeUserBundle:Person' ,
                      'property' => 'id'
                      'label'    => 'Usuario Id' ))
        ;
    }

    public function getName()
    {
        return 'acme_userbundle_recordmaterialtype';
    }
}
