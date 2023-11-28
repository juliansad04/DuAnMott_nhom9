<?php

class CartItem
{
    public function getAllCartItems()
    {
        $db = new Connect();
        $select = "SELECT * FROM cart_items";
        return $db->pdo_query($select);
    }

    public function getCartItemById($cartItemId)
    {
        $db = new Connect();
        $select = "SELECT * FROM cart_items WHERE id=?";
        return $db->pdo_query_one($select, $cartItemId);
    }

    public function getCartItemsByCartId($cartId)
    {
        $db = new Connect();
        $select = "SELECT * FROM cart_items WHERE cart_id=?";
        return $db->pdo_query($select, $cartId);
    }

    public function createCartItem($cartId, $productId, $quantity)
    {
        $db = new Connect();
        $query = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
        return $db->pdo_execute($query, $cartId, $productId, $quantity);
    }

    public function updateCartItem($cartItemId, $cartId, $productId, $quantity)
    {
        $db = new Connect();
        $query = "UPDATE cart_items SET cart_id=?, product_id=?, quantity=? WHERE id=?";
        return $db->pdo_execute($query, $cartId, $productId, $quantity, $cartItemId);
    }

    public function deleteCartItem($cartItemId)
    {
        $db = new Connect();
        $query = "DELETE FROM cart_items WHERE id=?";
        return $db->pdo_execute($query, $cartItemId);
    }

    public function getCartItemByProductAndCart($productId, $cartId)
    {
        $db = new Connect();
        $select = "SELECT * FROM cart_items WHERE product_id=? AND cart_id=?";
        return $db->pdo_query_one($select, $productId, $cartId);
    }

    public function updateCartItemQuantity($cartItemId, $newQuantity)
    {
        $db = new Connect();
        $query = "UPDATE cart_items SET quantity=? WHERE id=?";
        return $db->pdo_execute($query, $newQuantity, $cartItemId);
    }


}

?>