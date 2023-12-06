<?php
if (is_array($listOrderDetail)) {
    ?>
    <div>
        <div class="card mt-12">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Chi tiết đơn hàng</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($listOrderDetail as $order) {
                        echo "<tr>";
                        echo "<td>" . $order['id'] . "</td>";

                        $productId = $order['product_id'];
                        $product = new Product();
                        $productDetails = $product->getProductById($productId);
                        $productName = ($productDetails) ? $productDetails['name'] : "Không xác định";
                        echo "<td>" . $productName . "</td>";

                        echo "<td>" . $order['quantity'] . "</td>";
                        echo "<td>" . number_format($productDetails['price'], 2) . "</td>";

                        $totalPrice = floatval($order['total_price']);
                        echo "<td>" . number_format($totalPrice, 2) . "</td>";
                        echo "</tr>";
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<div class='container mt-5'>";
    echo "<div class='alert alert-info' role='alert'>";
    echo "Không có chi tiết đơn hàng.";
    echo "</div>";
    echo "</div>";
}
?>