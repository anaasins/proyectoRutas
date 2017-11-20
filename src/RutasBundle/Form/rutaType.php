<?php

namespace RutasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class rutaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('fecha', DateType::class)
        ->add('hora')
        ->add('descripcion', TextareaType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('lugar', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('duracion', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('organizador', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('nivel', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('imagenes', TextareaType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('usuario')
        ->add('Enviar', SubmitType::class, array('attr' => array('class' => 'w3-btn w3-green w3-round-large w3-xlarge'),))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RutasBundle\Entity\ruta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rutasbundle_ruta';
    }


}
