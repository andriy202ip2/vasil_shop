<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all contact entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('AdminBundle:Contact')->findOneBy([]);

        return $this->render('AdminBundle:Contact:index.html.twig', array(
            'contacts' => $contacts,
        ));
    }

    /**
     * Displays a form to edit an existing contact entity.
     *
     */
    public function editAction(Request $request, Contact $contact)
    {
        //$deleteForm = $this->createDeleteForm($contact);
        $editForm = $this->createForm('AdminBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('contact_edit', array('id' => $contact->getId()));
            return $this->redirectToRoute('contact_index');
        }

        return $this->render('AdminBundle:Contact:edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    /*
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm('AdminBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('contact_show', array('id' => $contact->getId()));
        }

        return $this->render('AdminBundle:Contact:new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('AdminBundle:Contact:show.html.twig', array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Contact $contact)
    {
        $form = $this->createDeleteForm($contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirectToRoute('contact_index');
    }

    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    */
}
