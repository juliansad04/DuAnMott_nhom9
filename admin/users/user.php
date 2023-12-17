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

    function insertUser($tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone, $tmprole)
    {
        $db = new connect();
        $query = "INSERT INTO users(id, username, password, fullname, email, avatar, address, phone, role) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";

        $newUserId = $db->pdo_execute($query, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone, $tmprole);
        echo "Inserted user with ID: " . $newUserId;
    }

    function registerUser($tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone)
    {
        $db = new connect();

        $queryCheckUsername = "SELECT COUNT(*) FROM users WHERE username = ?";
        $resultUsername = $db->pdo_query($queryCheckUsername, $tmpusername);

        $countUsername = $resultUsername[0]["COUNT(*)"];

        if ($countUsername > 0) {
            $message = "Tên người dùng đã tồn tại. Vui lòng chọn tên người dùng khác.";
            return $message;
        }

        $queryCheckEmail = "SELECT COUNT(*) FROM users WHERE email = ?";
        $resultEmail = $db->pdo_query($queryCheckEmail, $tmpemail);

        $countEmail = $resultEmail[0]["COUNT(*)"];

        if ($countEmail > 0) {
            $message = "Email đã tồn tại. Vui lòng sử dụng địa chỉ email khác.";
            return $message;
        }

        $tmpaddress = $tmpaddress ?: 'default_address';
        $tmpphone = $tmpphone ?: 'default_phone';

        $queryInsertUser = "INSERT INTO users(id, username, password, fullname, email, avatar, address, phone, role) VALUES (NULL, ?, ?, ?, ?, COALESCE(?, 'path_to_default_avatar'), ?, ?, 0)";

        $newUserId = $db->pdo_execute($queryInsertUser, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone);

        if ($newUserId) {
            return $newUserId;
        } else {
            $message = "Lỗi khi thêm người dùng.";
            return $message;
        }
    }



    function updateUser($userId, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone, $tmprole)
    {
        $db = new connect();
        if (empty($tmpavatar)) {
            $query = "UPDATE users SET username=?, password=?, fullname=?, email=?, address=?, phone=?, role=? WHERE id=?";
            $result = $db->pdo_execute($query, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpaddress, $tmpphone, $tmprole, $userId);
        } else {
            $query = "UPDATE users SET username=?, password=?, fullname=?, email=?, avatar=?, address=?, phone=?, role=? WHERE id=?";
            $result = $db->pdo_execute($query, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone, $tmprole, $userId);
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
            $mess = "Không thể xóa người dùng vì còn dữ liệu trong hệ thống.";
        } else {
            $query = "DELETE FROM users WHERE id=?";
            $db->pdo_execute($query, $id);
            $mess = "Đã xóa người dùng thành công.";
        }
        return $mess;
    }


    public function getUserById($userId)
    {
        $db = new connect();
        $select = "SELECT * FROM users WHERE id = ?";
        $result = $db->pdo_query_one($select, $userId);

        return $result;
    }

    public function getUserCountByRole($role)
    {
        $db = new Connect();
        $select = "SELECT COUNT(*) as user_count FROM users WHERE role = ?";
        $result = $db->pdo_query_one($select, $role);

        return $result ? $result['user_count'] : 0;
    }
}