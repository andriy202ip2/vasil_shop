<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class MobileType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('mobile', CKEditorType::class, array(
            'config' => array(
                'width' => '100%',
                'height' => '800px',
                'enterMode' => 'CKEDITOR.ENTER_BR'
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
            'data_class' => 'AdminBundle\Entity\Mobile'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'adminbundle_mobile';
    }

}
