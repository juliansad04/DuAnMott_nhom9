<div class="container-fluid" style="margin-left: 25px;">
    <div class="card mt-12" style="width: 1450px;">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>User</h4>
            <a href="index.php?act=adduser" class="btn btn-success"><img
                    src="../admin/content/images/add-plus-svgrepo-com.svg" alt="">THÊM</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Username</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phân quyền</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col" width='15%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listuser as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['username'] . "</td>";
                    echo "<td>" . $user['fullname'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . ($user['role'] == 1 ? "Admin" : "User") . "</td>";

                    // Check if an avatar exists
                    if (!empty($user['avatar'])) {
                        $avatar = "./uploads/" . $user['avatar'];
                        echo "<td style='text-align: center;'><img src='" . $avatar . "' height='35'></td>";
                    } else {
                        echo "<td style='text-align: center;'>Không có hình</td>";
                    }

                    echo "<td>" . $user['address'] . "</td>";
                    echo "<td>" . $user['phone'] . "</td>";
                    echo "<td class='d-flex justify-content-evenly'>";
                    echo "<a href='./index.php?act=updateuser&id=". $user['id'] ."' class='btn btn-info text-white'>Sửa</a>";
                    echo "<button type='button' onclick='confirmDelete(" . $user['id'] . ")' class='btn btn-danger text-white'>Xoá</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>


                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Bạn chắc chắn muốn xoá?',
            text: 'Hành động này sẽ xoá vĩnh viễn dữ liệu (Đơn hàng, Bình luận sản phẩm) của Tài Khoản này!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xoá!',
            cancelButtonText: 'Không, hủy bỏ'
        }).then((result) => {
            if (result.value) {
                window.location.href = './index.php?act=deleteuser&id=' + id;
            }
        });
    }
</script>