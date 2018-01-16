<?php

namespace Security\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        
        return $this->render('SecurityUserBundle:Login:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
        
    }
    

    /**
     * Never used due to Symfony's Security component
     */
    public function loginCheckAction(){
        
    }

        
    public function logoutAction(){}
    
}
