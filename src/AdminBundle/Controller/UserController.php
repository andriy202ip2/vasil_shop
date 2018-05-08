<?php

namespace AdminBundle\Controller;

use Security\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller {

    /**
     * Lists all user entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('SecurityUserBundle:User')->findAll();

        return $this->render('AdminBundle:User:index.html.twig', array(
                    'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request) {
        $user = new User();
        $form = $this->createForm('AdminBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->setPasword($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('AdminBundle:User:new.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user) {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('AdminBundle:User:show.html.twig', array(
                    'user' => $user,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user) {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AdminBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $user = $this->setPasword($user);
            
            //$em = $this->getDoctrine()->getManager();
            //$em->persist($user);
            //$em->flush();

            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index', array('id' => $user->getId()));
        }

        return $this->render('AdminBundle:User:edit.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, User $user) {
        //$form = $this->createDeleteForm($user);
        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        //}

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    private function setPasword($user) {

        $encoderFactory = $this->get('security.encoder_factory');
        $encoder = $encoderFactory->getEncoder($user);

        $salt = $user->getSalt(); // this should be different for every user
        $password = $encoder->encodePassword($user->getPassword(), $salt);
        $user->setPassword($password);

        return $user;
    }

}
