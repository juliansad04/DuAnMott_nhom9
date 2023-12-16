<?php
session_start();
include("../admin/include/pdo.php");
include('../admin/products/products.php');
include("../admin/carts/carts.php");
include("../admin/cart_items/cart_items.php");
include("../admin/online_order/online_order.php");
include("../admin/online_order_details/online_order_details.php");
include('../admin/shopping_cart/shopping_cart.php');
if (isset($_GET['message']) && $_GET['message'] === 'Successful.') {
    $userId = $_SESSION['id'];
    $shoppingCart = new ShoppingCart();
    $cartDetails = $shoppingCart->getCartWithDetailsById($userId);

    foreach ($cartDetails['details'] as $cartItem) {
        echo $cartItem['quantity'];
        $productId = $cartItem['product_id'];
        $quantityInCart = $cartItem['quantity'];

        $product = new Product();
        $productInfo = $product->getProductById($productId);
        $quantityInDatabase = $productInfo['quantity'];
        $productName = $productInfo['name'];

        if ($quantityInCart > $quantityInDatabase) {
            $error_message = urlencode("Sản phẩm $productName không đủ số lượng. Số lượng hiện tại: $quantityInDatabase");
            header("Location: not_enough_quantity.php?error_message=$error_message");
            exit();
        }
    }
    $customerInfo = $_SESSION['customer_info'];

    $name = $customerInfo['name'];
    $phone = $customerInfo['phone'];
    $address = $customerInfo['address'];
    $email = $customerInfo['email'];
    $note = $customerInfo['note'];

    $orderDate = date("Y-m-d H:i:s");

    $cart = new Cart();
    $objCart = $cart->getCartByUserId($userId);
    $order = new OnlineOrder();
    $orderId = $order->createOnlineOrder($userId, $orderDate, $name, $address,  $phone, $email, $note, 'Thanh toán online');

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

    header('Location: ./dat-hang-thanh-cong.php');
} else {
    echo 'Thanh toán thất bại';
}