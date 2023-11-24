function validateNew() {
    var titleInput = document.getElementById("title_news");
    var contentInput = document.getElementById("content_news");
    var titleError = document.getElementById("titleError");
    var contentError = document.getElementById("contentError");

    // Check if the "Tiêu đề" field is empty
    if (titleInput.value.trim() === "") {
        titleError.textContent = "Tiêu đề không được để trống.";
        titleInput.focus();
        return false;
    } else {
        titleError.textContent = "";
    }

    // Check if the "Nội dung" field is empty
    if (contentInput.value.trim() === "") {
        contentError.textContent = "Nội dung không được để trống.";
        contentInput.focus();
        return false;
    } else {
        contentError.textContent = "";
    }

    return true; // Submit the form if validation passes
}