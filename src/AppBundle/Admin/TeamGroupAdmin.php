<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\Page\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class TeamGroupAdmin extends AbstractAdmin
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
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Заголовок'
            ])
            ->add('subtitle', TextType::class, [
                'required' => false,
                'label' => 'Подзаголовок'
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Описание',
                'attr' => [
                    'rows' => 10
                ]
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
            ->add('teams', 'sonata_type_model', [
                'label' => 'Команды',
                'multiple' => true,
                'by_reference' => false,
                'class' => Team::class,
                'property' => 'title'
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
            ->add('image', null, [
                'label' => 'Изображение'
            ])
        ;
    }
}
