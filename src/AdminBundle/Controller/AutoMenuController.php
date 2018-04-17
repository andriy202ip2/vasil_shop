<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\AutoMenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Automenu controller.
 *
 */
class AutoMenuController extends Controller {

    /**
     * Lists all autoMenu entities.
     *
     */
    public function indexAction(Request $request) {

        $model_id = $request->query->getInt('mid', 0);
        if ($model_id < 0) {
            $model_id = 0;
        }

        $em = $this->getDoctrine()->getManager();
        $modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')
                ->findAllOrderedByName();

        $em = $this->getDoctrine()->getManager();
        //$autoMenus = $em->getRepository('ShopMenuBundle:AutoMenu')->findAll();

        $dql = $em->getRepository('ShopMenuBundle:AutoMenu')->createQueryBuilder('a');
        if ($model_id > 0) {
            $dql = $dql->where('a.modelMenuId = :mid')->setParameter('mid', $model_id);
        }

        $serch = $request->query->get("serch", "");
        $serch = strip_tags($serch);
        $serch = strtr($serch, array('<' => " ", '>' => " "));
        $IsSerch = strlen($serch) > 1;
        if ($IsSerch) {

            $dql = $dql->andWhere('a.name LIKE :serch')
                ->setParameter('serch', '%' . $serch . '%');
        }

        $query = $dql->getQuery();


        $paginator = $this->get('knp_paginator');
        $autoMenus = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );


        return $this->render('AdminBundle:Automenu:index.html.twig', array(
                    'autoMenus' => $autoMenus,
                    'modelMenus' => $modelMenus,
                    'model_id' => $model_id,
                    'serch' => $serch,
        ));
    }

    /**
     * Creates a new autoMenu entity.
     *
     */
    public function newAction(Request $request) {

        $autoMenu = new Automenu();
        $form = $this->createForm('AdminBundle\Form\AutoMenuType', $autoMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$autoMenu->getModelMenuId()
            //echo var_dump($autoMenu);
            //exit();
            $em = $this->getDoctrine()->getManager();
            $em->persist($autoMenu);
            $em->flush();

            return $this->redirectToRoute('automenu_show', array('id' => $autoMenu->getId()));
        }

        return $this->render('AdminBundle:Automenu:new.html.twig', array(
                    'autoMenu' => $autoMenu,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a autoMenu entity.
     *
     */
    public function showAction(AutoMenu $autoMenu) {
        //$deleteForm = $this->createDeleteForm($autoMenu);

        return $this->render('AdminBundle:Automenu:show.html.twig', array(
                    'autoMenu' => $autoMenu,
                    //'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing autoMenu entity.
     *
     */
    public function editAction(Request $request, AutoMenu $autoMenu) {
        //$deleteForm = $this->createDeleteForm($autoMenu);
        $editForm = $this->createForm('AdminBundle\Form\AutoMenuType', $autoMenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('automenu_edit', array('id' => $autoMenu->getId()));
        }

        return $this->render('AdminBundle:Automenu:edit.html.twig', array(
                    'autoMenu' => $autoMenu,
                    'edit_form' => $editForm->createView(),
                    //'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a autoMenu entity.
     *
     */
    public function deleteAction(Request $request, AutoMenu $autoMenu) {
        //$form = $this->createDeleteForm($autoMenu);
        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $Datas = $autoMenu->getDatas();            
            foreach ($Datas as $data) {

                $Items = $data->getItems();                
                foreach ($Items as $item) {
                                        
                    $item->removeImg($item->getImg(), $this->getParameter('img_directory'));
                    $em->remove($item);
                }

                $em->remove($data);
            }

            $em->remove($autoMenu);
            $em->flush();
        //}
        //$request->isMethod('GET')
        return $this->redirectToRoute('automenu_index');
        //return new Response("test");
    }

    /**
     * Creates a form to delete a autoMenu entity.
     *
     * @param AutoMenu $autoMenu The autoMenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    /*
    private function createDeleteForm(AutoMenu $autoMenu) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('automenu_delete', array('id' => $autoMenu->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }*/


}
