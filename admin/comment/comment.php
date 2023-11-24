<?php

class Comment
{
    var $id = null;
    var $product_id = null;
    var $user_id = null;
    var $comment = null;
    var $comment_date = null;

    function getComments()
    {
        $db = new connect();
        $select = "SELECT * FROM product_comments";
        return $db->pdo_query($select);
    }

    function insertComment($product_id, $user_id, $comment, $comment_date)
    {
        $db = new connect();
        $query = "INSERT INTO product_comments(id, product_id, user_id, comment, comment_date) VALUES (NULL, ?, ?, ?, ?)";

        $newCommentId = $db->pdo_execute($query, $product_id, $user_id, $comment, $comment_date);
        echo "Inserted comment with ID: " . $newCommentId;
    }

    function updateComment($commentId, $product_id, $user_id, $comment, $comment_date)
    {
        $db = new connect();
        $query = "UPDATE product_comments SET product_id=?, user_id=?, comment=?, comment_date=? WHERE id=?";
        $result = $db->pdo_execute($query, $product_id, $user_id, $comment, $comment_date, $commentId);
        return $result;
    }

    function deleteComment($commentId)
    {
        $db = new connect();
        $query = "DELETE FROM product_comments WHERE id = ?";
        $db->pdo_execute($query, $commentId);
    }

    function getCommentById($commentId)
    {
        $db = new connect();
        $select = "SELECT * FROM product_comments WHERE product_id=?";
        $result = $db->pdo_query($select, $commentId);
        return $result;
    }
}
?>