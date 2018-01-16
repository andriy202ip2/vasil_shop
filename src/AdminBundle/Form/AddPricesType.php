<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Tbbc\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AddPricesType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('curling', NumberType::class, array(
                    'attr' => array(
                        'class' => 'admin-input-smoll'
                    ),
                    'label' => 'Накрутка в процентах: '                    
                ))
                ->add('list', TextareaType::class, array(                    
                    'attr' => array(
                        'class' => 'admin-textrea'
                    ),
                    'label' => 'Дані: ',
                    'label_attr' => array('class' => 'admin-text-lebel')
                ));
        /*                ->add('price', MoneyType::class, array(
                    'attr' => array(
                        'class' => 'admin-input'
                    ),
                    'label' => 'Ціна: '))*/
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            //'data_class' => 'AdminBundle\Entity\About'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'add_prices';
    }

}
