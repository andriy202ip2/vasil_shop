<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\About;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * About controller.
 *
 */
class AboutController extends Controller
{
    /**
     * Lists all about entities.
     *
     */
    public function indexAction(Request $request)
    {
        //echo $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();

        $abouts = $em->getRepository('AdminBundle:About')->findOneBy([]);

        return $this->render('AdminBundle:About:index.html.twig', array(
            'abouts' => $abouts,
        ));
    }

    /**
     * Displays a form to edit an existing about entity.
     *
     */
    public function editAction(Request $request, About $about)
    {

        
        //$deleteForm = $this->createDeleteForm($about);
        $editForm = $this->createForm('AdminBundle\Form\AboutType', $about);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('about_edit', array('id' => $about->getId()));
            //return $this->redirect($this->generateUrl('about_index'));
            return $this->redirectToRoute('about_index');
                        
            
        }

        return $this->render('AdminBundle:About:edit.html.twig', array(
            'about' => $about,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    /*
    public function newAction(Request $request)
    {
        $about = new About();
        $form = $this->createForm('AdminBundle\Form\AboutType', $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($about);
            $em->flush();

            return $this->redirectToRoute('about_show', array('id' => $about->getId()));
        }

        return $this->render('AdminBundle:About:new.html.twig', array(
            'about' => $about,
            'form' => $form->createView(),
        ));
    }

    public function showAction(About $about)
    {
        $deleteForm = $this->createDeleteForm($about);

        return $this->render('AdminBundle:About:show.html.twig', array(
            'about' => $about,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, About $about)
    {
        $form = $this->createDeleteForm($about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($about);
            $em->flush();
        }

        return $this->redirectToRoute('about_index');
    }

    private function createDeleteForm(About $about)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('about_delete', array('id' => $about->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
     */
}
