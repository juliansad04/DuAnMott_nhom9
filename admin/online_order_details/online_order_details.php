<?php

class OnlineOrderDetail
{
    public function getAllOnlineOrderDetails()
    {
        $db = new Connect();
        $select = "SELECT * FROM online_order_details";
        return $db->pdo_query($select);
    }

    public function getOnlineOrderDetailById($onlineOrderDetailId)
    {
        $db = new Connect();
        $select = "SELECT * FROM online_order_details WHERE online_order_id=?";
        return $db->pdo_query($select, $onlineOrderDetailId);
    }

    public function getOnlineOrderDetailsByOrderId($onlineOrderId)
    {
        $db = new Connect();
        $select = "SELECT * FROM online_order_details WHERE online_order_id=?";
        return $db->pdo_query($select, $onlineOrderId);
    }

    public function createOnlineOrderDetail($onlineOrderId, $productId, $quantity, $totalPrice)
    {
        $db = new Connect();
        $query = "INSERT INTO online_order_details (online_order_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)";
        $updateQuantityQuery = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
        $db->pdo_execute($updateQuantityQuery, $quantity, $productId);
        return $db->pdo_execute($query, $onlineOrderId, $productId, $quantity, $totalPrice);
    }

    public function updateOnlineOrderDetail($onlineOrderDetailId, $onlineOrderId, $productId, $quantity, $totalPrice)
    {
        $db = new Connect();
        $query = "UPDATE online_order_details SET online_order_id=?, product_id=?, quantity=?, total_price=? WHERE id=?";
        return $db->pdo_execute($query, $onlineOrderId, $productId, $quantity, $totalPrice, $onlineOrderDetailId);
    }

    public function deleteOnlineOrderDetail($onlineOrderDetailId)
    {
        $db = new Connect();
        $query = "DELETE FROM online_order_details WHERE id=?";
        return $db->pdo_execute($query, $onlineOrderDetailId);
    }
}

?>