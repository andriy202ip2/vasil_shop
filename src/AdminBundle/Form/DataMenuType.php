<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DataMenuType extends AbstractType {

    private $em;
    private $no_submit;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $this->em = $options['em'];
        $this->no_submit = $options['no_submit'];

        $builder->add('model', EntityType::class, array(
                    'class' => 'ShopMenuBundle:ModelMenu',
                    'choice_label' => 'name',
                    'attr' => array(
                        'class' => 'admin-selekt cat mid'
                    ),
                    'label' => 'Рубрика 1: '
                ))
                ->add('auto', EntityType::class, array(
                    'class' => 'ShopMenuBundle:AutoMenu',
                    'choice_label' => 'name',
                    'attr' => array(
                        'class' => 'admin-selekt cat'
                    ),
                    'label' => 'Рубрика 2: '
                ))
                ->add('name', TextType::class, array(
                    'attr' => array(
                        'class' => 'admin-input'
                    ),
                    'label' => 'Назва Рубрики 3: '
        ));

        $formModifier = function (FormEvent $event) {

            $form = $event->getForm();
            $data = $event->getData();

            $autos = array();
            if ($data->getModel() == NULL) {
                $model_id = $this->em->getRepository('ShopMenuBundle:ModelMenu')->findOneBy([])->getId();
            } else {
                $model_id = $data->getModel()->getId();

                //var_dump($data->getModel()->getName());
                //var_dump($data->getAuto()->getName());
            }

            $autos = $this->em->getRepository('ShopMenuBundle:AutoMenu')->findBy(["modelMenuId" => $model_id]);

            //var_dump($data);

            $form->add('auto', EntityType::class, array(
                'class' => 'ShopMenuBundle:AutoMenu',
                'choices' => $autos,
                //'query_builder' => null,
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Рубрика 2: '
            ));
        };

        if (!$this->no_submit) {
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
                $formModifier($event);
            });
        }

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($formModifier) {
            $formModifier($event);
        });
    }

    //
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\MenuBundle\Entity\DataMenu'
        ));
        $resolver->setRequired('em')->setRequired('no_submit');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'shop_menubundle_datamenu';
    }

}
