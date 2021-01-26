<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class DocumentAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title')
            ->add('description')
            ->add('updatedAt');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('title')
            ->add('description')
            ->add('updatedAt')
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
                'label' => 'Название документа'
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Документ'
            ])

            ->add('type', 'choice',array(
                'choices' =>
                    array(
                        'Pdf'=>'pdf',
                        'Архив'=>'zip',
                        'Изображение(png,jpeg,img,jpg...)'=>'jpg',
                        'Документ(docx,text,doc,dotx,dot,dotx...)'=>'document',
                        'Еxcel таблицы'=>'xls',
                        'Другое'=>'test'
                    ),
                'label'=>'Файл формат',
                'required'=>true,
                'expanded'=>true,
                'multiple'=>false,
                'placeholder'=>false
            ))
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Описание',
                'attr' => [
                    'class' => 'ckeditor'
                ]
            ]);

    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('image')
            ->add('title')
            ->add('description')
            ->add('updatedAt');
    }
}
