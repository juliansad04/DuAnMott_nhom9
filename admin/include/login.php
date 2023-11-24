<div class="row justify-content-center">
    <div class="col-md-6 text-center mb-5">
        <h2 class="font-weight-bold heading-section">Đăng nhập hệ thống quản trị</h2>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-10">
        <div class="wrap d-md-flex">
            <div class="img" style="background-image: url(./content/images/logo_admin2.png);"></div>
            <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                    <div class="w-100">
                        <h3 class="mb-4">Đăng nhập</h3>
                    </div>
                    <div class="w-100">
                        <p class="social-media d-flex justify-content-end">
                            <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </p>
                    </div>
                </div>
                <form role="form" method="POST">
                    <div class="form-group mb-3">
                        <label class="label" for="username">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="password">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Đăng
                            nhập</button>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-50 text-left">
                            <label class="checkbox-wrap checkbox-primary mb-0">
                                Remember Me
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";
$user = new User();

if ($username == "" || $password == "") {
    $_SESSION['message'] = 'Bạn phải nhập đủ thông tin';
} elseif ($userInfo = $user->checkUser($username, $password)) {
    $_SESSION['admin'] = $username;
    $_SESSION['user_id'] = $userInfo['id'];
    header("Location: index.php?act=home");
} else {
    $_SESSION['message'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
}
?>