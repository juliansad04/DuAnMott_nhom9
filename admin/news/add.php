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
            <input type="text" class="form-control" id="title_news" name="title_news" >
        </div>
        <div class="form-group">
            <label for="img_news">Hình ảnh</label>
            <input type="file" class="form-control-file" id="img_news" name="img_news" accept="image/*">
        </div>
        <div class="form-group">
            <label for="content_news">Nội dung</label>
            <div id="editor">
            </div>
            <input type="hidden" id="content_news" name="content_news">
        </div>
        <a href="index.php?act=listnews" type="button" class="btn btn-danger">Hủy</a>
        <button class="btn btn-primary" name="addNews">Thêm</button>
    </form>
</div>

<!-- Thêm link JavaScript của Bootstrap (nếu cần) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
<script>
    var options = {
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['link', 'image', 'video'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['blockquote', 'code-block'],
                [{
                    'align': []
                }],
                ['clean']
            ]
        },
        placeholder: 'Nhập mô tả sản phẩm...',
        theme: 'snow'
    };

    var quill = new Quill('#editor', options);
    document.querySelector('form').addEventListener('submit', function() {
        var content_newsn = document.getElementById('content_news');
        content_news.value = quill.root.innerHTML;
    });
</script>

</html>