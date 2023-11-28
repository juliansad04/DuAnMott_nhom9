<!DOCTYPE html>
<html lang="en-CA">

<head>
    <?php
    include("./includes/head.php");
    include("./admin/online_order/online_order.php");
    include("./admin/online_order_details/online_order_details.php");
    ?>

</head>

<body>
<header>
    <?php
    include('./admin/cart_items/cart_items.php');
    include('./admin/products/products.php');
    include("./includes/header.php");
    include("./admin/shopping_cart/shopping_cart.php");
    ?>
</header>

<div class="container" style="padding: 50px 0">
    <h1>Xin chào <?php echo $_SESSION['username'] ?></h1>

    <h2>Lịch sử mua hàng</h2>
    <?php
    $onlineOrder = new OnlineOrder();
    $onlineOrderDetail = new OnlineOrderDetail();

    $userId = $_SESSION['id'];
    $onlineOrders = $onlineOrder->getOnlineOrdersByUserId($userId);

    $onlineOrders = array_reverse($onlineOrders);

    foreach ($onlineOrders as $order) {
        echo "<div class='card mb-3'>";
        echo "<div class='card-header'>Đơn hàng #" . $order['id'] . " - Ngày đặt: " . $order['order_date'] . "</div>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>Khách hàng: " . $order['customer_name'] . "</h5>";
        echo "<p class='card-text'>Địa chỉ: " . $order['address'] . "</p>";

        $orderId = $order['id'];
        $orderDetails = $onlineOrderDetail->getOnlineOrderDetailsByOrderId($orderId);

        echo "<ul class='list-group'>";
        foreach ($orderDetails as $detail) {
            echo "<li class='list-group-item'>" . $detail['quantity'] . " x " . $detail['product_id'] . " - Thành tiền: " . number_format($detail['total_price'], 2) . "</li>";
        }
        echo "</ul>";

        echo "</div>";
        echo "</div>";
    }
    ?>
</div>
<?php
include("./includes/footer.php");
?>
<?php
include("./includes/linkjs.php");
?>

</html>