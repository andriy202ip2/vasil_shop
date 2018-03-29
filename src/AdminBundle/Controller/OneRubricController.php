<?php

namespace AdminBundle\Controller;

use Shop\MenuBundle\Entity\OneRubric;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * OneRubric controller.
 *
 */
class OneRubricController extends Controller {

    /**
     * Lists all OneRubric entities.
     *
     */
    public function indexAction(Request $request) {
                
        $em = $this->getDoctrine()->getManager();
        //$OneRubrics = $em->getRepository('ShopMenuBundle:OneRubric')->findAll();

        $dql = $em->getRepository('ShopMenuBundle:OneRubric')->createQueryBuilder('a');
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $OneRubrics = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AdminBundle:OneRubric:index.html.twig', array(
                    'OneRubrics' => $OneRubrics,
        ));
    }

    /**
     * Creates a new OneRubric entity.
     *
     */
    public function newAction(Request $request) {
        $OneRubric = new OneRubric();
        $form = $this->createForm('AdminBundle\Form\OneRubricType', $OneRubric);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($OneRubric);
            $em->flush();

            return $this->redirectToRoute('onerubric_show', array('id' => $OneRubric->getId()));
        }

        return $this->render('AdminBundle:OneRubric:new.html.twig', array(
                    'OneRubric' => $OneRubric,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OneRubric entity.
     *
     */
    public function showAction(OneRubric $OneRubric) {
        $deleteForm = $this->createDeleteForm($OneRubric);

        return $this->render('AdminBundle:OneRubric:show.html.twig', array(
                    'OneRubric' => $OneRubric,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OneRubric entity.
     *
     */
    public function editAction(Request $request, OneRubric $OneRubric) {
        $deleteForm = $this->createDeleteForm($OneRubric);
        $editForm = $this->createForm('AdminBundle\Form\OneRubricType', $OneRubric);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('onerubric_edit', array('id' => $OneRubric->getId()));
        }

        return $this->render('AdminBundle:OneRubric:edit.html.twig', array(
                    'OneRubric' => $OneRubric,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a OneRubric entity.
     *
     */
    public function deleteAction(Request $request, OneRubric $OneRubric) {

        $em = $this->getDoctrine()->getManager();

        $TwoRubrics = $OneRubric->getTwoRubrics();
        foreach ($TwoRubrics as $TwoRubric) {

            $ThreeRubrics = $TwoRubric->getThreeRubrics();            
            foreach ($ThreeRubrics as $ThreeRubric) {

                $Products = $ThreeRubric->getProducts();                
                foreach ($Products as $Product) {

                    $Product->removeImg($Product->getImg(), $this->getParameter('img_directory'));
                    $em->remove($Product);
                }

                $em->remove($ThreeRubric);
            }
            
            $em->remove($TwoRubric);
        }

        $em->remove($OneRubric);
        $em->flush();

        /*
          $form = $this->createDeleteForm($OneRubric);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->remove($OneRubric);
          $em->flush();
          }
         */

        return $this->redirectToRoute('onerubric_index');
    }

    /**
     * Creates a form to delete a OneRubric entity.
     *
     * @param OneRubric $OneRubric The OneRubric entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OneRubric $OneRubric) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('onerubric_delete', array('id' => $OneRubric->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
