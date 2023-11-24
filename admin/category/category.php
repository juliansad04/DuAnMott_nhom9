<?php
class Category
{
    var $id = null;
    var $name = null;

    function getCategory()
    {
        $db = new connect();
        $select = "select * from category";
        return $db->pdo_query($select);
    }

    public function checkCategory($id, $name)
    {
        $db = new connect();
        $select = "select * from category where id='$id' and name='$name'";
        $result = $db->pdo_query_one($select);
        if ($result != null) {
            return true;
        } else {
            return false;
        }
    }

    public function getInfoById($id)
    {
        $db = new connect();
        $select = "select * from category where id='$id'";
        $result = $db->pdo_query($select);
        return $result;
    }

    function insertCategory($tmpId, $tmpName)
    {
        $db = new connect();
        $query = "INSERT INTO category(id, name) VALUES ('$tmpId', '$tmpName')";
        $db->pdo_execute($query);
    }

    function updateCategory($tmpId, $tmpName)
    {
        $db = new connect();
        $query = "update category set name='$tmpName' where id='$tmpId'";
        $db->pdo_execute($query);
    }

    function deleteCategory($id)
    {
        $db = new connect();
        $query = "delete from category where id = '$id'";
        $db->pdo_execute($query);
    }
    public function getCategoryById($categoryId)
    {
        $db = new connect();
        $select = "SELECT * FROM category WHERE id=?";
        $result = $db->pdo_query_one($select, $categoryId);
        return $result;
    }
}