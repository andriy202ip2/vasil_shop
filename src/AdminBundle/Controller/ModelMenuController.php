<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\ModelMenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Modelmenu controller.
 *
 */
class ModelMenuController extends Controller {

    /**
     * Lists all modelMenu entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //$modelMenus = $em->getRepository('ShopMenuBundle:ModelMenu')->findAll();

        $dql = $em->getRepository('ShopMenuBundle:ModelMenu')->createQueryBuilder('a');
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $modelMenus = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AdminBundle:ModelMenu:index.html.twig', array(
                    'modelMenus' => $modelMenus,
        ));
    }

    /**
     * Creates a new modelMenu entity.
     *
     */
    public function newAction(Request $request) {
        $modelMenu = new Modelmenu();
        $form = $this->createForm('AdminBundle\Form\ModelMenuType', $modelMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modelMenu);
            $em->flush();

            return $this->redirectToRoute('modelmenu_show', array('id' => $modelMenu->getId()));
        }

        return $this->render('AdminBundle:ModelMenu:new.html.twig', array(
                    'modelMenu' => $modelMenu,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a modelMenu entity.
     *
     */
    public function showAction(ModelMenu $modelMenu) {
        $deleteForm = $this->createDeleteForm($modelMenu);

        return $this->render('AdminBundle:ModelMenu:show.html.twig', array(
                    'modelMenu' => $modelMenu,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing modelMenu entity.
     *
     */
    public function editAction(Request $request, ModelMenu $modelMenu) {
        $deleteForm = $this->createDeleteForm($modelMenu);
        $editForm = $this->createForm('AdminBundle\Form\ModelMenuType', $modelMenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modelmenu_edit', array('id' => $modelMenu->getId()));
        }

        return $this->render('AdminBundle:ModelMenu:edit.html.twig', array(
                    'modelMenu' => $modelMenu,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a modelMenu entity.
     *
     */
    public function deleteAction(Request $request, ModelMenu $modelMenu) {

        $em = $this->getDoctrine()->getManager();

        $Autos = $modelMenu->getAutos();
        foreach ($Autos as $auto) {

            $Datas = $auto->getDatas();            
            foreach ($Datas as $data) {

                $Items = $data->getItems();                
                foreach ($Items as $item) {

                    $item->removeImg($item->getImg(), $this->getParameter('img_directory'));
                    $em->remove($item);
                }

                $em->remove($data);
            }
            
            $em->remove($auto);
        }

        $em->remove($modelMenu);
        $em->flush();

        /*
          $form = $this->createDeleteForm($modelMenu);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->remove($modelMenu);
          $em->flush();
          }
         */

        return $this->redirectToRoute('modelmenu_index');
    }

    /**
     * Creates a form to delete a modelMenu entity.
     *
     * @param ModelMenu $modelMenu The modelMenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ModelMenu $modelMenu) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('modelmenu_delete', array('id' => $modelMenu->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
