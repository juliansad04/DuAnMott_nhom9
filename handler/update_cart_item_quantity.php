<?php
session_start();
include('../admin/include/pdo.php');
include("../admin/carts/carts.php");
include("../admin/cart_items/cart_items.php");
include("../admin/products/products.php");
include('../admin/shopping_cart/shopping_cart.php');
$shoppingCart = new ShoppingCart();

$cartItemId = $_POST['cartItemId'];
$newQuantity = $_POST['newQuantity'];

$shoppingCart->updateCartItemQuantity($cartItemId, $newQuantity);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit(); 
?>