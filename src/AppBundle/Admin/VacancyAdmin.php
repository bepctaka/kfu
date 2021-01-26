<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\Vacancy;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class VacancyAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title', null, [
                'label' => 'Заголовок'
            ])
            ->add('subtitle', null, [
                'label' => 'Подзаголовок'
            ])
            ->add('description', null, [
                'label' => 'Описание'
            ])
            ->add('skill', null, [
                'label' => 'Навык'
            ])
            ->add('type', null, [
                'label' => 'Тип'
            ])
            ->add('age', null, [
                'label' => 'Возраст'
            ])
            ->add('team', null, [
                'label' => 'Команда'
            ])
            ->add('language', null, [
                'label' => 'Языки'
            ])
            ->add('image', null, [
                'label' => 'Изображение'
            ])
        ;
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
            ->add('skill', null, [
                'label' => 'Навык'
            ])
            ->add('type', null, [
                'label' => 'Тип'
            ])
            ->add('age', null, [
                'label' => 'Возраст'
            ])
            ->add('team', null, [
                'label' => 'Команда'
            ])
            ->add('language', null, [
                'label' => 'Языки'
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
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('title', TextType::class,  [
                'required' => false,
                'label' => 'Заголовок'
            ])
            ->add('subtitle', TextType::class,  [
                'required' => false,
                'label' => 'Подзаголовок'
            ])
            ->add('description', TextareaType::class,  [
                'required' => false,
                'label' => 'Описание'
            ])
            ->add('experience', TextType::class,  [
                'required' => false,
                'label' => 'Опыт'
            ])
            ->add('skill', TextType::class,  [
                'required' => false,
                'label' => 'Навык'
            ])
            ->add('type', TextType::class,  [
                'required' => false,
                'label' => 'Тип'
            ])
            ->add('age', IntegerType::class,  [
                'required' => false,
                'label' => 'Возраст'
            ])
            ->add('team', TextType::class,  [
                'required' => false,
                'label' => 'Команда'
            ])
            ->add('language', TextType::class,  [
                'required' => false,
                'label' => 'Языки'
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
        ;
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
            ->add('skill', null, [
                'label' => 'Навык'
            ])
            ->add('type', null, [
                'label' => 'Тип'
            ])
            ->add('age', null, [
                'label' => 'Возраст'
            ])
            ->add('team', null, [
                'label' => 'Команда'
            ])
            ->add('language', null, [
                'label' => 'Языки'
            ])
            ->add('image', null, [
                'label' => 'Изображение'
            ])
        ;
    }
}
