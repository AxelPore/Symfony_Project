<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ): Response
    {
        $packs = [
            'basic' => [
                'name' => 'Pack Basic',
                'price' => 5000,
                'description' => 'Le pack essentiel pour débuter votre aventure en Full Dive',
                'features' => [
                    'Casque FullDive VR',
                    'Accès à la plateforme',
                    'Support 24/7'
                ]
            ],
            'explorer' => [
                'name' => 'Pack Explorer',
                'price' => 7500,
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
                'price' => 12000,
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

        return $this->render('home/index.html.twig', [
            'featured_products' => $productRepository->findFeaturedProducts(),
            'new_products' => $productRepository->findNewProducts(),
            'categories' => $categoryRepository->findMainCategories(),
            'best_sellers' => $productRepository->findBestSellers(),
            'packs' => $packs
        ]);
    }
} 