<div>
    <div class="card mt-12">
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
                    <th scope="col">Phương thức thanh toán</th>
                    <th scope="col">Ngày đặt hàng</th>
                    <th scope="col" width='45%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listOrderDetail as $order) {
                    echo "<tr>";
                    echo "<tr style='background-color: #fff;'>";
                    echo "<td>" . $order['id'] . "</td>";

                    $userId = $order['user_id'];
                    $userOrder = $user->getUserById($userId);
                    $name = $userOrder['username'];
                    echo "<td>" .  $name  . "</td>";
                    echo "<td>" . $order['customer_name'] . "</td>";
                    echo "<td>" . $order['payment_method'] . "</td>";
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusSelects = document.getElementsByName('status');
        var updateButtons = document.getElementsByName('updateOrderOnline');

        // Iterate through all sets of elements
        for (var i = 0; i < statusSelects.length; i++) {
            var statusSelect = statusSelects[i];
            var updateButton = updateButtons[i];

            // Lưu trạng thái ban đầu để so sánh sau khi cập nhật
            var initialStatus = statusSelect.value;

            // Store the initial status separately for each order
            statusSelect.dataset.initialStatus = initialStatus;

            updateButton.addEventListener('click', function() {
                // Update the initial status only when the update button is clicked
                var currentStatusSelect = this.parentNode.querySelector('[name="status"]');
                currentStatusSelect.dataset.initialStatus = currentStatusSelect.value;
            });

            statusSelect.addEventListener('change', function() {
                var selectedStatus = this.value;
                var initialStatus = this.dataset.initialStatus;

                // Kiểm tra và chỉ cho phép cập nhật nếu trạng thái thay đổi theo quy tắc
                if (!canUpdateStatus(initialStatus, selectedStatus)) {
                    alert('Không thể chọn lại trạng thái đã được chọn!');
                    this.value = initialStatus; // Đặt lại trạng thái ban đầu
                }
            });
        }
    });

    // Hàm kiểm tra có thể cập nhật trạng thái hay không
    function canUpdateStatus(initialStatus, selectedStatus) {
        var statusMap = {
            'Chưa xác nhận': 0,
            'Đã xác nhận': 1,
            'Chuẩn bị giao hàng': 2,
            'Đang giao hàng': 3,
            'Thành công': 4
        };

        return statusMap[selectedStatus] >= statusMap[initialStatus];
    }
</script>