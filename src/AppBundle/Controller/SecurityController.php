<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    public function authentificationAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $parameters = array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'current' => 'authentification'
        );
        return $this->render('@views/back/security/index.html.twig', $parameters);
    }
}