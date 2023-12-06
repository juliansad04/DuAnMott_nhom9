<form method="post">
    <div class="row">
        <div class="col-2">
            <label for="startDate">Ngày bắt đầu:</label>
            <input type="date" class="form-control" id="startDate" name="startDate">
        </div>
        <div class="col-2">
            <label for="endDate">Ngày kết thúc:</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
        </div>
        <div class="col-2">
            <label for="endDate">Hành động:</label>
            <input type="submit" value="Lọc" class="btn btn-primary form-control"></input>
        </div>
    </div>
</form>
<div class="mt-3">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        if (!empty($startDate) && !empty($endDate)) {
            echo "<h5>Lọc từ ngày $startDate đến ngày $endDate</h5>";
        } else {
            echo "<h5>Hiển thị tất cả</h5>";
        }
    }
    ?>
</div>
<div class="row mt-3">
    <div class="col-3">
        <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">Đơn hàng trực tiếp</div>
            <div class="card-body d-flex align-items-center">
                <i class="fa-solid fa-coins"></i>
                <span class="card-title">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($startDate) && !empty($endDate)) {
                        $startDate = $_POST['startDate'];
                        $endDate = $_POST['endDate'];
                        echo $order->getOrderCountByDateRange($startDate, $endDate);
                    } else {
                        echo $order->getOrderCountByDateRange();
                    }
                    ?>

                </span>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3" style="max-width: 100%;">
            <div class="card-header">Đơn hàng online</div>
            <div class="card-body d-flex align-items-center">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                <span class="card-title">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($startDate) && !empty($endDate)) {
                        $startDate = $_POST['startDate'];
                        $endDate = $_POST['endDate'];
                        echo $orderOnline->getOnlineOrderCountByDateRange($startDate, $endDate);
                    } else {
                        echo $orderOnline->getOnlineOrderCountByDateRange();
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3" style="max-width: 100%;">
            <div class="card-header">Doanh thu đơn hàng trực tiếp</div>
            <div class="card-body d-flex align-items-center">
                <i class="fa-solid fa-truck-fast"></i>
                <span class="card-title">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($startDate) && !empty($endDate)) {
                        $startDate = $_POST['startDate'];
                        $endDate = $_POST['endDate'];

                        $profit = $order->getOrderProfitByDateRange($startDate, $endDate);
                    } else {
                        $profit = $order->getOrderProfitByDateRange();
                    }

                    if ($profit == 0) {
                        $formattedProfit = '0 VND';
                    } else {
                        $formattedProfit = number_format($profit, 0, ',', '.') . ' VND';
                    }

                    echo $formattedProfit;
                    ?>

                </span>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card mb-3" style="max-width: 100%;">
            <div class="card-header">Doanh thu đơn hàng online</div>
            <div class="card-body d-flex align-items-center">
                <i class="fa-solid fa-user-group"></i>
                <span class="card-title">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($startDate) && !empty($endDate)) {
                        $startDate = $_POST['startDate'];
                        $endDate = $_POST['endDate'];

                        $profit = $orderOnline->getOnlineOrderProfitByDateRange($startDate, $endDate);
                    } else {
                        $profit = $orderOnline->getOnlineOrderProfitByDateRange();
                    }

                    if ($profit == 0) {
                        $formattedProfit = '0 VND';
                    } else {

                        $formattedProfit = number_format($profit, 0, ',', '.') . ' VND';
                    }

                    echo $formattedProfit;
                    ?>

                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card mb-3" style="max-width: 100%;">
            <div class="card-header">Số lượng khách hàng</div>
            <div class="card-body d-flex align-items-center">
                <i class="fa-solid fa-truck-fast"></i>
                <span class="card-title">
                    <?php
                    $userCount = $user->getUserCountByRole(0);
                    echo $userCount;
                    ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card mb-3" style="max-width: 100%;">
            <div class="card-header">Số lượng sản phẩm</div>
            <div class="card-body d-flex align-items-center">
                <i class="fa-solid fa-user-group"></i>
                <span class="card-title">
                    <?php
                    $productCount = $product->getProductCount();
                    echo $productCount;
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>