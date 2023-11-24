<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới đơn hàng</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5" style="margin-left: 100px;">
    <h2 class="mb-4">Thêm đơn hàng</h2>

    <form method="post" enctype="multipart/form-data" id="orderForm">
        <div class="form-group">
            <label for="user_id">Người tạo đơn</label>
            <input type="text" class="form-control" readonly
                   value="<?php echo isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; ?>">
        </div>

        <input type="hidden" class="form-control" id="user_id" name="user_id"
               value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">

        <div class="form-group">
            <label for="customer_name">Tên khách hàng</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name">
        </div>

        <div class="form-group">
            <label for="order_date">Ngày mua hàng</label>
            <input type="datetime-local" class="form-control" id="order_date" name="order_date"
                   value="<?php echo date('Y-m-d\TH:i'); ?>" required>
        </div>

        <div class="form-group">
            <label for="products">Sản phẩm</label>
            <select multiple class="form-control" id="products" name="products[]">
                <?php
                foreach ($listproducts as $product) {
                    echo "<option value='" . $product['id'] . "' data-name='" . $product['name'] . "' data-price='" . $product['price'] . "'>" . $product['name'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div id="selectedProducts">
            <h4>Danh sách sản phẩm đã chọn:</h4>
            <ul id="selectedProductList"
                style="display: flex; flex-direction: column; gap: 10px; list-style: none;"></ul>
            <p id="totalPrice">Tổng tiền: 0</p>
        </div>

        <input type="hidden" id="selectedProductsInput" name="selectedProducts">

        <button type="button" class="btn btn-primary" id="addToCart">Thêm vào giỏ hàng</button>

        <a href="index.php?act=listorder" type="button" class="btn btn-danger">Hủy</a>

        <button class="btn btn-primary" name="addOrder" onclick="submitForm()">Thêm</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    document.getElementById('addToCart').addEventListener('click', function() {
        var selectedProducts = document.getElementById('products');
        var selectedProductList = document.getElementById('selectedProductList');
        var totalPriceElement = document.getElementById('totalPrice');
        var totalPrice = parseFloat(totalPriceElement.textContent.replace('Tổng tiền: ', ''));

        for (var i = 0; i < selectedProducts.options.length; i++) {
            if (selectedProducts.options[i].selected) {
                var productId = selectedProducts.options[i].value;
                var productName = selectedProducts.options[i].getAttribute('data-name');
                var productPrice = parseFloat(selectedProducts.options[i].getAttribute('data-price'));
                var quantityInput = document.getElementById('quantity_' + productId);
                var quantity = 1;

                if (quantityInput) {
                    quantity = parseInt(quantityInput.value);
                    if (isNaN(quantity)) {
                        quantity = 1;
                    }
                }

                var existingItem = document.getElementById('item_' + productId);
                if (existingItem) {

                    var existingQuantity = parseInt(existingItem.getAttribute('data-quantity'));
                    existingQuantity += quantity;
                    existingItem.setAttribute('data-quantity', existingQuantity);
                    existingItem.innerHTML = productName + ' - Giá: ' + productPrice + ' - Số lượng: ' +
                        existingQuantity + ' <button class="btn btn-danger btn-sm ml-2" onclick="xoaSanPham(' +
                        productId + ')">Xóa</button>';


                    if (!isNaN(productPrice) && !isNaN(quantity)) {
                        totalPrice += productPrice * quantity;
                    }
                } else {

                    var listItem = document.createElement('li');
                    listItem.setAttribute('id', 'item_' + productId);
                    listItem.setAttribute('data-quantity', quantity);
                    listItem.innerHTML = productName + ' - Giá: ' + productPrice + ' - Số lượng: ' + quantity +
                        ' <button class="btn btn-danger btn-sm ml-2" onclick="xoaSanPham(' + productId +
                        ')">Xóa</button>';

                    selectedProductList.appendChild(listItem);


                    if (!isNaN(productPrice) && !isNaN(quantity)) {
                        totalPrice += productPrice * quantity;
                    }
                }
            }
        }


        if (!isNaN(totalPrice)) {
            totalPriceElement.textContent = 'Tổng tiền: ' + totalPrice.toFixed(2);
        }


        updateHiddenInput();
    });

    function xoaSanPham(productId) {
        var listItem = document.getElementById('item_' + productId);
        if (listItem) {
            var quantity = parseInt(listItem.getAttribute('data-quantity'));
            var productPrice = parseFloat(listItem.textContent.split(' - Giá: ')[1].split(' - Số lượng: ')[0]);

            listItem.remove();

            var totalPriceElement = document.getElementById('totalPrice');
            var totalPrice = parseFloat(totalPriceElement.textContent.replace('Tổng tiền: ', ''));

            if (!isNaN(productPrice) && !isNaN(quantity)) {
                totalPrice -= productPrice * quantity;
                totalPriceElement.textContent = 'Tổng tiền: ' + totalPrice.toFixed(2);
            }


            updateHiddenInput();
        }
    }

    function updateHiddenInput() {
        var selectedProducts = [];


        for (var i = 0; i < selectedProductList.children.length; i++) {
            var listItem = selectedProductList.children[i];
            var productId = listItem.id.replace('item_', '');
            var quantity = parseInt(listItem.getAttribute('data-quantity'));

            selectedProducts.push({
                productId: productId,
                quantity: quantity
            });
        }

        document.getElementById('selectedProductsInput').value = JSON.stringify(selectedProducts);
    }

    function submitForm() {

        updateHiddenInput();


        document.getElementById('orderForm').submit();
    }
</script>

</body>

</html>