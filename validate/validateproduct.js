function validateProduct() {
    var nameInput = document.getElementById("name");
    var descriptionInput = document.getElementById("description");
    var priceInput = document.getElementById("price");
    var imageInput = document.getElementById("image");

    var nameError = document.getElementById("nameError");
    var descriptionError = document.getElementById("descriptionError");
    var priceError = document.getElementById("priceError");
    var imageError = document.getElementById("imageError");

    // Remove previous error messages
    nameError.textContent = "";
    descriptionError.textContent = "";
    priceError.textContent = "";
    imageError.textContent = "";

    var name = nameInput.value.trim();
    var description = descriptionInput.value.trim();
    var price = priceInput.value.trim();

    var errors = [];

    // Check if the "Tên sản phẩm" field is empty
    if (name === "") {
        errors.push("Tên sản phẩm không được để trống.");
        nameError.textContent = "Tên sản phẩm không được để trống.";
    }

    // Check if the "Mô tả" field is empty
    if (description === "") {
        errors.push("Mô tả không được để trống.");
        descriptionError.textContent = "Mô tả không được để trống.";
    }

    // Check if the "Giá" field is empty
    if (price === "") {
        errors.push("Giá không được để trống.");
        priceError.textContent = "Giá không được để trống.";
    }

    if (isNaN(price)) {
        errors.push("Giá phải là  số.");
        priceError.textContent = "Giá phải là số.";
    }

    // Check if the image field is empty
    if (imageInput.files.length === 0) {
        errors.push("Hình ảnh không được để trống.");
        imageError.textContent = "Hình ảnh không được để trống.";
    }

    if (errors.length > 0) {
        // Display all error messages
        return false;
    }

    return true;
}

// Example of usage in your HTML form:
// <form onsubmit="return validateProduct();">
//    <!-- Your form fields and error placeholders go here -->
//    <button type="submit">Submit</button>
// </form>
