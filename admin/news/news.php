<?php
class news
{
    var $title_news = null;
    var $images = null;
    var $content_news = null;

    function getNews()
    {
        $db = new connect();
        $select = "SELECT news.*, users.username AS username
                FROM news
                LEFT JOIN users ON news.id_user = users.id";
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

    function insertNews($tmptitle_news, $tmpimg_news, $tmpcontent_news, $id_user)
    {
        $db = new connect();
        $query = "INSERT INTO news(id, title_news, img_news, content_news, id_user) VALUES (NULL, ?, ?, ?, ?)";
        $newNewsId = $db->pdo_execute($query, $tmptitle_news, $tmpimg_news, $tmpcontent_news, $id_user);
        echo "Inserted news with ID: " . $newNewsId;
    }




    function updateNews($NewsId, $tmptitle_news, $tmpimg_news, $tmpcontent_news)
    {
        $db = new connect();
        if (empty($tmpimg_news)) {
            $query = "UPDATE news SET title_news=?, content_news=? WHERE id=?";
            $result = $db->pdo_execute($query, $tmptitle_news, $tmpcontent_news, $NewsId);
        } else {
            $query = "UPDATE news SET title_news=?, img_news=?, content_news=? WHERE id=?";
            $result = $db->pdo_execute($query, $tmptitle_news, $tmpimg_news, $tmpcontent_news, $NewsId);
        }

        return $result;
    }




    function deleteNews($id)
    {
        $db = new connect();
        $query = "delete from news where id = '$id'";
        $db->pdo_execute($query);
    }

    public function getNewsById($newsId)
    {
        $db = new connect();
        $select = "SELECT * FROM news WHERE id = ?";
        $result = $db->pdo_query_one($select, $newsId);

        return $result;
    }
    function getNews_user()
    {
        $db = new connect();
        $select = "SELECT news.*, id_user AS id_user FROM news
                   LEFT JOIN users ON news.user_id = id_user";
        return $db->pdo_query($select);
    }
}