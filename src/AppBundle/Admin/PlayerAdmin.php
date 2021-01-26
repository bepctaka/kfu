<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\PositionPlayer;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class PlayerAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('fullName', null, [
                'label' => 'ФИО'
            ])
            ->add('biography', null, [
                'label' => 'Биография'
            ])
            ->add('birthday', null, [
                'label' => 'День рождения'
            ]);

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
            ->add('debut', null, [
                'label' => 'Дебют'
            ])
            ->add('biography', null, [
                'label' => 'Биография'
            ])
            ->add('amountGoals', null, [
                'label' => 'Кол-во голов'
            ])
            ->add('amountGames', null, [
                'label' => 'Кол-во игр'
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
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
            ->add('birthday', DateType::class, [
                'label' => 'День рождения',
                'years' => range(1980, date('Y')),
            ])
            ->add('debut', DateType::class, [
                'label' => 'Дебют',
                'years' => range(1980, date('Y')),
            ])
            ->add('amountGoals', IntegerType::class, [
                'required' => false,
                'label' => 'Кол-во голов'
            ])
            ->add('amountGames', IntegerType::class, [
                'required' => false,
                'label' => 'Кол-во игр'
            ])
            ->add('position', 'sonata_type_model', [
                'label' => 'Позиции',
                'multiple' => true,
                'by_reference' => false,
                'class' => PositionPlayer::class,
                'property' => 'name'
            ])
            ->add('biography', TextareaType::class, [
                'required' => false,
                'label' => 'Биография',
                'attr' => [
                    'rows' => 10
                ]
            ]);
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
            ->add('debut', null, [
                'label' => 'Дебют'
            ])
            ->add('biography', null, [
                'label' => 'Биография'
            ])
            ->add('amountGoals', null, [
                'label' => 'Кол-во голов'
            ])
            ->add('amountGames', null, [
                'label' => 'Кол-во игр'
            ])
        ;
    }
}
