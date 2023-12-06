// validatenews.js

function validateNew() {
    var titleInput = document.getElementById("title_news");
    var imgInput = document.getElementById("img_news");
    var contentInput = document.getElementById("content_news");
    var titleError = document.getElementById("titleError");
    var imgError = document.getElementById("imgError");
    var contentError = document.getElementById("contentError");

    // Remove previous error messages
    titleError.textContent = "";
    imgError.textContent = "";
    contentError.textContent = "";

    var title = titleInput.value.trim();
    var imgFileName = imgInput.value.trim();  // Only getting the file name, not the entire path
    var content = document.getElementById("editor").innerText.trim();  // Assuming the rich text editor updates the innerText

    var errors = [];

    // Check if the "Tiêu đề" field is empty
    if (title === "") {
        errors.push("Tiêu đề không được để trống.");
        titleError.textContent = "Tiêu đề không được để trống.";
    }

    // Check if the "Hình ảnh" field is empty
    if (imgFileName === "") {
        errors.push("Hình ảnh không được để trống.");
        imgError.textContent = "Hình ảnh không được để trống.";
    }

    // Check if the "Nội dung" field is empty
    if (content === "") {
        errors.push("Nội dung không được để trống.");
        contentError.textContent = "Nội dung không được để trống.";
    }

    if (errors.length > 0) {
        // Display all error messages
        return false;
    }

    return true; // Submit the form if validation passes
}
