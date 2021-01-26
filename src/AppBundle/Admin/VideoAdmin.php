<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use DOMDocument;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class VideoAdmin extends AbstractAdmin
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
                'label' => 'Описание'
            ])
            ->add('url', TextType::class, [
                'required' => false,
                'label' => 'URL'
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label' => 'Изображение'
            ]);;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('image');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        if (!empty($object->getUrl()) && $this->isHTML($object->getUrl())) {
            $doc = new DOMDocument();
            $doc->loadHTML($object->getUrl());
            $iframe = $doc->getElementsByTagName('iframe');
            if (!$iframe) {
                return;
            }
            foreach ($iframe as $item) {
                if (empty($item->getAttribute('src'))) {
                    return;
                }
                return $object->setUrl($item->getAttribute('src'));
            }
        }
        $errorElement->end();
    }

    public function isHTML($string)
    {
        if ($string != strip_tags($string)) {
            return true;
        }
        return false;
    }
}
