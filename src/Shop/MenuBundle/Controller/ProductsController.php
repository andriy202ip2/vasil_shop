<?php

namespace Shop\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Money\Money;
use Money\Currency;

class ProductsController extends Controller
{

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
            ->findAllOrderedByName();

        $Items = $em->getRepository('ShopMenuBundle:Items')
            ->findTheLatestOnes(30);

        return $this->render('ShopMenuBundle:Products:index.html.twig', array(
            'modelMenus' => $modelMenus,
            'Items' => $Items,
        ));
    }

    public function autosAction(Request $request, $model_id)
    {

        $em = $this->getDoctrine()->getManager();
        $autoMenu = $em->getRepository('ShopMenuBundle:AutoMenu')
            ->findByIdOrderedByName($model_id);

        return $this->render('ShopMenuBundle:Products:auto.html.twig', array(
            'autoMenu' => $autoMenu,
        ));
    }

    public function dataAction($model_id, $auto_id)
    {

        $em = $this->getDoctrine()->getManager();
        $dataMenu = $em->getRepository('ShopMenuBundle:DataMenu')
            ->findByIdOrderedByName($model_id, $auto_id);

        return $this->render('ShopMenuBundle:Products:data.html.twig', array(
            'dataMenu' => $dataMenu,
        ));
    }

    public function itemsAction($model_id, $auto_id, $data_id)
    {

        $em = $this->getDoctrine()->getManager();
        $ItemsArray = $em->getRepository('ShopMenuBundle:Items')
            ->findByIdOrderedById($model_id, $auto_id, $data_id, 0);

        return $this->render('ShopMenuBundle:Products:items.html.twig', array(
            'ItemsArray' => $ItemsArray,
        ));
    }

    public function itemAction($product_id)
    {

        $em = $this->getDoctrine()->getManager();
        //$Item = $em->getRepository('ShopMenuBundle:Items')
        //->getOneItemById($product_id);

        $Item = $em->getRepository('ShopMenuBundle:Items')->findOneBy(["id" => $product_id]);

        $id = $Item->getId();

        $KodProdakt = "777";
        for ($i = 1; $i <= 10 - strlen($id); $i++) {
            $KodProdakt .= $i == 3 ? "3" : "0";
        }
        $KodProdakt .= $id;

        return $this->render('ShopMenuBundle:Products:item.html.twig', array(
            'Item' => $Item,
            'KodProdakt' => $KodProdakt,
        ));
    }

    public function allAction(Request $request)
    {

        $page = $request->query->getInt('page', 1);
        $isGal = $request->query->getInt('isgal', 0);
        $currency = $request->query->getInt('currency', 0);
        $sorts = $request->query->getInt('sorts', 0);

        $em = $this->getDoctrine()->getManager();
        //$Item = $em->getRepository('ShopMenuBundle:Items')
        //->getOneItemById($product_id);

        $pairManager = $this->get('tbbc_money.pair_manager');
        $USD = $pairManager->convert(Money::USD(100), 'UAH')->getAmount() / 100;
        $EUR = $pairManager->convert(Money::EUR(100), 'UAH')->getAmount() / 100;
        $PLN = $pairManager->convert(Money::PLN(100), 'UAH')->getAmount() / 100;

        //echo $USD.'<br>';
        //echo $EUR;

        $dql = $em->getRepository('ShopMenuBundle:Items')
            ->createQueryBuilder('a');

        $case_str = "case when a.priceCurrency = 'USD' then :USD else 
                     case when a.priceCurrency = 'EUR' then :EUR else 
                     case when a.priceCurrency = 'PLN' then :PLN else 1 end end end";

        if ($sorts == 0) {

            $dql = $dql->orderBy('a.id', 'DESC');

            //chipest
        } elseif ($sorts == 1) {

            $dql = $dql->where('a.priceAmount > 0');
            $dql = $dql->orderBy('a.priceAmount * '.$case_str , 'ASC');

            $dql = $dql->setParameter(':USD', $USD)
                        ->setParameter(':EUR', $EUR)
                        ->setParameter(':PLN', $PLN);

            //expensive
        } else {

            $dql = $dql->where('a.priceAmount > 0');
            $dql = $dql->orderBy('a.priceAmount * '.$case_str , 'DESC');

            $dql = $dql->setParameter(':USD', $USD)
                ->setParameter(':EUR', $EUR)
                ->setParameter(':PLN', $PLN);
        }

        $query = $dql->getQuery();

        $paginator = $this->get('knp_paginator');

        $MaxPagas = 30;
        $Items = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */, $MaxPagas/* limit per page */
        );


        //var_dump($request->query->all());

        return $this->render('ShopMenuBundle:Products:all.html.twig', array(
            'Items' => $Items,
            'MaxPagas' => $MaxPagas,
            'page' => $page,
            'isGal' => $isGal,
            'currency' => $currency,
            'sorts' => $sorts,
        ));
    }

}
