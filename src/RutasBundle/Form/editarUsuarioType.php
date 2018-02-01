<?php

namespace RutasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class editarUsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('nombre', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('correo', EmailType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('telefono', NumberType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('ciudad', TextType::class, array('attr' => array('class' => 'w3-input'),))
        ->add('roles', ChoiceType::class, array(
          'multiple' => true,
          'choices' => array(
            'admin' => 'ROLE_ADMIN',
            'user' => 'ROLE_USER'
          ),
        ))
        ->add('Editar', SubmitType::class, array('attr' => array('class' => 'w3-btn w3-green w3-round-large w3-xlarge'),))
        ->add('Borrar', ResetType::class, array('attr' => array('class' => 'w3-btn w3-green w3-round-large w3-xlarge'),))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RutasBundle\Entity\usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rutasbundle_usuario';
    }


}
