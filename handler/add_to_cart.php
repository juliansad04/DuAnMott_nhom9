<?php
session_start();
include('../admin/include/pdo.php');
include('../admin/cart_items/cart_items.php');
include('../admin/carts/carts.php');
include('../admin/products/products.php');
include('../admin/shopping_cart/shopping_cart.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['id'];
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    $shoppingCart = new ShoppingCart();
    $shoppingCart->addToCart($userId, $productId, $quantity);

}
?>