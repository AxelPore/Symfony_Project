<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TermsController extends AbstractController
{
    #[Route('/terms', name: 'app_terms')]
    #[IsGranted('PUBLIC_ACCESS')]
    public function index(): Response
    {
        $user = $this->getUser();
        $contractContent = file_get_contents(__DIR__.'/../../contract.txt');
        
        return $this->render('terms/termsOfUse.html.twig', [
            'user' => $user,
            'contract_content' => $contractContent,
        ]);

    }
}
