<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facebook', UrlType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('linkedin', UrlType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('instagram', UrlType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('twitter', UrlType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('youtube', UrlType::class, array('required' => false, 'attr' => array('class' => 'form-control')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Social'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_social';
    }


}
