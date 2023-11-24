<div class="container-fluid" style="margin-left: 25px;">
    <div class="card mt-12" style="width: 1450px;">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>News</h4>
            <a href="index.php?act=addnews" class="btn btn-success"><img src="../admin/content/images/add-plus-svgrepo-com.svg" alt="">THÊM</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col" width='15%'>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listnews as $news) {
                    echo "<tr>";
                    echo "<td>" . $news['id'] . "</td>";
                    echo "<td>" . $news['title_news'] . "</td>";
                    // Check if an img news exists
                    if (!empty($news['img_news'])) {
                        $img_path = "./uploads/" . $news['img_news'];
                        echo "<td><img src='" . $img_path . "' height='20'></td>";
                    } else {
                        echo "<td>Không có hình</td>";
                    }

                    echo "<td>" . $news['content_news'] . "</td>";
                    echo "<td class='d-flex justify-content-evenly'>";
                    echo "<a href='./index.php?act=updatenews&id=". $news['id'] ."' class='btn btn-info text-white'>Sửa</a>";
                    echo "<button type='button' onclick='confirmDelete(" . $news['id'] . ")' class='btn btn-danger text-white'>Xoá</button>";
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
            text: 'Hành động này sẽ xoá vĩnh viễn dữ liệu của tin tức này!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xoá!',
            cancelButtonText: 'Không, hủy bỏ'
        }).then((result) => {
            if (result.value) {
                window.location.href = './index.php?act=deletenews&id=' + id;
            }
        });
    }
</script>