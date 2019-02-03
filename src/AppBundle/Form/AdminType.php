<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('constructor', CheckboxType::class, array('required' => false, 'label' => 'Site en construction', 'attr' => array('class' => 'custom-control-input')))
            ->add('firstname', TextType::class, array('required' => false, 'label' => 'Prénom', 'attr' => array('class' => 'form-control')))
            ->add('lastname', TextType::class, array('required' => false, 'label' => 'Nom','attr' => array('class' => 'form-control')))
            ->add('address', TextType::class, array('required' => false, 'label' => 'Adresse de localisation','attr' => array('class' => 'form-control')))
            ->add('cp', TextType::class, array('required' => false, 'label' => 'Code postal','attr' => array('class' => 'form-control')))
            ->add('city', TextType::class, array('required' => false, 'label' => 'Ville','attr' => array('class' => 'form-control')))
            ->add('phone', TextType::class, array('required' => false, 'label' => 'Téléphone','attr' => array('class' => 'form-control')))
            ->add('email', EmailType::class, array('required' => false, 'label' => 'Email','attr' => array('class' => 'form-control')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Admin'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_admin';
    }


}
