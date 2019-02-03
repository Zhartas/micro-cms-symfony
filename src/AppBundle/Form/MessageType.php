<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array('required' => false, 'label' => "formulaire.label-prénom", 'attr' => array('class' => 'form-control', 'placeholder' => 'formulaire.placeholder-prénom')))
            ->add('lastname', TextType::class, array('required' => false, 'label' => "formulaire.label-nom", 'attr' => array('class' => 'form-control', 'placeholder' => 'formulaire.placeholder-nom')))
            ->add('society', TextType::class, array('label' => "formulaire.label-société",'required' => false,  'attr' => array('class' => 'form-control', 'placeholder' => 'formulaire.placeholder-société')))
            ->add('email', TextType::class, array('required' => false, 'label' => "formulaire.label-email", 'attr' => array('class' => 'form-control', 'placeholder' => 'formulaire.placeholder-email')))
            ->add('phone', TextType::class, array('label' => "formulaire.label-téléphone", 'required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'formulaire.placeholder-téléphone')))
            ->add('message', TextareaType::class, array('required' => false, 'label' => "formulaire.label-texte", 'attr' => array('class' => 'form-control', 'placeholder' => 'formulaire.placeholder-texte')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Message'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_message';
    }


}
