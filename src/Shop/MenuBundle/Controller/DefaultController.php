<?php

namespace Shop\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shop\MenuBundle\Entity\ModelMenu;
use Symfony\Component\HttpFoundation\Response;
use AdminBundle\Entity\Oderemale;
use AdminBundle\Entity\Sendemale;

//use Shop\MenuBundle\Repository;
//use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller {

    public function indexAction(Request $request) {

        //echo rand(1, 100000);        
        $model_id = $request->query->getInt('mid', 0);
        if ($model_id < 0) {
            $model_id = 0;
        }

        $auto_id = $request->query->getInt('aid', 0);
        if ($auto_id < 0) {
            $auto_id = 0;
        }

        $data_id = $request->query->getInt('did', 0);
        if ($data_id < 0) {
            $data_id = 0;
        }

        $s1 = $request->query->getInt('s1', 0);
        $s1 = $s1 >= 1 ? 1 : 0;

        $s2 = $request->query->getInt('s2', 0);
        $s2 = $s2 >= 1 ? 2 : 0;

        $side = ($s1 + $s2) % 3;
        if (!$side) {
            $s1 = 1;
            $s2 = 2;
        }

        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                ->findAllOrderedByName();

        $autoMenu = null;
        if ($model_id) {
            $em = $this->getDoctrine()->getManager();
            $autoMenu = $em->getRepository('ShopMenuBundle:AutoMenu')
                    ->findByIdOrderedByName($model_id);
        }

        $dataMenu = null;
        if ($auto_id) {
            $em = $this->getDoctrine()->getManager();
            $dataMenu = $em->getRepository('ShopMenuBundle:DataMenu')
                    ->findByIdOrderedByName($model_id, $auto_id);
        }

        $ItemsArray = null;

        $serch = $request->query->get("serch", "");
        $IsSerch = strlen($serch) > 1;
        if ($IsSerch) {
            $em = $this->getDoctrine()->getManager();
            $ItemsArray = $em->getRepository('ShopMenuBundle:Items')
                    ->findBySerchCodeOrderedById($serch);
        }


        if (!$IsSerch && $model_id && $auto_id && $data_id) {

            $em = $this->getDoctrine()->getManager();
            $ItemsArray = $em->getRepository('ShopMenuBundle:Items')
                    ->findByIdOrderedById($model_id, $auto_id, $data_id, $side);
        }

        return $this->render('ShopMenuBundle:Default:index.html.twig', array(
                    'IsSerch' => $IsSerch,
                    'modelMenus' => $modelMenus,
                    'model_id' => $model_id,
                    'autoMenu' => $autoMenu,
                    'auto_id' => $auto_id,
                    'dataMenu' => $dataMenu,
                    'data_id' => $data_id,
                    's1' => $s1,
                    's2' => $s2,
                    'ItemsArray' => $ItemsArray,
        ));
    }

    public function aboutAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $abouts = $em->getRepository('AdminBundle:About')->findOneBy([]);

        return $this->render('ShopMenuBundle:Default:about.html.twig', array(
                    'abouts' => $abouts,
        ));
    }

    public function сontactAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('AdminBundle:Contact')->findOneBy([]);

        return $this->render('ShopMenuBundle:Default:contact.html.twig', array(
                    'contacts' => $contacts,
        ));
    }

    public function mobileAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $mobiles = $em->getRepository('AdminBundle:Mobile')->findOneBy([]);

        return new Response(
                $mobiles->getMobile()
        );
    }

    //147
    /*
    public function shop_toperAction(Request $request) {
        
        return $this->render('ShopMenuBundle:Default:shop_toper.html.twig');
        
    }
    {{ render(url('shop_toper')) }}
     */
    
    
    public function deliveryAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $delivery = $em->getRepository('AdminBundle:Delivery')->findOneBy([]);

        return $this->render('ShopMenuBundle:Default:delivery.html.twig', array(
                    'delivery' => $delivery,
        ));
    }

    public function paymentAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $payment = $em->getRepository('AdminBundle:Payment')->findOneBy([]);

        return $this->render('ShopMenuBundle:Default:payment.html.twig', array(
                    'payment' => $payment,
        ));
    }

    public function sendemaleAction(Request $request) {

        $call_name = strip_tags($request->query->get('call_name', ""), '<p><br>');
        $call_mob = strip_tags($request->query->get('call_mob', ""), '<p><br>');
        $call_time_b = strip_tags($request->query->get('call_time_b', ""), '<p><br>');
        $call_time_e = strip_tags($request->query->get('call_time_e', ""), '<p><br>');

        //echo '<br/>'.$call_name.'<br/>'.$call_mob.'<br/>'.$call_time_b.'<br/>'.$call_time_e.'<br/>';

        if (mb_strlen($call_mob) >= 10) {

            $em = $this->getDoctrine()->getManager();
            $emales = $em->getRepository('AdminBundle:Emale')->findOneBy([]);

            $view = $this->renderView('ShopMenuBundle:Default:email.txt.twig', array(
                'call_name' => $call_name,
                'call_mob' => $call_mob,
                'call_time_b' => $call_time_b,
                'call_time_e' => $call_time_e
            ));
            
            $sendemale = new Sendemale();
            $sendemale->setSendemale($view);
            $sendemale->setData(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($sendemale);
            $em->flush();
            
            //meler
            $message = \Swift_Message::newInstance()
                    ->setSubject('Перезвоніть мені !')
                    ->setFrom('send@example.com')
                    ->setTo($emales->getEmale())
                    ->setBody(strip_tags($view));

            $this->get('mailer')->send($message);
        }

        return new Response(
                json_encode(array('Result' => mb_strlen($call_mob) >= 10))
        );

        /*
          return $this->render('ShopMenuBundle:Default:email.txt.twig', array(
          'call_name' => $call_name,
          'call_mob' => $call_mob,
          'call_time_b' => $call_time_b,
          'call_time_e' => $call_time_e
          )); */
    }

    public function oderemaleAction(Request $request) {

        $call_name = strip_tags($request->query->get('call_name', ""), '<p><br>');
        $call_mob = strip_tags($request->query->get('call_mob', ""), '<p><br>');
        $oder_code = strip_tags($request->query->get('oder_code', ""), '<p><br>');
        $oder_price = strip_tags($request->query->get('oder_price', ""), '<p><br>');

        if (mb_strlen($call_mob) >= 10) {

            $em = $this->getDoctrine()->getManager();
            $emales = $em->getRepository('AdminBundle:Emale')->findOneBy([]);
            //echo $emales->getEmale();

            $view = $this->renderView('ShopMenuBundle:Default:oderemale.txt.twig', array(
                'call_name' => $call_name,
                'call_mob' => $call_mob,
                'oder_code' => $oder_code,
                'oder_price' => $oder_price
            ));

            $oderemale = new Oderemale();
            $oderemale->setOderemale($view);
            $oderemale->setData(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($oderemale);
            $em->flush();

            //meler
            $message = \Swift_Message::newInstance()
                    ->setSubject('Прийшов Заказ !')
                    ->setFrom('send@example.com')
                    ->setTo($emales->getEmale())
                    ->setBody(strip_tags($view));

            $this->get('mailer')->send($message);
        }

        return new Response(
                json_encode(array('Result' => mb_strlen($call_mob) >= 10))
        );

        /*
          return $this->render('ShopMenuBundle:Default:oderemale.txt.twig', array(
          'call_name' => $call_name,
          'call_mob' => $call_mob,
          'oder_code' => $oder_code,
          'oder_price' => $oder_price
          )); */
    }

}
