<div class="container-fluid" style="margin-left: 25px;">
    <div class="card mt-12" style="width: 1450px;">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Danh sách đơn hàng</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tài khoản</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Ngày đặt hàng</th>
                    <th scope="col" width='45%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listOrderDetail as $order) {
                    echo "<tr>";
                    echo "<td>" . $order['id'] . "</td>";

                    $userId = $order['user_id'];
                    $userOrder = $user->getUserById($userId);
                    $name = $userOrder['username'];
                    echo "<td>" .  $name  . "</td>";
                    echo "<td>" . $order['customer_name'] . "</td>";
                    echo "<td>" . $order['order_date'] . "</td>";

                    echo "<td class='d-flex justify-content-evenly'>";
                    echo "<a href='./index.php?act=listorderonlinedetail&id=" . $order['id'] . "' class='btn btn-info text-white'>Xem thông tin chi tiết</a>";

                    echo "<form method='POST' class='d-inline-flex align-items-center'>";
                    echo "<select name='status' class='form-select form-select-sm selectpicker'>";
                    $statusOptions = array(
                        "Chưa xác nhận",
                        "Đã xác nhận",
                        "Chuẩn bị giao hàng",
                        "Đang giao hàng",
                        "Thành công"
                    );

                    foreach ($statusOptions as $statusOption) {
                        $selected = ($statusOption == $order['status']) ? "selected" : "";
                        echo "<option value='$statusOption' $selected>$statusOption</option>";
                    }
                    echo "<input type='hidden' name='orderId' value='" . $order['id'] . "'>";
                    echo "<button type='submit' name='updateOrderOnline' class='w-100 ml-2 btn btn-primary'>Cập nhật</button>";
                    echo "</select>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>