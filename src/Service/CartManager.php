<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\CartItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartManager
{
    private $requestStack;
    private $entityManager;

    public function __construct(
        RequestStack $requestStack,
        EntityManagerInterface $entityManager
    ) {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function getCurrentCart(): Cart
    {
        $session = $this->requestStack->getSession();
        $cartId = $session->get('cart_id');

        if ($cartId) {
            $cart = $this->entityManager->getRepository(Cart::class)->find($cartId);
            if ($cart) {
                return $cart;
            }
        }

        $cart = new Cart();
        $cart->setSessionId($session->getId());
        $this->entityManager->persist($cart);
        $this->entityManager->flush();

        $session->set('cart_id', $cart->getId());

        return $cart;
    }

    public function addItem(string $type, string $id, string $name, float $price): void
    {
        $cart = $this->getCurrentCart();
        
        // Vérifier si l'item existe déjà dans le panier
        foreach ($cart->getItems() as $existingItem) {
            if ($existingItem->getItemType() === $type && $existingItem->getItemId() === $id) {
                // L'item existe déjà, ne pas l'ajouter à nouveau
                return;
            }
        }
        
        // Si l'item n'existe pas, l'ajouter
        $cartItem = new CartItem();
        $cartItem->setCart($cart)
                 ->setItemType($type)
                 ->setItemId($id)
                 ->setName($name)
                 ->setPrice($price);

        $this->entityManager->persist($cartItem);
        $this->entityManager->flush();
    }

    public function removeItem(int $itemId): void
    {
        $item = $this->entityManager->getRepository(CartItem::class)->find($itemId);
        if ($item) {
            $this->entityManager->remove($item);
            $this->entityManager->flush();
        }
    }

    public function getCartTotal(): float
    {
        $cart = $this->getCurrentCart();
        $total = 0;

        foreach ($cart->getItems() as $item) {
            $total += $item->getPrice();
        }

        return $total;
    }
} 