<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5" style="margin-left: 100px;">
    <h2 class="mb-4">Thêm mới sản phẩm</h2>

    <form method="post" enctype="multipart/form-data" onsubmit="return validateProduct()">
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name">
            <span id="nameError" style="color: red;"></span>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            <span id="descriptionError" style="color: red;"></span>
        </div>

        <div class="form-group">
            <label for="category">Danh mục sản phẩm</label>
            <select class="form-control" id="category" name="category">
                <?php
                $category = new Category();
                $categories = $category->getCategory();

                foreach ($categories as $cat) {
                    $categoryId = $cat['id'];
                    $categoryName = $cat['name'];
                    echo "<option value='$categoryId'>$categoryName</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" id="price" name="price">
            <span id="priceError" style="color: red;"></span>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            <span id="imageError" style="color: red;"></span>
        </div>

        <a href="index.php?act=listproducts" type="button" class="btn btn-danger">Hủy</a>
        <button class="btn btn-primary" name="addProduct">Thêm</button>
    </form>
    <script src="/validate/validateproduct.js"></script>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>