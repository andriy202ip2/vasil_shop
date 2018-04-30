<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Tbbc\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use AdminBundle\Form\FilesType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ItemsType extends AbstractType
{

    private $em;
    private $no_submit;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->em = $options['em'];
        $this->no_submit = $options['no_submit'];

        $builder->add('name', TextType::class, array(
            'attr' => array(
                'class' => 'admin-input delete-info'
            ),
            'label' => 'Імя: '))
            ->add('model', EntityType::class, array(
                'class' => 'ShopMenuBundle:ModelMenu',
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat mid'
                ),
                'label' => 'Модель: '
            ))
            ->add('auto', EntityType::class, array(
                'class' => 'ShopMenuBundle:AutoMenu',
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat aid'
                ),
                'label' => 'Авто: '
            ))
            ->add('data', EntityType::class, array(
                'class' => 'ShopMenuBundle:DataMenu',
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Рока: '
            ))
            ->add('price', MoneyType::class, [
                'attr' => array(
                    'class' => 'admin-input'
                ), 'label' => 'Ціна: '])
//            ->add('files', CollectionType::class,array(
//                'entry_type' => FilesType::class,
//                'allow_add' => true,
//                'by_reference' => false,
//            ))
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => "Видалити малюнок",
                'download_uri' => false,
                'image_uri' => true,

            ])
            //'imagine_pattern' => 'items_photo_admin',
            ->add('details', CKEditorType::class, array(
                'config' => array(
                    'width' => '885px',
                    'height' => '700px'
                ),
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Деталі: ',
                'label_attr' => array('class' => 'admin-text-lebel')
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
            }

            $autos = $this->em->getRepository('ShopMenuBundle:AutoMenu')->findBy(["modelMenuId" => $model_id]);

            if ($data->getAuto() == NULL) {
                $autos_id = $autos[0]->getId();
            } else {
                $autos_id = $data->getAuto()->getId();

                $is_contein = false;
                foreach ($autos as $auto) {
                    if ($auto->getId() == $autos_id) {
                        $is_contein = true;
                        break;
                    }
                }
                if (!$is_contein) {
                    $autos_id = $autos[0]->getId();
                }
                //var_dump($data->getAuto()->getName());
            }

            $datas = $this->em->getRepository('ShopMenuBundle:DataMenu')->findBy(["autoMenuId" => $autos_id]);


            //var_dump($data);

            $form->add('auto', EntityType::class, array(
                'class' => 'ShopMenuBundle:AutoMenu',
                'choices' => $autos,
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat aid'
                ),
                'label' => 'Авто: '
            ))->add('data', EntityType::class, array(
                'class' => 'ShopMenuBundle:DataMenu',
                'choices' => $datas,
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Рока: '
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

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\MenuBundle\Entity\Items'
        ));
        $resolver->setRequired('em')->setRequired('no_submit');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'shop_menubundle_items';
    }

}
