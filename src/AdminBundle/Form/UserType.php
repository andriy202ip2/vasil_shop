<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array(
                    'attr' => array(
                        'class' => 'admin-input'
                    ),
                    'label' => 'username: '
                ))
                ->add('password', PasswordType::class, array(
                    'attr' => array(
                        'class' => 'admin-input color_text'
                    ),
                    'label' => 'Пароль: '
                ))
                ->add('email', EmailType::class, array(
                    'attr' => array(
                        'class' => 'admin-input color_text'
                    ),
                    'label' => 'email: '
                ))
                ->add('name', TextType::class, array(
                    'attr' => array(
                        'class' => 'admin-input'
                    ),
                    'label' => 'Імя: '
                ))
                ->add('surname', TextType::class, array(
                    'attr' => array(
                        'class' => 'admin-input'
                    ),
                    'label' => 'Фамілія: '
                ))
                ->add('isActive', CheckboxType::class, array(
                    'attr' => array(
                        'class' => 'admin-chekbox'
                    ),
                    'required' => false,
                    'label' => 'Чи активований: '
                ))
                ->add('salt', TextType::class, array(
                    'attr' => array(
                        'class' => 'admin-input'
                    ),
                    'required' => false,
                    'label' => 'Сіль Паролю: '
                ))
                ->add('role', ChoiceType::class, array(
                    'attr' => array(
                        'class' => 'admin-selekt cat'
                    ),
                    'label' => 'Роль: ',
                            'choices'  => array(
                                'ROLE_USER' => 'ROLE_USER', 
                                'ROLE_TEAM' => 'ROLE_TEAM', 
                                'ROLE_OPERATOR' => 'ROLE_OPERATOR', 
                                'ROLE_ADMIN' => 'ROLE_ADMIN', 
                                'ROLE_ROOT' => 'ROLE_ROOT', ),
                                'empty_data' => 'ROLE_USER'
                            ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Security\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'security_userbundle_user';
    }


}
