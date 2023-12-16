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


    $customerName = $_POST['txtHoTen'];
    $customerPhone = $_POST['txtDienThoai'];
    $customerAddress = $_POST['txtDiaChi'];
    $customerEmail = $_POST['txtEmail'];
    $customerNote = $_POST['txtNoiDung'];

    $timezone = 'Asia/Ho_Chi_Minh';
    date_default_timezone_set($timezone);
    $orderDate = date("Y-m-d H:i:s");

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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order_online'])) {
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

    $totalPrice = 0;
    foreach ($cartDetails['details'] as $cartItem) {
        $productId = $cartItem['product_id'];
        $quantity = $cartItem['quantity'];

        $product = new Product();
        $productInfo = $product->getProductById($productId);

        $totalPrice += $productInfo['price'] * $quantity;
    }

    $customerName = $_POST['txtHoTen'];
    $customerPhone = $_POST['txtDienThoai'];
    $customerAddress = $_POST['txtDiaChi'];
    $customerEmail = $_POST['txtEmail'];
    $customerNote = $_POST['txtNoiDung'];

    $_SESSION['customer_info'] = [
        'name' => $customerName,
        'phone' => $customerPhone,
        'address' => $customerAddress,
        'email' => $customerEmail,
        'note' => $customerNote
    ];

    $timezone = 'Asia/Ho_Chi_Minh';
    date_default_timezone_set($timezone);

    $_SESSION['order_info'] = [
        'userId' => $userId,
        'cartDetails' => $cartDetails,
        'customerName' => $_POST['txtHoTen'],
        'customerPhone' => $_POST['txtDienThoai'],
        'customerAddress' => $_POST['txtDiaChi'],
        'customerEmail' => $_POST['txtEmail'],
        'customerNote' => $_POST['txtNoiDung'],
        'orderDate' => date("Y-m-d H:i:s"),
        'totalPrice' => $totalPrice
    ];

    header("Location: thanh_toan_online.php");
    exit();
}