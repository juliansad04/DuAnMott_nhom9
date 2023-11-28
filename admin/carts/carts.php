<?php

class Cart
{
    public function getAllCarts()
    {
        $db = new Connect();
        $select = "SELECT * FROM carts";
        return $db->pdo_query($select);
    }

    public function getCartById($cartId)
    {
        $db = new Connect();
        $select = "SELECT * FROM carts WHERE id=?";
        return $db->pdo_query_one($select, $cartId);
    }

    public function createCart($userId, $createdAt)
    {
        $db = new Connect();
        $query = "INSERT INTO carts (user_id, created_at) VALUES (?, ?)";
        return $db->pdo_execute($query, $userId, $createdAt);
    }

    public function updateCart($cartId, $userId, $createdAt)
    {
        $db = new Connect();
        $query = "UPDATE carts SET user_id=?, created_at=? WHERE id=?";
        return $db->pdo_execute($query, $userId, $createdAt, $cartId);
    }

    public function deleteCart($cartId)
    {
        $db = new Connect();
        $query = "DELETE FROM carts WHERE id=?";
        return $db->pdo_execute($query, $cartId);
    }

    public function getCartByUserId($userId)
    {
        $db = new Connect();
        $select = "SELECT * FROM carts WHERE user_id=?";
        return $db->pdo_query_one($select, $userId);
    }
}

?>