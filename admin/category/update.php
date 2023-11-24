<?php
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $category = new Category();
    $categoryDetails = $category->getCategoryById($categoryId);

    if ($categoryDetails) {
        $name = $categoryDetails['name'];
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sửa danh mục</title>
            <!-- Thêm link CSS của Bootstrap -->
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>

        <div class="container mt-5" style="margin-left: 100px;">
            <h2 class="mb-4">Sửa danh mục</h2>

            <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="hidden" id="id" name="id" value="<?php echo $categoryId; ?>" required>

                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                    <span id="nameError" style="color: red;"></span>
                </div>

                <a href="index.php?act=listcate" type="button" class="btn btn-danger">Hủy</a>
                <button class="btn btn-primary" name="updateCategory">Sửa</button>

            </form>
        </div>
        <script src="/validate/validatecate.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        </body>

        </html>
        <?php
    } else {
        echo "Danh mục không tồn tại.";
    }
} else {
    echo "Lỗi: Không có ID danh mục được chỉ định.";
}
?>