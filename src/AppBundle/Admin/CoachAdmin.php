<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\TypeCoach;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class CoachAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('fullName', null, [
                'label' => 'ФИО'
            ])
            ->add('birthday', null, [
                'label' => 'День рождения'
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('fullName', null, [
                'label' => 'ФИО'
            ])
            ->add('image', null, [
                'label' => 'Изображение'
            ])
            ->add('birthday', null, [
                'label' => 'День рождения'
            ])
            ->add('biography', null, [
                'label' => 'Биография'
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('fullName', TextType::class, [
                'required' => false,
                'label' => 'ФИО'
            ])
            ->add('type', 'sonata_type_model', [
                'label' => 'Тип',
                'multiple' => true,
                'by_reference' => false,
                'class' => TypeCoach::class,
                'property' => 'name',
            ])
            ->add('birthday', DateType::class, [
                'label' => 'День рождения',
                'years' => range(1960, date('Y')),
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
            ->add('biography', TextareaType::class, [
                'label' => 'Биография',
                'required' => false,
                'attr' => [
                    'rows' => 10
                ]
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('fullName', null, [
                'label' => 'ФИО'
            ])
            ->add('image', null, [
                'label' => 'Изображение'
            ])
            ->add('birthday', null, [
                'label' => 'День рождения'
            ])
            ->add('biography', null, [
                'label' => 'Биография'
            ])
        ;
    }
}
