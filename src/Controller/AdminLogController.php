<?php

namespace App\Controller;

use App\Repository\InteractionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminLogController extends AbstractController
{
    private $interactionsRepository;

    public function __construct(InteractionsRepository $interactionsRepository)
    {
        $this->interactionsRepository = $interactionsRepository;
    }

    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $interactions = $this->interactionsRepository->findAll();
        
        return $this->render('admin/admin.html.twig', [
            'interactions' => $interactions,
        ]);
    }
}
