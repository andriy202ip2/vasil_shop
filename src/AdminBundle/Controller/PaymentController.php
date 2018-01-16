<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Payment controller.
 *
 */
class PaymentController extends Controller
{
    /**
     * Lists all payment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $payments = $em->getRepository('AdminBundle:Payment')->findOneBy([]);

        return $this->render('AdminBundle:Payment:index.html.twig', array(
            'payment' => $payments,
        ));
    }

    /**
     * Displays a form to edit an existing payment entity.
     *
     */
    public function editAction(Request $request, Payment $payment)
    {
        //$deleteForm = $this->createDeleteForm($payment);
        $editForm = $this->createForm('AdminBundle\Form\PaymentType', $payment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('payment_edit', array('id' => $payment->getId()));
            return $this->redirectToRoute('payment_index');
        }

        return $this->render('AdminBundle:Payment:edit.html.twig', array(
            'payment' => $payment,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }
    
    
    /**
     * Creates a new payment entity.
     *
     *//*
    public function newAction(Request $request)
    {
        $payment = new Payment();
        $form = $this->createForm('AdminBundle\Form\PaymentType', $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            return $this->redirectToRoute('payment_show', array('id' => $payment->getId()));
        }

        return $this->render('AdminBundle:Payment:new.html.twig', array(
            'payment' => $payment,
            'form' => $form->createView(),
        ));
    }*/

    /**
     * Finds and displays a payment entity.
     *
     *//*
    public function showAction(Payment $payment)
    {
        $deleteForm = $this->createDeleteForm($payment);

        return $this->render('AdminBundle:Payment:show.html.twig', array(
            'payment' => $payment,
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    /**
     * Deletes a payment entity.
     *
     *//*
    public function deleteAction(Request $request, Payment $payment)
    {
        $form = $this->createDeleteForm($payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($payment);
            $em->flush();
        }

        return $this->redirectToRoute('payment_index');
    }*/

    /**
     * Creates a form to delete a payment entity.
     *
     * @param Payment $payment The payment entity
     *
     * @return \Symfony\Component\Form\Form The form
     *//*
    private function createDeleteForm(Payment $payment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('payment_delete', array('id' => $payment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }*/
}
