<?php

class ShoppingCart
{
    private $cart;
    private $cartItem;

    private $product;

    public function initDependencies()
    {
        $this->cart = new Cart();
        $this->cartItem = new CartItem();
        $this->product = new Product();
    }

    public function addToCart($userId, $productId, $quantity)
    {
        $this->initDependencies();

        $cart = $this->getOrCreateCart($userId);

        $existingCartItem = $this->cartItem->getCartItemByProductAndCart($productId, $cart['id']);

        if ($existingCartItem) {
            $newQuantity = $existingCartItem['quantity'] + $quantity;
            $this->cartItem->updateCartItem($existingCartItem['id'], $cart['id'], $productId, $newQuantity);
        } else {
            $this->cartItem->createCartItem($cart['id'], $productId, $quantity);
        }
    }

    public function removeFromCart($cartItemId)
    {
        $this->initDependencies();

        $this->cartItem->deleteCartItem($cartItemId);
    }


    public function getCartWithDetailsById($userId)
    {
        $this->initDependencies();

        $cart = $this->getOrCreateCart($userId);

        $cartDetails['details'] = $this->cartItem->getCartItemsByCartId($cart['id']);
        $cartDetails['cart'] = $cart;

        $totalPrice = 0;
        foreach ($cartDetails['details'] as &$cartItem) {
            $product = $this->product->getProductById($cartItem['product_id']);
            $cartItem['product_name'] = $product['name'];
            $cartItem['image_url'] = $product['image'];
            $cartItem['price'] = $product['price'];
            $cartItem['product_id'] = $product['id'];
            $cartItem['total_price'] = $this->product->calculateTotalPrice($cartItem['quantity'], $product['price']);

            $totalPrice += $cartItem['total_price'];
        }

        $cartDetails['cart']['total_price'] = $totalPrice;

        return $cartDetails;
    }


    private function getOrCreateCart($userId)
    {
        $this->initDependencies();

        $existingCart = $this->cart->getCartByUserId($userId);

        if (!$existingCart) {
            $createdAt = date("Y-m-d H:i:s");
            $cartId = $this->cart->createCart($userId, $createdAt);

            $newCart = $this->cart->getCartById($cartId);

            return $newCart;
        }

        return $existingCart;
    }

    public function updateCartItemQuantity($cartItemId, $newQuantity)
    {
        $this->initDependencies();
        $this->cartItem->updateCartItemQuantity($cartItemId, $newQuantity);
    }

    public function clearCart($userId)
    {
        $cartItem = new CartItem();
        $cartItems = $cartItem->getCartItemsByCartId($userId);

        foreach ($cartItems as $item) {
            $cartItem->deleteCartItem($item['id']);
        }
    }
}