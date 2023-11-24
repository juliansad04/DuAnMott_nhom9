function validateAddUser() {
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    var fullnameInput = document.getElementById("fullname");
    var phoneInput = document.getElementById("phone");

    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");
    var fullnameError = document.getElementById("fullnameError");
    var phoneError = document.getElementById("phoneError");

    // Remove previous error messages
    usernameError.textContent = "";
    passwordError.textContent = "";
    fullnameError.textContent = "";
    phoneError.textContent = "";

    var username = usernameInput.value.trim();
    var password = passwordInput.value.trim();
    var fullname = fullnameInput.value.trim();
    var phone = phoneInput.value.trim();

    // Validate username: should contain letters and numbers
    var usernameRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;
    if (!usernameRegex.test(username)) {
        usernameError.textContent = "Tài khoản phải chứa chữ và số.";
        usernameInput.focus();
        return false;
    }

    // Validate password: should contain letters and numbers
    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
    if (!passwordRegex.test(password)) {
        passwordError.textContent = "Mật khẩu phải chứa chữ và số.";
        passwordInput.focus();
        return false;
    }

    // Validate fullname: should contain letters and accented characters
    var fullnameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
    if (!fullnameRegex.test(fullname)) {
        fullnameError.textContent = "Họ và tên chỉ được chứa chữ và dấu.";
        fullnameInput.focus();
        return false;
    }

    // Validate phone: should start with 0 and have 10 to 13 digits
    var phoneRegex = /^0[0-9]{9,12}$/;
    if (!phoneRegex.test(phone)) {
        phoneError.textContent = "Số điện thoại phải bắt đầu từ số 0 và từ 10 đến 13 số.";
        phoneInput.focus();
        return false;
    }

    return true;
}
function validateUpdateUser() {
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    var fullnameInput = document.getElementById("fullname");
    var emailInput = document.getElementById("email");
    var phoneInput = document.getElementById("phone");

    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");
    var fullnameError = document.getElementById("fullnameError");
    var emailError = document.getElementById("emailError");
    var phoneError = document.getElementById("phoneError");

    // Remove previous error messages
    usernameError.textContent = "";
    passwordError.textContent = "";
    fullnameError.textContent = "";
    emailError.textContent = "";
    phoneError.textContent = "";

    var username = usernameInput.value.trim();
    var password = passwordInput.value.trim();
    var fullname = fullnameInput.value.trim();
    var email = emailInput.value.trim();
    var phone = phoneInput.value.trim();

    // Validate username: should contain letters and numbers
    var usernameRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;
    if (!usernameRegex.test(username)) {
        usernameError.textContent = "Tài khoản phải chứa chữ và số.";
        usernameInput.focus();
        return false;
    }

    // Validate password: should contain letters and numbers
    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
    if (!passwordRegex.test(password)) {
        passwordError.textContent = "Mật khẩu phải chứa chữ và số.";
        passwordInput.focus();
        return false;
    }

    // Validate fullname: should contain letters and accented characters
    var fullnameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
    if (!fullnameRegex.test(fullname)) {
        fullnameError.textContent = "Họ và tên chỉ được chứa chữ và dấu.";
        fullnameInput.focus();
        return false;
    }

    // Validate email: basic email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        emailError.textContent = "Email không hợp lệ.";
        emailInput.focus();
        return false;
    }

    // Validate phone: should start with 0 and have 10 to 13 digits
    var phoneRegex = /^0[0-9]{9,12}$/;
    if (!phoneRegex.test(phone)) {
        phoneError.textContent = "Số điện thoại phải bắt đầu từ số 0 và từ 10 đến 13 số.";
        phoneInput.focus();
        return false;
    }

    return true;
}
