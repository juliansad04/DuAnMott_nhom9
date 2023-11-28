
<div class="container-fluid" style="margin-left: 25px;">
    <div class="card mt-12" style="width: 1450px;">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 >Danh mục</h4>
            <a href="index.php?act=addcate" class="btn btn-success">THÊM</a>
        </div>
        <div class="card-body"  >
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col" class="text-center" width='15%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listcate as $cate) {
                    echo "<tr>";
                    echo "<td>" . $cate['id'] . "</td>";
                    echo "<td>" . $cate['name'] . "</td>";
                    echo "<td class='text-center'>";
                    echo "<a href='./index.php?act=updatecate&id=". $cate['id'] . "' class='btn btn-info text-white'>Sửa</a>";
                    echo "<button type='button' onclick='confirmDelete(" . $cate['id'] . ")' class='btn btn-danger text-white'>Xoá</button>";
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
            text: 'Hành động này sẽ xoá vĩnh viễn dữ liệu các sản phẩm liên quan đến danh mục!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xoá!',
            cancelButtonText: 'Không, hủy bỏ'
        }).then((result) => {
            if (result.value) {
                window.location.href = './index.php?act=deletecate&id=' + id;

            }else{

            }
        });
    }
</script>


