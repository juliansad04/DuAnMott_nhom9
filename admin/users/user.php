<?php
class user
{
    var $username = null;
    var $password = null;
    var $name = null;
    var $email = null;
    var $images = null;

    function getUser()
    {
        $db = new connect();
        $select = "select * from users";
        return $db->pdo_query($select);
    }
    public function checkUser($username, $password)
    {
        $db = new Connect();
        $select = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $db->pdo_query_one($select);

        return $result;
    }


    public function id($username, $password)
    {
        $db = new connect();
        $select = "select id from users where userName='$username' and password='$password'";
        $result = $db->pdo_query_one($select);
        return $result;
    }

    public function getInfoById($username)
    {
        $db = new connect();
        $select = "select * from users where username='$username'";
        $result = $db->pdo_query($select);
        //   $quest = $result->fetch();
        return $result;
    }

    function insertUser($tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone)
    {
        $db = new connect();
        $query = "INSERT INTO users(id, username, password, fullname, email, avatar, address, phone) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";

        $newUserId = $db->pdo_execute($query, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone);

        if ($newUserId && isset($_SESSION['id'])) {
            $cart = new Cart();
            $createdAt = date("Y-m-d H:i:s");
            $cart->createCart($newUserId , $createdAt);
        }

        echo "Inserted user with ID: " . $newUserId;
    }

    function registerUser($tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone)
    {
        $db = new connect();

        $tmpaddress = ($tmpaddress !== null) ? $tmpaddress : 'default_address';

        $tmpphone = ($tmpphone !== null) ? $tmpphone : 'default_phone';

        $query = "INSERT INTO users(id, username, password, fullname, email, avatar, address, phone, role) VALUES (NULL, ?, ?, ?, ?, COALESCE(?, 'path_to_default_avatar'), ?, ?, 0)";

        $newUserId = $db->pdo_execute($query, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone);

        return $newUserId;
    }





    function updateUser($userId, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone)
    {
        $db = new connect();
        if (empty($tmpavatar)) {
            $query = "UPDATE users SET username=?, password=?, fullname=?, email=?, address=?, phone=? WHERE id=?";
            $result = $db->pdo_execute($query, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpaddress, $tmpphone, $userId);
        } else {
            $query = "UPDATE users SET username=?, password=?, fullname=?, email=?, avatar=?, address=?, phone=? WHERE id=?";
            $result = $db->pdo_execute($query, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone, $userId);
        }

        return $result;
    }

    public function hasOnlineOrders($userId)
    {
        $db = new Connect();
        $select = "SELECT COUNT(*) as count FROM online_orders WHERE user_id=?";
        $result = $db->pdo_query_one($select, $userId);

        return $result['count'] > 0;
    }


    function deleteUser($id)
    {
        $db = new connect();
        if ($this->hasOnlineOrders($id)) {
            echo "Không thể xóa người dùng vì có đơn hàng liên quan.";
        } else {
            $query = "DELETE FROM users WHERE id=?";
            $db->pdo_execute($query, $id);
            echo "Đã xóa người dùng thành công.";
        }
    }


    public function getUserById($userId)
    {
        $db = new connect();
        $select = "SELECT * FROM users WHERE id = ?";
        $result = $db->pdo_query_one($select, $userId);

        return $result;
    }
}