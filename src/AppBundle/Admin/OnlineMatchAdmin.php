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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class OnlineMatchAdmin extends AbstractAdmin
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

            ->add('nameFirst', TextType::class, [
                'label' => 'Название команды 1'
            ])
            ->add('scoreFirstTeam', TextType::class, [
                'label' => 'Количество голов к-1',
            ])
            ->add('nameSecond', TextType::class, [
                'label' => 'Название команды 2'
            ])
            ->add('scoreSecondTeam', TextType::class, [
                'label' => 'Количество голов к-2'
            ])
            ->add('duration', null, [
                'label' => 'Продолжительность на данный момент'
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
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../../web/flags/');
        $arrFlags = ['Выбрать флаг' => null];
        foreach ($finder as $file) {
            $arrFlags[$file->getRelativePathname()] = 'flags/' . $file->getRelativePathname();
        }

        $formMapper
            ->add('flagFirstTeam', ChoiceType::class, [
                'required' => false,
                'choices' => $arrFlags,
                'label' => 'Флаг 1'
            ])
            ->add('nameFirst', TextType::class, [
                'required' => false,
                'label' => 'Название команды 1'
            ])
            ->add('scoreFirstTeam', IntegerType::class, [
                'required' => false,
                'label' => 'Количество голов команды 1'
            ])
            ->add('flagSecondTeam', ChoiceType::class, [
                'required' => false,
                'choices' => $arrFlags,
                'label' => 'Флаг 2'
            ])
            ->add('nameSecond', TextType::class, [
                'required' => false,
                'label' => 'Название команды 2'
            ])
            ->add('scoreSecondTeam', IntegerType::class, [
                'required' => false,
                'label' => 'Количество голов команды 2'
            ])
            ->add('matchDate', null, [
                'required' => false,
                'label' => 'Дата и время проведения'
            ])
            ->add('duration', TextType::class, [
                'label' => 'Продолжительность на данный момент',
                'required' => false,
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
