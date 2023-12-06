function validateForm() {
    var nameInput = document.getElementById("name");
    var nameError = document.getElementById("nameError");

    // Check if the name is empty
    if (nameInput.value.trim() === "") {
        nameError.textContent = "Tên danh mục không được trống, vui lòng nhập lại.";
        nameInput.focus();
        return false;
    } else if (!isNaN(nameInput.value)) {
        // Check if the name contains only numbers
        nameError.textContent = "Tên danh mục không được nhập số, vui lòng nhập lại.";
        nameInput.focus();
        return false;
    } else {
        nameError.textContent = "";
        return true;
    }
}