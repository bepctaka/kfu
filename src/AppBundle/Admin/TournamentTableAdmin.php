<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\ClubForTournamentTable;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class TournamentTableAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('name')
            ->add('isActive');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('name')
            ->add('isActive')
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
            ->add('name', TextType::class, [
                'required' => false,
                'label' => 'Название турнирной таблици'
            ])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => 'Активная'
            ])
            ->add('clubs', 'sonata_type_model', [
                'label' => 'Клубы',
                'multiple' => true,
                'by_reference' => false,
                'class' => ClubForTournamentTable::class,
                'property' => 'name'
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name')
            ->add('position');
    }
}
