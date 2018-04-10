<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AutoMenuType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name',TextType::class,array(
                'attr'=>array(
                    'class'=> 'admin-input'
                ),
                'label' => 'Імя: '
            ))
            ->add('model', EntityType::class, array(
            'class' => 'ShopMenuBundle:ModelMenu',            
            'choice_label' => 'name',
                
            'attr'=>array(
                    'class'=> 'admin-selekt cat'
                ),    
            'label' => 'Рубрика 1: '
        ));
        //->add('modelMenuId')
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\MenuBundle\Entity\AutoMenu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'shop_menubundle_automenu';
    }

}
