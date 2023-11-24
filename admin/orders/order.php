<?php
class Order
{
    public function getAllOrders()
    {
        $db = new Connect();
        $select = "SELECT * FROM orders";
        return $db->pdo_query($select);
    }

    public function getOrderById($orderId)
    {
        $db = new Connect();
        $select = "SELECT * FROM orders WHERE id=?";
        return $db->pdo_query_one($select, $orderId);
    }

    public function createOrder($userId, $orderDate, $customer_name)
    {
        $db = new Connect();
        $query = "INSERT INTO orders (user_id, order_date, customer_name) VALUES (?, ?, ?)";
        return $db->pdo_execute($query, $userId, $orderDate, $customer_name);
    }

    public function updateOrder($orderId, $userId, $orderDate)
    {
        $db = new Connect();
        $query = "UPDATE orders SET user_id=?, order_date=? WHERE id=?";
        return $db->pdo_execute($query, $userId, $orderDate, $orderId);
    }

    public function deleteOrder($orderId)
    {
        $db = new Connect();
        $query = "DELETE FROM orders WHERE id=?";
        return $db->pdo_execute($query, $orderId);
    }
}
?>