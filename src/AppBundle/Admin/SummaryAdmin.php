<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\Page\Vacancy;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SummaryAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('name', null, [
                'label' => 'Имя'
            ])
            ->add('surname', null, [
                'label' => 'Фамилия'
            ])
            ->add('city', null, [
                'label' => 'Город'
            ])
            ->add('phone', null, [
                'label' => 'Телефон'
            ])
            ->add('email', null, [
                'label' => 'Почта'
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('name', null, [
                'label' => 'Имя'
            ])
            ->add('surname', null, [
                'label' => 'Фамилия'
            ])
            ->add('city', null, [
                'label' => 'Город'
            ])
            ->add('phone', null, [
                'label' => 'Телефон'
            ])
            ->add('email', null, [
                'label' => 'Почта'
            ])
            ->add('message', null, [
                'label' => 'Сообщение',
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('name', TextType::class,  [
                'required' => false,
                'label' => 'Имя'
            ])
            ->add('surname', TextType::class,  [
                'required' => false,
                'label' => 'Фамилия'
            ])
            ->add('city', TextType::class,  [
                'required' => false,
                'label' => 'Город'
            ])
            ->add('phone', TextType::class,  [
                'required' => false,
                'label' => 'Телефон'
            ])
            ->add('email', TextType::class,  [
                'required' => false,
                'label' => 'Почта'
            ])
            ->add('message', TextareaType::class,  [
                'required' => false,
                'label' => 'Сообщение',
                'attr' => [
                    'rows' => 8
                ]
            ])
            ->add('vacancy', 'sonata_type_model', [
                'label' => 'Вакансия',
                'by_reference' => false,
                'class' => Vacancy::class,
                'property' => 'title'
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name', null, [
                'label' => 'Имя'
            ])
            ->add('surname', null, [
                'label' => 'Фамилия'
            ])
            ->add('city', null, [
                'label' => 'Город'
            ])
            ->add('phone', null, [
                'label' => 'Телефон'
            ])
            ->add('email', null, [
                'label' => 'Почта'
            ])
            ->add('message', null, [
                'label' => 'Сообщение',
            ])
        ;
    }
}
