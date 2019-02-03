<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Locale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimelineType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', HiddenType::class)
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
            ->add('title', TextType::class, ['label' => 'Titre', 'attr' => array('class' => 'form-control')])
            ->add('text', TextareaType::class, ['label' => 'Texte', 'attr' => array('class' => 'form-control')])
            ->add('dateStart', IntegerType::class, ['label' => 'Date de début', 'attr' => array('class' => 'form-control')])
            ->add('dateEnd', IntegerType::class, ['label' => 'Date de fin', 'required' => false, 'attr' => array('class' => 'form-control')]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Timeline'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_timeline';
    }


}
