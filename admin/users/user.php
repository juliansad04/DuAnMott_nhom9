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
    function deleteUser($id)
    {
        $db = new connect();
        $query = "delete from users where id = '$id'";
        $db->pdo_execute($query);
    }

    public function getUserById($userId)
    {
        $db = new connect();
        $select = "SELECT * FROM users WHERE id = ?";
        $result = $db->pdo_query_one($select, $userId);

        return $result;
    }
}
