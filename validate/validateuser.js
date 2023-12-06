function displayError(input, errorMessage) {
    var errorElement = document.getElementById(input.id + "Error");
    if (errorElement) {
        errorElement.textContent = errorMessage;
    }
}

function validateAddUser() {
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    var fullnameInput = document.getElementById("fullname");
    var phoneInput = document.getElementById("phone");
    var emailInput = document.getElementById("email");

    // Remove previous error messages
    displayError(usernameInput, "");
    displayError(passwordInput, "");
    displayError(fullnameInput, "");
    displayError(phoneInput, "");
    displayError(emailInput, "");

    var username = usernameInput.value.trim();
    var password = passwordInput.value.trim();
    var fullname = fullnameInput.value.trim();
    var phone = phoneInput.value.trim();
    var email = emailInput.value.trim();

    var errors = [];

    // Check for empty fields
    if (username === "") {
        errors.push("Tài khoản không được trống");
        displayError(usernameInput, "Tài khoản không được trống");
    }

    if (password === "") {
        errors.push("Mật khẩu không được trống");
        displayError(passwordInput, "Mật khẩu không được trống");
    }

    if (fullname === "") {
        errors.push("Họ và tên không được trống.");
        displayError(fullnameInput, "Họ và tên không được trống");
    }

    if (phone === "") {
        errors.push("Số điện thoại không được trống");
        displayError(phoneInput, "Số điện thoại không được trống");
    }

    if (email === "") {
        errors.push("Email không được trống.");
        displayError(emailInput, "Email không được trống");
    }

    if (errors.length > 0) {
        // Display all error messages
        return false;
    }

    // Validate email: should have a valid format
    var emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email)) {
        errors.push("Email phải nhập đúng định dạng");
        displayError(emailInput, "Email phải nhập đúng định dạng");
    }

    // Validate username: should contain letters and numbers
    var usernameRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;
    if (!usernameRegex.test(username)) {
        errors.push("Tài khoản phải chứa chữ và số.");
        displayError(usernameInput, "Tài khoản phải chứa chữ và số");
    }

    // Validate password: should contain letters and numbers
    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
    if (!passwordRegex.test(password)) {
        errors.push("Mật khẩu phải chứa chữ và số");
        displayError(passwordInput, "Mật khẩu phải chứa chữ và số");
    }

    // Validate fullname: should contain letters and accented characters
    var fullnameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
    if (!fullnameRegex.test(fullname)) {
        errors.push("Họ và tên chỉ được chứa chữ và dấu");
        displayError(fullnameInput, "Họ và tên chỉ được chứa chữ và dấu");
    }

    // Validate phone: should start with 0 and have 10 to 13 digits
    var phoneRegex = /^0[0-9]{9,12}$/;
    if (!phoneRegex.test(phone)) {
        errors.push("Số điện thoại phải là số, bắt đầu từ số 0 và từ 10 đến 13 số");
        displayError(phoneInput, "Số điện thoại phải là số, bắt đầu từ số 0 và từ 10 đến 13 số");
    }

    if (errors.length > 0) {
        // Display all error messages
        return false;
    }

    return true;
}
function validateUpdateUser() {
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    var fullnameInput = document.getElementById("fullname");
    var phoneInput = document.getElementById("phone");
    var emailInput = document.getElementById("email");

    // Remove previous error messages
    displayError(usernameInput, "");
    displayError(passwordInput, "");
    displayError(fullnameInput, "");
    displayError(phoneInput, "");
    displayError(emailInput, "");

    var username = usernameInput.value.trim();
    var password = passwordInput.value.trim();
    var fullname = fullnameInput.value.trim();
    var phone = phoneInput.value.trim();
    var email = emailInput.value.trim();

    var errors = [];

    // Check for empty fields
    if (username === "") {
        errors.push("Tài khoản không được trống.");
        displayError(usernameInput, "Tài khoản không được trống.");
    }

    if (password === "") {
        errors.push("Mật khẩu không được trống.");
        displayError(passwordInput, "Mật khẩu không được trống.");
    }

    if (fullname === "") {
        errors.push("Họ và tên không được trống.");
        displayError(fullnameInput, "Họ và tên không được trống.");
    }

    if (phone === "") {
        errors.push("Số điện thoại không được trống.");
        displayError(phoneInput, "Số điện thoại không được trống.");
    }

    if (email === "") {
        errors.push("Email không được trống.");
        displayError(emailInput, "Email không được trống.");
    }

    if (errors.length > 0) {
        // Display all error messages
        return false;
    }

    // Validate email: should have a valid format
    var emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email)) {
        errors.push("Email không được trống và phải có định dạng đúng.");
        displayError(emailInput, "Email không được trống và phải có định dạng đúng.");
    }

    // Validate username: should contain letters and numbers
    var usernameRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;
    if (!usernameRegex.test(username)) {
        errors.push("Tài khoản phải chứa chữ và số.");
        displayError(usernameInput, "Tài khoản phải chứa chữ và số.");
    }

    // Validate password: should contain letters and numbers
    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
    if (!passwordRegex.test(password)) {
        errors.push("Mật khẩu phải chứa chữ và số.");
        displayError(passwordInput, "Mật khẩu phải chứa chữ và số.");
    }

    // Validate fullname: should contain letters and accented characters
    var fullnameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
    if (!fullnameRegex.test(fullname)) {
        errors.push("Họ và tên chỉ được chứa chữ và dấu.");
        displayError(fullnameInput, "Họ và tên chỉ được chứa chữ và dấu.");
    }

    // Validate phone: should start with 0 and have 10 to 13 digits
    var phoneRegex = /^0[0-9]{9,12}$/;
    if (!phoneRegex.test(phone)) {
        errors.push("Số điện thoại phải bắt đầu từ số 0 và từ 10 đến 13 số.");
        displayError(phoneInput, "Số điện thoại phải bắt đầu từ số 0 và từ 10 đến 13 số.");
    }

    if (errors.length > 0) {
        // Display all error messages
        return false;
    }

    return true;
}
