<?php

namespace AppBundle\Form;

use AppBundle\Entity\Summary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SummaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'required' => false,
            ])
            ->add('surname')
            ->add('city')
            ->add('phone')
            ->add('email')
            ->add('experience')
            ->add('message')
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Summary::class,
            'csrf_protection' => false,
        ]);
    }
}
