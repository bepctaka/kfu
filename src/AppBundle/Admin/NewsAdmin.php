<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\Document;
use AppBundle\Entity\Gallery;
use AppBundle\Entity\Page\BasePage;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class NewsAdmin extends AbstractAdmin
{
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        if ($context === 'list') {
            $query->addOrderBy('o.id', 'DESC');
        }

        return $query;
    }

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
                'label' => 'Описание',
                'attr' => [
                    'class' => 'ckeditor'
                ]
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
            ->add('notView',CheckboxType::class,[
                'label' => 'Только для превью',
                'required' => false,
            ])
            ->add('foothall',CheckboxType::class,[
                'label' => 'Футзал',
                'required' => false,
            ])
            ->add('gallery', ModelType::class, [
                'label' => 'Галлерея',
                'multiple' => true,
                'by_reference' => false,
                'class' => Gallery::class,
                'property' => 'title',
            ])
            ->add('document', EntityType::class, [
                'class' => Document::class,
                'multiple' => true,
                'choice_label' => 'title',
                'by_reference' => false,
//                'query_builder' => function (EntityRepository $er) use ($currentId) {
//                    $result = $er->createQueryBuilder('p')
//                        ->where('p NOT INSTANCE OF AppBundle\Entity\Page\Menu')
//                        ->andWhere('p.parent is null')
//                    ;
//                    if (!empty($currentId)) {
//                        $result->orWhere('p.parent = :currentId')
//                            ->setParameter('currentId', $currentId);
//                    }
//                    return $result;
//                },
            ])
            ->add('children', EntityType::class, [
                'class' => BasePage::class,
                'multiple' => true,
                'choice_label' => 'title',
                'by_reference' => false,
                'query_builder' => function (EntityRepository $er) use ($currentId) {
                    $result = $er->createQueryBuilder('p')
                        ->where('p INSTANCE OF AppBundle:Page\News');
                    if (!empty($currentId)) {
                        $result
                            ->andWhere('p.id != :currentId')
                            ->setParameter('currentId', $currentId);
                    }
                    return $result;
                },
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
