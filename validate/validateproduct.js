function validateProduct() {
    var nameInput = document.getElementById("name");
    var descriptionInput = document.getElementById("description");
    var priceInput = document.getElementById("price");
    var imageInput = document.getElementById("image");
    var quantityInput = document.getElementById("quantity");

    var nameError = document.getElementById("nameError");
    var descriptionError = document.getElementById("descriptionError");
    var priceError = document.getElementById("priceError");
    var imageError = document.getElementById("imageError");
    var quantityError = document.getElementById("quantityError");

    // Remove previous error messages
    nameError.textContent = "";
    descriptionError.textContent = "";
    priceError.textContent = "";
    imageError.textContent = "";
    quantityError.textContent = "";

    var name = nameInput.value.trim();
    var description = descriptionInput.value.trim();
    var price = priceInput.value.trim();
    var quantity = quantityInput.value.trim();

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
    } else if (isNaN(price) || parseFloat(price) < 0) {
        errors.push("Giá không được nhập số âm.");
        priceError.textContent = "Giá không được nhập số âm.";
    }

    // Check if the "Số lượng" field is empty
    if (quantity === "") {
        errors.push("Số lượng không được để trống.");
        quantityError.textContent = "Số lượng không được để trống.";
    } else if (isNaN(quantity) || parseInt(quantity) < 0) {
        errors.push("Số lượng phải là số dương.");
        quantityError.textContent = "Số lượng phải là số dương.";
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


function validateudProduct() {
    var nameInput = document.getElementById("name");
    var descriptionInput = document.getElementById("description");
    var priceInput = document.getElementById("price");
    var imageInput = document.getElementById("image");
    var quantityInput = document.getElementById("quantity");

    var nameError = document.getElementById("nameError");
    var descriptionError = document.getElementById("descriptionError");
    var priceError = document.getElementById("priceError");
    var imageError = document.getElementById("imageError");
    var quantityError = document.getElementById("quantityError");

    // Remove previous error messages
    nameError.textContent = "";
    descriptionError.textContent = "";
    priceError.textContent = "";
    imageError.textContent = "";
    quantityError.textContent = "";

    var name = nameInput.value.trim();
    var description = descriptionInput.value.trim();
    var price = priceInput.value.trim();
    var quantity = quantityInput.value.trim();

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
    } else if (isNaN(price) || parseFloat(price) < 0) {
        errors.push("Giá không được nhập số âm.");
        priceError.textContent = "Giá không được nhập số âm.";
    }

    // Check if the "Số lượng" field is empty
    if (quantity === "") {
        errors.push("Số lượng không được để trống.");
        quantityError.textContent = "Số lượng không được để trống.";
    } else if (isNaN(quantity) || parseInt(quantity) < 0) {
        errors.push("Số lượng phải là số dương.");
        quantityError.textContent = "Số lượng phải là số dương.";
    }

    // Check if the image field is empty
    if (imageInput.files.length === 0 && !document.getElementById("id").value) {
        errors.push("Hình ảnh không được để trống.");
        imageError.textContent = "Hình ảnh không được để trống.";
    }

    if (errors.length > 0) {
        // Display all error messages
        return false;
    }

    return true;
}
