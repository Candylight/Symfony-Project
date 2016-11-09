<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Form\Type;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array(
                'label' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => array(
                    'placeholder' => 'form.email'
                )
            ))
            ->add('username', null,
                array(
                    'label' => false,
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'placeholder' => 'form.username'
                    )
                ))
            ->add('name', null,
                array(
                    'label' => false,
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'placeholder' => 'form.name'
                    )
                ))
            ->add('firstname', null,
                array(
                    'label' => false,
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'placeholder' => 'form.firstname'
                    )
                ))
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'form.password'
                    )
                ),
                'second_options' => array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'form.password_confirmation'
                    )
                ),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
