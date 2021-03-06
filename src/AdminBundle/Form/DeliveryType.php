<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class DeliveryType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('delivery', CKEditorType::class, array(
            'config' => array(
                'width' => '100%',
                'height' => '800px',
            ),
            'attr' => array(
                'class' => 'admin-textrea'
            ),
            'label' => 'Дані: ',
            'label_attr' => array('class' => 'admin-text-lebel')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Delivery'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'adminbundle_delivery';
    }

}
