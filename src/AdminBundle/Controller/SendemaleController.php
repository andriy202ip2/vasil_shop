<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Sendemale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sendemale controller.
 *
 */
class SendemaleController extends Controller
{
    /**
     * Lists all sendemale entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //$sendemales = $em->getRepository('AdminBundle:Sendemale')->findAll();

        $dql = $em->getRepository('AdminBundle:Sendemale')
                ->createQueryBuilder('a')
                ->orderBy('a.id', 'DESC');

        $query = $dql->getQuery();

        $paginator = $this->get('knp_paginator');
        $sendemales = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );
        
        return $this->render('AdminBundle:Sendemale:index.html.twig', array(
            'sendemales' => $sendemales,
        ));
    }

    /**
     * Creates a new sendemale entity.
     *
     *//*
    public function newAction(Request $request)
    {
        $sendemale = new Sendemale();
        $form = $this->createForm('AdminBundle\Form\SendemaleType', $sendemale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sendemale);
            $em->flush();

            return $this->redirectToRoute('sendemale_show', array('id' => $sendemale->getId()));
        }

        return $this->render('AdminBundle:Sendemale:new.html.twig', array(
            'sendemale' => $sendemale,
            'form' => $form->createView(),
        ));
    }*/

    /**
     * Finds and displays a sendemale entity.
     *
     */
    public function showAction(Sendemale $sendemale)
    {
        $deleteForm = $this->createDeleteForm($sendemale);

        return $this->render('AdminBundle:Sendemale:show.html.twig', array(
            'sendemale' => $sendemale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sendemale entity.
     *
     *//*
    public function editAction(Request $request, Sendemale $sendemale)
    {
        $deleteForm = $this->createDeleteForm($sendemale);
        $editForm = $this->createForm('AdminBundle\Form\SendemaleType', $sendemale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sendemale_edit', array('id' => $sendemale->getId()));
        }

        return $this->render('AdminBundle:Sendemale:edit.html.twig', array(
            'sendemale' => $sendemale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    /**
     * Deletes a sendemale entity.
     *
     */
    public function deleteAction(Request $request, Sendemale $sendemale)
    {
        //$form = $this->createDeleteForm($sendemale);
        //$form->handleRequest($request);

        if ($sendemale->getId() > 0) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sendemale);
            $em->flush();
        }

        return $this->redirectToRoute('sendemale_index');
    }

    public function delete_allAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $em->getRepository('AdminBundle:Sendemale')
                ->createQueryBuilder('a')
                ->delete()
                ->getQuery()
                ->execute();

        return $this->redirectToRoute('sendemale_index');
    }
    
    /**
     * Creates a form to delete a sendemale entity.
     *
     * @param Sendemale $sendemale The sendemale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sendemale $sendemale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sendemale_delete', array('id' => $sendemale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
