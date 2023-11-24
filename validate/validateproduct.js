
function validateProduct() {
    var priceInput = document.getElementById("price");
    var priceError = document.getElementById("priceError");

    var imageInput = document.getElementById("image");
    var imageError = document.getElementById("imageError");

    // Remove previous error messages
    priceError.textContent = "";
    imageError.textContent = "";

    var price = priceInput.value.trim();

    if (price === "") {
        priceError.textContent = "Giá không được để trống.";
        priceInput.focus();
        return false;
    }

    if (isNaN(price)) {
        priceError.textContent = "Giá phải là một số.";
        priceInput.focus();
        return false;
    }

    // Check if the image field is empty
    if (imageInput.files.length === 0) {
        imageError.textContent = "Hình ảnh không được để trống.";
        imageInput.focus();
        return false;
    }

    return true;
}

function validateUpdateProduct() {
    var priceInput = document.getElementById("price");
    var priceError = document.getElementById("priceError");

    var imageInput = document.getElementById("image");
    var imageError = document.getElementById("imageError");

    // Remove previous error messages
    priceError.textContent = "";
    imageError.textContent = "";

    var price = priceInput.value.trim();

    if (price === "") {
        priceError.textContent = "Giá không được để trống.";
        priceInput.focus();
        return false;
    }

    if (isNaN(price)) {
        priceError.textContent = "Giá phải là một số.";
        priceInput.focus();
        return false;
    }

    // Check if the image field is empty
    if (imageInput.files.length === 0) {
        imageError.textContent = "Hình ảnh không được để trống.";
        imageInput.focus();
        return false;
    }

    return true;
}