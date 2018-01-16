<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Oderemale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Oderemale controller.
 *
 */
class OderemaleController extends Controller {

    /**
     * Lists all oderemale entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        //$oderemales = $em->getRepository('AdminBundle:Oderemale')->findAll();

        $dql = $em->getRepository('AdminBundle:Oderemale')
                ->createQueryBuilder('a')
                ->orderBy('a.id', 'DESC');

        $query = $dql->getQuery();

        $paginator = $this->get('knp_paginator');
        $oderemales = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AdminBundle:Oderemale:index.html.twig', array(
                    'oderemales' => $oderemales,
        ));
    }

    /**
     * Creates a new oderemale entity.
     *
     *//*
      public function newAction(Request $request) {
      $oderemale = new Oderemale();
      $form = $this->createForm('AdminBundle\Form\OderemaleType', $oderemale);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($oderemale);
      $em->flush();

      return $this->redirectToRoute('oderemale_show', array('id' => $oderemale->getId()));
      }

      return $this->render('AdminBundle:Oderemale:new.html.twig', array(
      'oderemale' => $oderemale,
      'form' => $form->createView(),
      ));
      } */

    /**
     * Finds and displays a oderemale entity.
     *
     */
    public function showAction(Oderemale $oderemale) {
        $deleteForm = $this->createDeleteForm($oderemale);

        return $this->render('AdminBundle:Oderemale:show.html.twig', array(
                    'oderemale' => $oderemale,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing oderemale entity.
     *
     *//*
      public function editAction(Request $request, Oderemale $oderemale) {
      $deleteForm = $this->createDeleteForm($oderemale);
      $editForm = $this->createForm('AdminBundle\Form\OderemaleType', $oderemale);
      $editForm->handleRequest($request);

      if ($editForm->isSubmitted() && $editForm->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('oderemale_edit', array('id' => $oderemale->getId()));
      }

      return $this->render('AdminBundle:Oderemale:edit.html.twig', array(
      'oderemale' => $oderemale,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
      ));
      } */

    /**
     * Deletes a oderemale entity.
     *
     */
    public function deleteAction(Request $request, Oderemale $oderemale) {

        //$form = $this->createDeleteForm($oderemale);
        //$form->handleRequest($request);

        if ($oderemale->getId() > 0) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oderemale);
            $em->flush();
        }

        return $this->redirectToRoute('oderemale_index');
    }

    public function delete_allAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $em->getRepository('AdminBundle:Oderemale')
                ->createQueryBuilder('a')
                ->delete()
                ->getQuery()
                ->execute();

        return $this->redirectToRoute('oderemale_index');
    }

    /**
     * Creates a form to delete a oderemale entity.
     *
     * @param Oderemale $oderemale The oderemale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oderemale $oderemale) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('oderemale_delete', array('id' => $oderemale->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
