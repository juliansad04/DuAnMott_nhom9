<?php
session_start();
include('../admin/include/pdo.php');
include('../admin/carts/carts.php');
include('../admin/cart_items/cart_items.php');
include('../admin/products/products.php');
include('../admin/shopping_cart/shopping_cart.php');
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    $shoppingCart = new ShoppingCart();

    $shoppingCart->removeFromCart($itemId);

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();

} else {

    echo "Thiếu tham số 'id' trong yêu cầu.";
}

?>