<?php

namespace App\Controller;

use App\Service\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_index')]
    public function index(CartManager $cartManager): Response
    {
        $cart = $cartManager->getCurrentCart();
        $total = $cartManager->getCartTotal();
        
        // Débogage
        dump($cart);
        dump($total);
        
        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    #[Route('/cart/add', name: 'cart_add', methods: ['POST'])]
    public function add(Request $request, CartManager $cartManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        try {
            $itemExists = false;
            $cart = $cartManager->getCurrentCart();
            
            // Vérifier si l'item existe déjà
            foreach ($cart->getItems() as $item) {
                if ($item->getItemType() === $data['type'] && $item->getItemId() === $data['id']) {
                    $itemExists = true;
                    break;
                }
            }
            
            if (!$itemExists) {
                $cartManager->addItem(
                    $data['type'],
                    $data['id'],
                    $data['name'],
                    floatval($data['price'])
                );
            }
            
            return new JsonResponse([
                'success' => true,
                'alreadyInCart' => $itemExists,
                'message' => $itemExists ? 'Article déjà dans le panier' : 'Article ajouté au panier'
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove', methods: ['POST'])]
    public function remove(int $id, CartManager $cartManager): JsonResponse
    {
        $cartManager->removeItem($id);
        return new JsonResponse(['success' => true]);
    }

    #[Route('/cart/count', name: 'cart_count')]
    public function getCount(CartManager $cartManager): JsonResponse
    {
        $cart = $cartManager->getCurrentCart();
        $count = $cart->getItems()->count();
        
        return new JsonResponse(['count' => $count]);
    }
} 