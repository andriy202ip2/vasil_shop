<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shop\MenuBundle\Entity\Items;
use Tbbc\MoneyBundle\Form\Type\MoneyType;
use Money\Money;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function add_pricesAction(Request $request) {

        $noteFonde = "";
        $isSave = 0;
        
        $editForm = $this->createForm('AdminBundle\Form\AddPricesType');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $isSave = 1;
            
            $em = $this->getDoctrine()->getManager();
            
            $data = $editForm->getData();
            $arr = explode("}", $data["list"]);
            foreach ($arr as $val) {
                $arr2 = explode("{", $val);

                if (count($arr2) == 2) {

                    $id = preg_replace('/\s+/', '', $arr2[0]);
                    $prise = preg_replace('/\s+/', '', $arr2[1]);
                    $prise = str_replace(array(","), array("."), $prise);
                    $prise = $prise * ($data['curling'] / 100 + 1);
                    $prise = round($prise, 2) * 100;     
                    
                    //echo $id . '<br>';
                    //echo $prise . '<br>';
                    
                    $dql = $em->getRepository('ShopMenuBundle:Items')->createQueryBuilder('a');;
                    $dql = $dql->where('a.itemId = :id')
                                ->setParameter('id', $id)
                                ->getQuery();
                    
                    $items = $dql->getResult();
                    $i = 0;
                    foreach ($items as $item) {
                        $i++;
                        
                        $money = Money::PLN($prise);
                        $item->setPrice($money);
                                                        
                        //exit();
                    }
                    if ($i == 0) {
                        $noteFonde .= " , ".$id;                        
                    }

                }
            }

            $this->getDoctrine()->getManager()->flush();
            //
            //return $this->redirectToRoute('admin_add_prices');
        }

        return $this->render('AdminBundle:Default:addprices.html.twig', array(
                    'edit_form' => $editForm->createView(),
                    "noteFonde" => $noteFonde,
                    "isSave" => $isSave
        ));
    }

}
