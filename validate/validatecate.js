
function validateForm() {
    var nameInput = document.getElementById("name");
    var nameError = document.getElementById("nameError");

    if (!isNaN(nameInput.value)) {
        nameError.textContent = "Tên danh mục không được nhập số, vui lòng nhập lại.";
        nameInput.focus();
        return false;
    } else {
        nameError.textContent = "";
        return true;
    }
}
