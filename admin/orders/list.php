<div>
    <div class="card mt-12">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Danh sách đơn hàng</h4>
            <a href="index.php?act=addorder" class="btn btn-success">THÊM</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Người tạo đơn</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Ngày đặt hàng</th>
                    <th scope="col" width='35%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listOrders as $order) {
                    echo "<tr>";
                    echo "<td>" . $order['id'] . "</td>";

                    $userId = $order['user_id'];

                    $userOrder = $user->getUserById($userId);
                    $name = $userOrder['username'];
                    echo "<td>" . $name . "</td>";
                    echo "<td>" . $order['customer_name'] . "</td>";

                    echo "<td>" . $order['order_date'] . "</td>";
                    echo "<td class='d-flex justify-content-evenly'>";
                    echo "<a href='./index.php?act=listorderdetail&id=" . $order['id'] . "' class='btn btn-info text-white'>Xem thông tin chi tiết</a>";
                    echo "<a href='./index.php?act=updateorder&id=" . $order['id'] . "' class='btn btn-warning text-white'>Cập nhật</a>";
                    echo "<a href='./index.php?act=deleteorder&id=" . $order['id'] . "' class='btn btn-danger text-white'>Xoá</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>