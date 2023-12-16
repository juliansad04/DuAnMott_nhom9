<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Enough Quantity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <div class="alert alert-danger">
        <h4 class="alert-heading">Không đủ số lượng!</h4>
        <p>
            <?php
            if (isset($_GET['error_message'])) {
                $error_message = urldecode($_GET['error_message']);
                echo $error_message;
            } else {
                echo "Có lỗi xảy ra khi xử lý đơn hàng.";
            }
            ?>
        </p>
        <hr>
        <p class="mb-0">Vui lòng quay lại và thử lại.</p>
    </div>
    <div class="text-center mt-3">
        <a href="../" class="btn btn-secondary">Quay lại trang chủ</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>