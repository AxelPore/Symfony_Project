<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class AuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    public function start(Request $request, AuthenticationException $authException = null): RedirectResponse
    {
        // Si l'utilisateur n'est pas sur la landing page, redirigez-le vers la landing page
        if ($request->getPathInfo() !== '/') {
            return new RedirectResponse($this->urlGenerator->generate('app_landing'));
        }
        
        // Sinon, redirigez vers la page de login
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }
} 