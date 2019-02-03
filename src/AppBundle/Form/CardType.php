<?php

namespace AppBundle\Form;

use AppBundle\Entity\Locale;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardType extends AbstractType
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
            ->add('title', TextType::class, ['label' => 'Titre de la carte', 'attr' => ['class' => 'form-control']])
            ->add('text', TextareaType::class, ['label' => 'Texte', 'attr' => ['class' => 'form-control']])
            ->add('icon', HiddenType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Card'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_card';
    }


}
