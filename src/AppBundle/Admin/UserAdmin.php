<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


final class UserAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username', null, [
                'label' => 'Логин'
            ])
            ->add('email', null, [
                'label' => 'почта'
            ])
            ->add('active', null, [
                'label' => 'Активирован'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username', null, [
                'label' => 'Логин'
            ])
            ->add('email', null, [
                'label' => 'Электронная почта'
            ])
            ->add('rolesAsString', null, [
                'label' => 'Роли'
            ])
            ->add('active', 'choice', [
                'editable' => true,
                'class' => User::class,
                'choices' => [
                    1 => 'Да',
                    0 => 'Нет',
                ],
                'label' => 'Активирован'
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

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', TextType::class, [
                'required' => false,
                'label' => 'Логин'
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'label' => 'Электронная почта'
            ])
            ->add('plainPassword', PasswordType::class, [
                'required' => false,
                'label' => 'Пароль'
            ])
            ->add('active', 'choice', [
                'choices' => [
                    'Да' => 1,
                    'Нет' => 0,
                ],
                'label' => 'Активирован'
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Роль',
                'multiple' => true,
                'choices' => [
                    "Админ" => 'ROLE_ADMIN',
                    "Пользователь" => 'ROLE_USER'
                ]
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('username', null, [
                'label' => 'Логин'
            ])
            ->add('email', null, [
                'label' => 'Электронная почта'
            ])
            ->add('rolesAsString', null, [
                'label' => 'Роли'
            ])
            ->add('active', null, [
                'label' => 'Активирован'
            ]);
    }

    public function getFormBuilder()
    {
        if (is_null($this->getSubject()->getId())) {
            $this->formOptions = array('validation_groups' => array('createUser'));
        } else {
            $this->formOptions = array('validation_groups' => array('editUser'));
        }
        $formBuilder = parent::getFormBuilder();
        return $formBuilder;
    }

    public function preUpdate($user)
    {
        if (!empty($plainPassword = $user->getPlainPassword())) {
            $container = $this->getConfigurationPool()->getContainer();
            $encoder = $container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $plainPassword);

            $user->setPassword($encoded);
        }
    }
}
