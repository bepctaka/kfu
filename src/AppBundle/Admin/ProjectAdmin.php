<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\Page\BasePage;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class ProjectAdmin extends AbstractAdmin
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
        $currentId = null;
        if ($this->id($this->getSubject())) {
            $currentId = $this->request->get($this->getIdParameter());
        }
        $formMapper
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Заголовок',
            ])
            ->add('subtitle', TextType::class, [
                'required' => false,
                'label' => 'Подзаголовок'
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Описание',
                'attr' => [
                    'class' => 'ckeditor'
                ]
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ])
            ->add('children', EntityType::class, [
                'class' => BasePage::class,
                'multiple' => true,
                'choice_label' => 'title',
                'by_reference' => false,
                'query_builder' => function (EntityRepository $er) use ($currentId) {
                    $result = $er->createQueryBuilder('p')
                        ->where('p.parent is null')
                        ->andWhere('p INSTANCE OF AppBundle:Page\Project');
                    if (!empty($currentId)) {
                        $result
                            ->andWhere('p.id != :currentId')
                            ->orWhere('p.parent = :currentId')
                            ->setParameter('currentId', $currentId);
                    }
                    return $result;
                },
            ]);
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
