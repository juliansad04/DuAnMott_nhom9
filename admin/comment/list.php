<div>
    <div class="card mt-12">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Danh sách Bình luận</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Sản phẩm</th>
                    <th scope="col">Người dùng</th>
                    <th scope="col">Bình luận</th>
                    <th scope="col">Ngày bình luận</th>
                    <th scope="col" class="text-center" width='15%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (is_array($listComments)) {
                    foreach ($listComments as $comment) {
                        echo "<tr>";
                        echo "<td>" . $comment['id'] . "</td>";

                        $productId = $comment['product_id'];
                        $product = new Product();
                        $productDetails = $product->getProductById($productId);
                        $productName = ($productDetails) ? $productDetails['name'] : "Không xác định";
                        echo "<td>" . $productName . "</td>";

                        $userId = $comment['user_id'];
                        $user = new User();
                        $userDetails = $user->getUserById($userId);
                        $username = ($userDetails) ? $userDetails['username'] : "Không xác định";
                        echo "<td>" . $username . "</td>";

                        echo "<td>" . $comment['comment'] . "</td>";
                        echo "<td>" . $comment['comment_date'] . "</td>";
                        echo "<td class='text-center'>";
                        echo "<a href='./index.php?act=deletecomment&id=". $_GET['id'] ."&idcmt=". $comment['id'] . "' class='btn btn-danger text-white'>Xoá</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có bình luận.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>