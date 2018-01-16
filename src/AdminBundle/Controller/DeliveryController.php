<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Delivery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Delivery controller.
 *
 */
class DeliveryController extends Controller
{
    /**
     * Lists all delivery entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $deliveries = $em->getRepository('AdminBundle:Delivery')->findOneBy([]);

        return $this->render('AdminBundle:Delivery:index.html.twig', array(
            'delivery' => $deliveries,
        ));
    }

    /**
     * Displays a form to edit an existing delivery entity.
     *
     */
    public function editAction(Request $request, Delivery $delivery)
    {
        //$deleteForm = $this->createDeleteForm($delivery);
        $editForm = $this->createForm('AdminBundle\Form\DeliveryType', $delivery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('delivery_edit', array('id' => $delivery->getId()));
            return $this->redirectToRoute('delivery_index');
        }

        return $this->render('AdminBundle:Delivery:edit.html.twig', array(
            'delivery' => $delivery,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }    
    
    
    /**
     * Creates a new delivery entity.
     *
     *//*
    public function newAction(Request $request)
    {
        $delivery = new Delivery();
        $form = $this->createForm('AdminBundle\Form\DeliveryType', $delivery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($delivery);
            $em->flush();

            return $this->redirectToRoute('delivery_show', array('id' => $delivery->getId()));
        }

        return $this->render('AdminBundle:Delivery:new.html.twig', array(
            'delivery' => $delivery,
            'form' => $form->createView(),
        ));
    }*/

    /**
     * Finds and displays a delivery entity.
     *
     *//*
    public function showAction(Delivery $delivery)
    {
        $deleteForm = $this->createDeleteForm($delivery);

        return $this->render('AdminBundle:Delivery:show.html.twig', array(
            'delivery' => $delivery,
            'delete_form' => $deleteForm->createView(),
        ));
    }*/



    /**
     * Deletes a delivery entity.
     *
     *//*
    public function deleteAction(Request $request, Delivery $delivery)
    {
        $form = $this->createDeleteForm($delivery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($delivery);
            $em->flush();
        }

        return $this->redirectToRoute('delivery_index');
    }*/

    /**
     * Creates a form to delete a delivery entity.
     *
     * @param Delivery $delivery The delivery entity
     *
     * @return \Symfony\Component\Form\Form The form
     *//*
    private function createDeleteForm(Delivery $delivery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delivery_delete', array('id' => $delivery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }*/
}
