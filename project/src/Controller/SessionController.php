<?php
// src/Controller/SessionController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/set-session', name: 'set_session')]
    public function setSession(SessionInterface $session): Response
    {
        $session->set('user_name', 'Manish Patel');
        return new Response('Session data set.');
    }

    #[Route('/get-session', name: 'get_session')]
    public function getSession(SessionInterface $session): Response
    {
        $userName = $session->get('user_name', 'Session data yet to be set');
        return new Response('User name from session: ' . $userName);
    }

    #[Route('/remove-session', name: 'remove_session')]
    public function removeSession(SessionInterface $session): Response
    {
        $session->remove('user_name');
        return new Response('Session data removed.');
    }
}
