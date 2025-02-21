<?php

namespace App\Controller;

use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SellPageController extends AbstractController
{
    #[Route('/sell', name: 'app_sell')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('seller/sell.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}