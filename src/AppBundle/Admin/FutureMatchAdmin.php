<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class FutureMatchAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('flagFirstTeam')
            ->add('nameFirst')
            ->add('flagSecondTeam')
            ->add('nameSecond')
            ->add('matchDate')
            ->add('nameArena');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('flagFirstTeam', TextType::class, [
                'label' => 'Флаг 1',
            ])
            ->add('nameFirst', TextType::class, [
                'label' => 'Название команды 1'
            ])
            ->add('flagSecondTeam', TextType::class, [
                'label' => 'Флаг 2'
            ])
            ->add('nameSecond', TextType::class, [
                'label' => 'Название команды 1'
            ])
            ->add('matchDate', null, [
                'label' => 'Дата и время проведения'
            ])
            ->add('nameArena', TextType::class, [
                'label' => 'Стадион'
            ])
            ->add('isActive', null, [
                'label' => 'Активен',
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
//        $finder = new Finder();
//        $finder->files()->in(__DIR__ . '/../../../web/flags/');
//        $arrFlags = ['Выбрать флаг' => null];
//        foreach ($finder as $file) {
//            $arrFlags[$file->getRelativePathname()] = 'flags/' . $file->getRelativePathname();
//        }

        $formMapper
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Флаг 1'
            ])
            ->add('nameFirst', TextType::class, [
                'required' => false,
                'label' => 'Название команды 1'
            ])
            ->add('secondImageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Флаг 2'
            ])
            ->add('nameSecond', TextType::class, [
                'required' => false,
                'label' => 'Название команды 2'
            ])
            ->add('matchDate', null, [
                'required' => false,
                'label' => 'Дата и время проведения'
            ])
            ->add('nameArena', TextType::class, [
                'label' => 'Стадион',
                'required' => false,
            ])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => 'Активен',
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('flagFirstTeam')
            ->add('nameFirst')
            ->add('flagSecondTeam')
            ->add('nameSecond')
            ->add('matchDate')
            ->add('nameArena');
    }
}
