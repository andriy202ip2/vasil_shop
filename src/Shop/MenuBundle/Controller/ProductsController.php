<?php

namespace Shop\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends Controller {

    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                ->findAllOrderedByName();

        return $this->render('ShopMenuBundle:Products:index.html.twig', array(
                    'modelMenus' => $modelMenus,
        ));
    }

    public function autosAction(Request $request, $model_id) {

        $em = $this->getDoctrine()->getManager();
        $autoMenu = $em->getRepository('ShopMenuBundle:AutoMenu')
                ->findByIdOrderedByName($model_id);

        return $this->render('ShopMenuBundle:Products:auto.html.twig', array(
                    'autoMenu' => $autoMenu,
        ));
    }

    public function dataAction($model_id, $auto_id) {

        $em = $this->getDoctrine()->getManager();
        $dataMenu = $em->getRepository('ShopMenuBundle:DataMenu')
                ->findByIdOrderedByName($model_id, $auto_id);

        return $this->render('ShopMenuBundle:Products:data.html.twig', array(
                    'dataMenu' => $dataMenu,
        ));
    }

    public function itemsAction($model_id, $auto_id, $data_id) {
        
        $em = $this->getDoctrine()->getManager();
        $ItemsArray = $em->getRepository('ShopMenuBundle:Items')
                ->findByIdOrderedById($model_id, $auto_id, $data_id, 0);

        return $this->render('ShopMenuBundle:Products:items.html.twig', array(
                    'ItemsArray' => $ItemsArray,
        ));
    }

}
