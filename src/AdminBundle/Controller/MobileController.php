<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Mobile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Mobile controller.
 *
 */
class MobileController extends Controller {

    /**
     * Lists all mobile entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $mobiles = $em->getRepository('AdminBundle:Mobile')->findOneBy([]);

        return $this->render('AdminBundle:Mobile:index.html.twig', array(
                    'mobiles' => $mobiles,
        ));
    }

    /**
     * Displays a form to edit an existing mobile entity.
     *
     */
    public function editAction(Request $request, Mobile $mobile) {
        //$deleteForm = $this->createDeleteForm($mobile);
        $editForm = $this->createForm('AdminBundle\Form\MobileType', $mobile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('mobile_edit', array('id' => $mobile->getId()));
            return $this->redirectToRoute('mobile_index');
        }

        return $this->render('AdminBundle:Mobile:edit.html.twig', array(
                    'mobile' => $mobile,
                    'edit_form' => $editForm->createView(),
                    //'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Creates a new mobile entity.
     *
     *//*
      public function newAction(Request $request)
      {
      $mobile = new Mobile();
      $form = $this->createForm('AdminBundle\Form\MobileType', $mobile);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($mobile);
      $em->flush();

      return $this->redirectToRoute('mobile_show', array('id' => $mobile->getId()));
      }

      return $this->render('AdminBundle:Mobile:new.html.twig', array(
      'mobile' => $mobile,
      'form' => $form->createView(),
      ));
      }
     */
    /**
     * Finds and displays a mobile entity.
     *
     */
    /*
      public function showAction(Mobile $mobile)
      {
      $deleteForm = $this->createDeleteForm($mobile);

      return $this->render('AdminBundle:Mobile:show.html.twig', array(
      'mobile' => $mobile,
      'delete_form' => $deleteForm->createView(),
      ));
      }
     */

    /**
     * Deletes a mobile entity.
     *
     */
    /*
      public function deleteAction(Request $request, Mobile $mobile)
      {
      $form = $this->createDeleteForm($mobile);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($mobile);
      $em->flush();
      }

      return $this->redirectToRoute('mobile_index');
      }
     */
    /**
     * Creates a form to delete a mobile entity.
     *
     * @param Mobile $mobile The mobile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    /*
      private function createDeleteForm(Mobile $mobile)
      {
      return $this->createFormBuilder()
      ->setAction($this->generateUrl('mobile_delete', array('id' => $mobile->getId())))
      ->setMethod('DELETE')
      ->getForm()
      ;
      } */
}
