<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới tin tức</title>
    <!-- Thêm link CSS của Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="margin-left: 100px;">
    <h2 class="mb-4">Thêm tin</h2>

    <form method="post" enctype="multipart/form-data" onsubmit="return validateNew()">
        <div class="form-group">
            <label for="title_news">Tiêu đề</label>
            <input type="text" class="form-control" id="title_news" name="title_news" required>
            <span id="titleError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label for="img_news">Hình ảnh</label>
            <input type="file" class="form-control-file" id="img_news" name="img_news" accept="image/*">
        </div>
        <div class="form-group">
            <label for="content_news">Nội dung</label>
            <input type="text" class="form-control" id="content_news" name="content_news">
            <span id="contentError" style="color: red;"></span>
        </div>
        <a href="index.php?act=listnews" type="button" class="btn btn-danger">Hủy</a>
        <button class="btn btn-primary" name="addNews">Thêm</button>
    </form>
</div>
<script src="/validate/validatenews.js"></script>
<!-- Thêm link JavaScript của Bootstrap (nếu cần) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới tin tức</title>
    <!-- Thêm link CSS của Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="margin-left: 100px;">
    <h2 class="mb-4">Thêm tin</h2>

    <form method="post" enctype="multipart/form-data" onsubmit="return validateNew()">
        <div class="form-group">
            <label for="title_news">Tiêu đề</label>
            <input type="text" class="form-control" id="title_news" name="title_news" required>
            <span id="titleError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label for="img_news">Hình ảnh</label>
            <input type="file" class="form-control-file" id="img_news" name="img_news" accept="image/*">
        </div>
        <div class="form-group">
            <label for="content_news">Nội dung</label>
            <input type="text" class="form-control" id="content_news" name="content_news">
            <span id="contentError" style="color: red;"></span>
        </div>
        <a href="index.php?act=listnews" type="button" class="btn btn-danger">Hủy</a>
        <button class="btn btn-primary" name="addNews">Thêm</button>
    </form>
</div>
<script src="/validate/validatenews.js"></script>
<!-- Thêm link JavaScript của Bootstrap (nếu cần) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>