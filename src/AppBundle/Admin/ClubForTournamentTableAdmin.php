<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class ClubForTournamentTableAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('name')
            ->add('game')
            ->add('goalDifference')
            ->add('points')
            ->add('position')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('name')
            ->add('game')
            ->add('goalDifference')
            ->add('points')
            ->add('position')
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
            ->add('name', TextType::class, [
                'required' => false,
                'label' => 'Название клуба'
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
            ->add('game', IntegerType::class, [
                'required' => false,
                'label' => 'Количество игр'
            ])
            ->add('goalDifference', IntegerType::class, [
                'required' => false,
                'label' => 'Разница голов'
            ])
            ->add('points', IntegerType::class, [
                'required' => false,
                'label' => 'Колличество очков'
            ])
            ->add('position', ChoiceType::class, [
                'label' => 'Позиция',
                'choices' => [
                    'Позиция в таблице' => null,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                    '12' => 12,
                    '13' => 13,
                    '14' => 14,
                    '15' => 15,
                    '16' => 16,
                ],
            ])

        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name')
            ->add('image')
            ->add('game')
            ->add('goalDifference')
            ->add('points')
            ->add('position')
        ;
    }
}
