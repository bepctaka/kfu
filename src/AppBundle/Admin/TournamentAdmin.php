<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\Page\BasePage;
use Doctrine\ORM\EntityRepository;
use function MongoDB\Driver\Monitoring\removeSubscriber;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class TournamentAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('image');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('image')
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
        $currentId = null;
        if ($this->id($this->getSubject())) {
            $currentId = $this->request->get($this->getIdParameter());
        }
        $formMapper
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Заголовок',
                'attr' => [
                    'class' => 'id-'.$currentId,
                ]
            ])
            ->add('subtitle', TextType::class, [
                'required' => false,
                'label' => 'Подзаголовок'
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
            ->add('description', null, [
                'label' => 'Описание',
                'attr' => [
                    'class' => 'ckeditor',
                ]
            ])
            ->add('children', EntityType::class, [
                'class' => BasePage::class,
                'multiple' => true,
                'choice_label' => 'title',
                'by_reference' => false,
                'query_builder' => function (EntityRepository $er) use ($currentId) {
                    $result = $er->createQueryBuilder('p')
                        ->where('p.parent is null')
                        ->andWhere('p INSTANCE OF AppBundle:Page\Tournament');
                    if (!empty($currentId)) {
                        $result
                            ->andWhere('p.id != :currentId')
                            ->orWhere('p.parent = :currentId')
                            ->setParameter('currentId', $currentId);
                    }
                    return $result;
                },
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('image');
    }
}
