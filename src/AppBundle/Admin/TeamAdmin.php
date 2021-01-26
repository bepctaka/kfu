<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Player;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class TeamAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title', null, [
                'label' => 'Заголовок'
            ])
            ->add('subtitle', null, [
                'label' => 'Подзаголовок'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('title', null, [
                'label' => 'Заголовок'
            ])
            ->add('subtitle', null, [
                'label' => 'Подзаголовок'
            ])
            ->add('description', null, [
                'label' => 'Описание'
            ])
            ->add('image', null, [
                'label' => 'Изображение'
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
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Заголовок'
            ])
            ->add('subtitle', TextType::class, [
                'required' => false,
                'label' => 'Подзаголовок'
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
            ->add('logoFile', VichFileType::class, [
                'required' => false,
                'label' => 'Логотип'
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Описание',
                'attr' => [
                    'class' => 'ckeditor'
                ]
            ])
            ->add('players', 'sonata_type_model', [
                'label' => 'Игроки',
                'multiple' => true,
                'by_reference' => false,
                'class' => Player::class,
                'property' => 'fullName'
            ])
            ->add('coaches', 'sonata_type_model', [
                'label' => 'Тренера',
                'multiple' => true,
                'by_reference' => false,
                'class' => Coach::class,
                'property' => 'fullName'
            ])
            ->add('amountGames', IntegerType::class, [
                'required' => false,
                'label' => 'Количество игр',
            ])
            ->add('amountWins', IntegerType::class, [
                'required' => false,
                'label' => 'Количество побед'
            ])
            ->add('amountDrawn', IntegerType::class, [
                'required' => false,
                'label' => 'Количество ничейных игр'
            ])
            ->add('amountLesions', IntegerType::class, [
                'required' => false,
                'label' => 'Количество проигрышей'
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('title', null, [
                'label' => 'Заголовок'
            ])
            ->add('subtitle', null, [
                'label' => 'Подзаголовок'
            ])
            ->add('description', null, [
                'label' => 'Описание'
            ])
            ->add('image', null, [
                'label' => 'Изображение'
            ]);
    }
}
