<?php
class OrderDetail
{
    public function getAllOrderDetails()
    {
        $db = new Connect();
        $select = "SELECT * FROM order_details";
        return $db->pdo_query($select);
    }

    public function getOrderDetailById($orderDetailId)
    {
        $db = new Connect();
        $select = "SELECT * FROM order_details WHERE order_id=?";
        return $db->pdo_query($select, $orderDetailId);
    }

    public function createOrderDetail($orderId, $productId, $quantity, $totalPrice)
    {
        $db = new Connect();
        $query = "INSERT INTO order_details (order_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)";
        return $db->pdo_execute($query, $orderId, $productId, $quantity, $totalPrice);
    }

    public function updateOrderDetail($orderDetailId, $orderId, $productId, $quantity, $totalPrice)
    {
        $db = new Connect();
        $query = "UPDATE order_details SET order_id=?, product_id=?, quantity=?, total_price=? WHERE id=?";
        return $db->pdo_execute($query, $orderId, $productId, $quantity, $totalPrice, $orderDetailId);
    }

    public function deleteOrderDetail($orderDetailId)
    {
        $db = new Connect();
        $query = "DELETE FROM order_details WHERE id=?";
        return $db->pdo_execute($query, $orderDetailId);
    }
}
?>