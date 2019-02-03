<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Locale;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResumeType extends AbstractType
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
            ->add('icon', HiddenType::class)
            ->add('number', IntegerType::class, ['attr' => array('class' => 'form-control')])
            ->add('name', TextType::class, ['attr' => array('class' => 'form-control')]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Resume'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_resume';
    }


}
