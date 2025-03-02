<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PackController extends AbstractController
{
    #[Route('/packs', name: 'app_pack_index')]
    public function index(): Response
    {
        $packs = [
            'basic' => [
                'name' => 'Pack Basic',
                'price' => 499,
                'description' => 'Le pack essentiel pour débuter votre aventure en Full Dive',
                'features' => [
                    'Casque FullDive VR',
                    'Accès à la plateforme',
                    'Support 24/7'
                ]
            ],
            'explorer' => [
                'name' => 'Pack Explorer',
                'price' => 699,
                'description' => 'L\'expérience idéale pour les aventuriers',
                'features' => [
                    'Casque FullDive VR',
                    'Accès à la plateforme',
                    'Support 24/7',
                    '1 Map aléatoire offerte'
                ]
            ],
            'vip' => [
                'name' => 'Pack V.I.P',
                'price' => 999,
                'description' => 'L\'expérience ultime en Full Dive',
                'features' => [
                    'Casque FullDive VR',
                    'Accès à la plateforme',
                    'Support prioritaire 24/7',
                    '3 Maps exclusives',
                    'Accès anticipé aux nouveautés'
                ]
            ]
        ];

        return $this->render('pack/index.html.twig', [
            'packs' => $packs
        ]);
    }
} 