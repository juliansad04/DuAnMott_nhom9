<?php
session_start();
include("../admin/include/pdo.php");
include('../admin/products/products.php');
include("../admin/carts/carts.php");
include("../admin/cart_items/cart_items.php");
include("../admin/online_order/online_order.php");
include("../admin/online_order_details/online_order_details.php");
include('../admin/shopping_cart/shopping_cart.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {

    $customerName = $_POST['txtHoTen'];
    $customerPhone = $_POST['txtDienThoai'];
    $customerAddress = $_POST['txtDiaChi'];
    $customerEmail = $_POST['txtEmail'];
    $customerNote = $_POST['txtNoiDung'];
    
    $userId = $_SESSION['id'];
    $orderDate = date("Y-m-d H:i:s");

    $shoppingCart = new ShoppingCart();
    $cartDetails = $shoppingCart->getCartWithDetailsById($userId);

    $cart = new Cart();
    $objCart = $cart->getCartByUserId($userId);


    $order = new OnlineOrder();
    $orderId = $order->createOnlineOrder($userId, $orderDate, $customerName, $customerAddress,  $customerPhone, $customerEmail, $customerNote);

    foreach ($cartDetails['details'] as $cartItem) {
        $productId = $cartItem['product_id'];
        $quantity = $cartItem['quantity'];

        $product = new Product();
        $productInfo = $product->getProductById($productId);

        $totalPrice = $productInfo['price'] * $quantity;

        $orderDetail = new OnlineOrderDetail();
        $orderDetail->createOnlineOrderDetail($orderId, $productId, $quantity, $totalPrice);
    }

    $shoppingCart->clearCart($objCart['id']);

    header("Location: order_success.php");
    exit();
}

?>