<?php
session_start();
include('../admin/include/pdo.php');
include('../admin/comment/comment.php');
$comment = new Comment();

if (isset($_POST['post_comment'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['id'];
    $comment_text = $_POST['comment'];
    $comment_date = date("Y-m-d H:i:s");
    $comment->insertComment($product_id, $user_id, $comment_text, $comment_date);
}

header("Location: ../chitietsp.php?id=$product_id");
exit();
?>