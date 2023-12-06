<div class="container mt-5">
    <h2 class="mb-4">Thêm tin</h2>

    <form method="post" enctype="multipart/form-data" onsubmit="return validateNew()">
        <div class="form-group">
            <label for="title_news">Tiêu đề</label>
            <input type="text" class="form-control" id="title_news" name="title_news">
            <span id="titleError" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="img_news">Hình ảnh</label>
            <input type="file" class="form-control-file" id="img_news" name="img_news" accept="image/*">
            <span id="imgError" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="content_news">Nội dung</label>
            <div id="editor"></div>
            <input type="hidden" id="content_news" name="content_news">
            <span id="contentError" class="text-danger"></span>
        </div>
        <a href="index.php?act=listnews" type="button" class="btn btn-danger">Hủy</a>
        <button class="btn btn-primary" name="addNews">Thêm</button>
    </form>
    <script src="/validate/validatenews.js"></script>
</div>