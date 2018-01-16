<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Emale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Emale controller.
 *
 */
class EmaleController extends Controller
{
    /**
     * Lists all emale entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emales = $em->getRepository('AdminBundle:Emale')->findOneBy([]);

        return $this->render('AdminBundle:Emale:index.html.twig', array(
            'emale' => $emales,
        ));
    }

    /**
     * Displays a form to edit an existing emale entity.
     *
     */
    public function editAction(Request $request, Emale $emale)
    {
        //$deleteForm = $this->createDeleteForm($emale);
        $editForm = $this->createForm('AdminBundle\Form\EmaleType', $emale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('emale_edit', array('id' => $emale->getId()));
            return $this->redirectToRoute('emale_index');
        }

        return $this->render('AdminBundle:Emale:edit.html.twig', array(
            'emale' => $emale,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }    
    
    /**
     * Creates a new emale entity.
     *
     *//*
    public function newAction(Request $request)
    {
        $emale = new Emale();
        $form = $this->createForm('AdminBundle\Form\EmaleType', $emale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emale);
            $em->flush();

            return $this->redirectToRoute('emale_show', array('id' => $emale->getId()));
        }

        return $this->render('AdminBundle:Emale:new.html.twig', array(
            'emale' => $emale,
            'form' => $form->createView(),
        ));
    }*/

    /**
     * Finds and displays a emale entity.
     *
     *//*
    public function showAction(Emale $emale)
    {
        $deleteForm = $this->createDeleteForm($emale);

        return $this->render('AdminBundle:Emale:show.html.twig', array(
            'emale' => $emale,
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    /**
     * Deletes a emale entity.
     *
     *//*
    public function deleteAction(Request $request, Emale $emale)
    {
        $form = $this->createDeleteForm($emale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emale);
            $em->flush();
        }

        return $this->redirectToRoute('emale_index');
    }*/

    /**
     * Creates a form to delete a emale entity.
     *
     * @param Emale $emale The emale entity
     *
     * @return \Symfony\Component\Form\Form The form
     *//*
    private function createDeleteForm(Emale $emale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('emale_delete', array('id' => $emale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }*/
}
