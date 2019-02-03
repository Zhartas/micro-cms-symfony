<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sitename', TextType::class, array('label' => 'Nom du site', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('url', TextType::class, array('label' => 'URL principal', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('imageFile', VichImageType::class, [
                'attr'=> array('class'=>'custom-file-input'),
                'required' => false,
                'label'=> 'OG Image',

                'label_attr' => array(
                    'class' => 'custom-file-label'
                )

            ])
            ->add('metaTitle', TextType::class, array('label' => 'méta title', 'required' => false, 'attr' => array('class' => 'form-control', 'maxlength' => 60)))
            ->add('metaDescription', TextareaType::class, array('label' => 'méta description', 'required' => false, 'attr' => array('maxlength' => 300, 'rows' => 3, 'class' => 'form-control')))
            ->add('theme', HiddenType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Site'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_site';
    }


}
