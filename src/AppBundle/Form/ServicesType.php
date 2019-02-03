<?php

namespace AppBundle\Form;

use AppBundle\Entity\Locale;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ServicesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lang', EntityType::class, array(
                'class' => Locale::class,
                'query_builder' => function (EntityRepository $qb) {
                    return $qb->createQueryBuilder('l')
                        ->where('l.status = 1')
                        ->orderBy('l.id', 'ASC');
                },
                'choice_label' => 'code',
                'label' => 'Choisir une langue',
                'attr' => array(
                    'class' => 'custom-select mr-sm-2',
                ),
            ))
            ->add('url', TextType::class, ['label' => 'Nom url (généralement comme le titre)', 'attr' => ['class' => 'form-control']])
            ->add('title', TextType::class, ['label' => 'Titre', 'attr' => ['class' => 'form-control']])
            ->add('icon', HiddenType::class)
            ->add('text', TextareaType::class, ['label' => 'Texte descriptif', 'attr' => ['class' => 'form-control content']])
            ->add('about', TextType::class, ['label' => 'résumé du service (petite carte)', 'attr' => ['class' => 'form-control']])
            ->add('message', TextType::class, ['required' => false, 'label' => 'Votre message perso', 'attr' => ['class' => 'form-control']])
            ->add('benefits', CollectionType::class, array(
                'entry_type' => BenefitType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'label' => false,
                'by_reference' => false,
                'allow_delete' => true,
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Services'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_services';
    }


}
