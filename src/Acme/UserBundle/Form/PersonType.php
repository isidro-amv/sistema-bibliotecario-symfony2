<?php

namespace Acme\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre','text')
            ->add('apellido_paterno')
            ->add('apellido_materno')
            ->add('fecha_nacimiento', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array('class' => 'datepicker')
            ))
            ->add('ocupacion','text',array(
              'label' => 'Ocupación',
              ))
            ->add('escuela')
            ->add('periodo_escolar')
            ->add('email')
            ->add('status')
            ->add('clave')
            /*->add('foto','text',array(
              'required' => false,
              ))*/
            ->add('comentario')

            ->add('telefono_1')
            ->add('telefono_2')
            ->add('celular')

            ->add('municipio','choice',array(
              'label' => 'Municipio',
              'choices'   => array(
                  '598' => 'Puerto Vallarta',  //numero de id en la base de datos
                  '947'    => 'Bahía de banderas', //numero de id en la base de datos
              ),
              'multiple'  => false,
            ))
            ->add('direccion','textarea',array(
              'label'=>'Dirección',
            ));
            /*->add('telefono','entity' , array(
                      'class'    => 'AcmeUserBundle:Phone' ,
                      'multiple' => false ,
                      'expanded' => true ,
                      'property' => 'id' 
                      ))
            ->add('address_id','entity' , array(
                      'class'    => 'AcmeUserBundle:Address' ,
                      'property' => 'id' ,
                      'multiple' => false ,
                      'expanded' => true ));
            */
            //placeholder into form
            /*->add('telefono', 'text' , array(
            'attr'=> 
                array(
                    'placeholder'=>'Ejemplo: 123, 123, 123')
                    //,'class'=>'MYCLASSFOR_INPUTS') 
            ));*/ 
        
    }

    public function getName()
    {
        return 'acme_userbundle_persontype';
    }
}
