<?php

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $product = new Product();
    $productDetails = $product->getProductById($productId);

    if ($productDetails) {
        $name = $productDetails['name'];
        $description = $productDetails['description'];
        $price = $productDetails['price'];
        $category_id = $productDetails['category_id'];

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Cập nhật sản phẩm</title>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>

        <div class="container mt-5">
            <h2 class="mb-4">Cập nhật sản phẩm</h2>

            <form method="post" enctype="multipart/form-data" onsubmit="return validateProduct()">
                <input type="hidden" id="id" name="id" value="<?php echo $productId; ?>">

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                    <span id="nameError" style="color: red;"></span>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                    ><?php echo $description; ?></textarea>
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
                            $selected = ($categoryId == $category_id) ? 'selected' : '';
                            echo "<option value='$categoryId' $selected>$categoryName</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                    <span id="priceError" style="color: red;"></span>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                    <span id="imageError" style="color: red;"></span>
                </div>

                <a href="index.php?act=listproducts" type="button" class="btn btn-danger">Hủy</a>
                <button class="btn btn-primary" name="updateProduct">Cập nhật</button>

            </form>
            <script src="/validate/validateproduct.js"></script>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        </body>

        </html>

        <?php
    } else {
        echo "Sản phẩm không tồn tại.";
    }
} else {
    echo "Lỗi: Không có ID sản phẩm được chỉ định.";
}
?>