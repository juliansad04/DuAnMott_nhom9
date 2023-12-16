<?php
require './libs/PHPMailer/Exception.php';
require './libs/PHPMailer/PHPMailer.php';
require './libs/PHPMailer/SMTP.php';
require './admin/include/pdo.php';
require './admin/reset_password_temp/reset_password_temp.php';


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['SERVER_NAME'];
$port = $_SERVER['SERVER_PORT'];
$script = $_SERVER['SCRIPT_NAME'];

$basePath = "$protocol://$host";
if (($protocol === 'http' && $port != 80) || ($protocol === 'https' && $port != 443)) {
    $basePath .= ":$port";
}

$basePath .= dirname($script);

if (isset($_POST['send'])) {
    $email = htmlentities($_POST['email']);
    $resetPasswordTemp = new ResetPasswordTemp();

    try {
        $resetPasswordTemp->sendResetEmail($email, $basePath);
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Quên mật khẩu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Quên mật khẩu</h2>
                        <form method="post" action="" class="row g-3">
                            <div class="col-12">
                                <label for="inputEmail" class="form-label">Nhập địa chỉ Email của bạn</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="send" class="btn btn-primary">
                                    Gửi Email <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="./" class="btn btn-secondary">Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-..."
            crossorigin="anonymous"></script>

    </html>
<?php } ?>