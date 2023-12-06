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

    public function getOrderCountByDateRange($startDate = null, $endDate = null)
    {
        $db = new Connect();

        $select = "SELECT COUNT(*) AS order_count FROM orders";


        if ($startDate !== null && $endDate !== null) {
            $select .= " WHERE order_date BETWEEN ? AND ?";
            $result = $db->pdo_query_one($select, $startDate, $endDate);
        } else {
            $result = $db->pdo_query_one($select);
        }

        return $result ? $result['order_count'] : 0;
    }


    public function getOrderProfitByDateRange($startDate = null, $endDate = null)
    {
        $db = new Connect();

        $select = "SELECT SUM(total_price) AS total_profit
               FROM order_details";

        if ($startDate !== null && $endDate !== null) {
            $select .= " INNER JOIN orders o ON order_details.order_id = o.id
                    WHERE o.order_date BETWEEN ? AND ?";
            $result = $db->pdo_query_one($select, $startDate, $endDate);
        } else {
            $result = $db->pdo_query_one($select);
        }

        return $result ? $result['total_profit'] : 0;
    }

}
?>