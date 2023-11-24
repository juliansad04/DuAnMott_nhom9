<div class="container-fluid" style="margin-left: 25px;">
    <div class="card mt-12" style="width: 1450px;">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Danh sách sản phẩm</h4>
            <a href="index.php?act=addproduct" class="btn btn-success"><img
                    src="../admin/content/images/add-plus-svgrepo-com.svg" alt="">THÊM</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col" style="width: 450px;">Mô tả</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col" width='25%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $product = new Product();
                $listProducts = $product->getProducts();

                foreach ($listProducts as $product) {
                    echo "<tr>";
                    echo "<td>" . $product['id'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['description'] . "</td>";
                    echo "<td>" . number_format($product['price'], 0, '', '.') . " VND</td>";
                    if (!empty($product['image'])) {
                        $image = "./uploads/" . $product['image'];
                        echo "<td style='text-align: center; vertical-align: middle;'><img src='" . $image . "' height='50'></td>";
                    } else {
                        echo "<td style='text-align: center; vertical-align: middle;'>Không có hình</td>";
                    }

                    echo "<td class='d-flex justify-content-evenly'>";
                    echo "<a href='./index.php?act=updateproduct&id=". $product['id'] ."' class='btn btn-info text-white'>Sửa</a>";
                    echo "<button type='button' onclick='confirmDelete(" . $product['id'] . ")' class='btn btn-danger text-white'>Xoá</button>";
                    echo "<a href='./index.php?act=listcomment&id=". $product['id'] ."' class='btn btn-primary text-white'>Xem bình luận</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
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
            text: 'Hành động này sẽ xoá vĩnh viễn dữ liệu sản phẩm này và bình luận!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xoá!',
            cancelButtonText: 'Không, hủy bỏ'
        }).then((result) => {
            if (result.value) {
                window.location.href = './index.php?act=deleteproduct&id=' + id;
            }
        });
    }
</script>