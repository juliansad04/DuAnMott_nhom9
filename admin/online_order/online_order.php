<?php

class OnlineOrder
{
    public function getAllOnlineOrders()
    {
        $db = new Connect();
        $select = "SELECT * FROM online_orders";
        return $db->pdo_query($select);
    }

    public function getOnlineOrderById($onlineOrderId)
    {
        $db = new Connect();
        $select = "SELECT * FROM online_orders WHERE id=?";
        return $db->pdo_query_one($select, $onlineOrderId);
    }

    public function createOnlineOrder($userId, $orderDate, $customerName, $customerAddress, $sdt, $email, $noiDung)
    {
        $db = new Connect();
        $query = "INSERT INTO online_orders (user_id, order_date, customer_name, address, sdt, email, noi_dung, status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, 'Chưa xác nhận')";
        return $db->pdo_execute($query, $userId, $orderDate, $customerName, $customerAddress, $sdt, $email, $noiDung);
    }


    public function updateOnlineOrder($onlineOrderId, $userId, $orderDate)
    {
        $db = new Connect();
        $query = "UPDATE online_orders SET user_id=?, order_date=? WHERE id=?";
        return $db->pdo_execute($query, $userId, $orderDate, $onlineOrderId);
    }

    public function deleteOnlineOrder($onlineOrderId)
    {
        $db = new Connect();
        $query = "DELETE FROM online_orders WHERE id=?";
        return $db->pdo_execute($query, $onlineOrderId);
    }

    public function updateOrderStatus($onlineOrderId, $newStatus)
    {
        $db = new Connect();
        $query = "UPDATE online_orders SET status=? WHERE id=?";
        return $db->pdo_execute($query, $newStatus, $onlineOrderId);
    }

    public function getOnlineOrdersByUserId($userId)
    {
        $db = new Connect();
        $select = "SELECT * FROM online_orders WHERE user_id=?";
        return $db->pdo_query($select, $userId);
    }

    public function getOnlineOrderDetailsByUserId($userId)
    {
        $db = new Connect();
        $select = "SELECT od.*
                   FROM online_orders o
                   INNER JOIN online_order_details od ON o.id = od.online_order_id
                   WHERE o.user_id=?";
        return $db->pdo_query($select, $userId);
    }
}

?>