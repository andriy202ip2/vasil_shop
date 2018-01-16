<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\DataMenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Datamenu controller.
 *
 */
class DataMenuController extends Controller {

    /**
     * Lists all dataMenu entities.
     *
     */
    public function indexAction(Request $request) {
        $model_id = $request->query->getInt('mid', 0);
        if ($model_id < 0) {
            $model_id = 0;
        }

        $auto_id = $request->query->getInt('aid', 0);
        if ($auto_id < 0) {
            $auto_id = 0;
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

        $em = $this->getDoctrine()->getManager();
        //$dataMenus = $em->getRepository('ShopMenuBundle:DataMenu')->findAll();

        $dql = $em->getRepository('ShopMenuBundle:DataMenu')->createQueryBuilder('a');
        if ($model_id > 0) {
            $dql = $dql->where('a.modelMenuId = :mid')->setParameter('mid', $model_id);
            
            if ($auto_id > 0) {
                $dql = $dql->andWhere('a.autoMenuId = :aid')->setParameter('aid', $auto_id);
            }
        }

        $query = $dql->getQuery();

        $paginator = $this->get('knp_paginator');
        $dataMenus = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );


        return $this->render('AdminBundle:Datamenu:index.html.twig', array(
                    'dataMenus' => $dataMenus,
                    'modelMenus' => $modelMenus,
                    'model_id' => $model_id,
                    'autoMenu' => $autoMenu,
                    'auto_id' => $auto_id,
        ));
    }

    /**
     * Creates a new dataMenu entity.
     *
     */
    public function newAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $no_submit = $request->request->getInt('no_submit', 0);
        
        //echo $no_submit;
        
        $dataMenu = new Datamenu();                
        $form = $this->createForm('AdminBundle\Form\DataMenuType', $dataMenu, array('em' => $em, 'no_submit' => $no_submit));
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() && $no_submit >= 2) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($dataMenu);
            $em->flush();

            return $this->redirectToRoute('datamenu_show', array('id' => $dataMenu->getId()));
        }

        return $this->render('AdminBundle:Datamenu:new.html.twig', array(
                    'dataMenu' => $dataMenu,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dataMenu entity.
     *
     */
    public function showAction(DataMenu $dataMenu) {
        $deleteForm = $this->createDeleteForm($dataMenu);

        return $this->render('AdminBundle:Datamenu:show.html.twig', array(
                    'dataMenu' => $dataMenu,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dataMenu entity.
     *
     */
    public function editAction(Request $request, DataMenu $dataMenu) {
        
        $em = $this->getDoctrine()->getManager();
        $no_submit = $request->request->getInt('no_submit', 0);
        
        $deleteForm = $this->createDeleteForm($dataMenu);
        $editForm = $this->createForm('AdminBundle\Form\DataMenuType', $dataMenu, array('em' => $em, 'no_submit' => $no_submit));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid() && $no_submit >= 2) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('datamenu_edit', array('id' => $dataMenu->getId()));
        }

        return $this->render('AdminBundle:Datamenu:edit.html.twig', array(
                    'dataMenu' => $dataMenu,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dataMenu entity.
     *
     */
    public function deleteAction(Request $request, DataMenu $dataMenu) {
        $form = $this->createDeleteForm($dataMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $Items = $dataMenu->getItems();
            foreach ($Items as $item){                
                $item->removeImg($item->getImg(), $this->getParameter('img_directory'));                
                $em->remove($item);                
            }
            
            $em->remove($dataMenu);
            $em->flush();
        }

        return $this->redirectToRoute('datamenu_index');
    }

    /**
     * Creates a form to delete a dataMenu entity.
     *
     * @param DataMenu $dataMenu The dataMenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DataMenu $dataMenu) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('datamenu_delete', array('id' => $dataMenu->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
