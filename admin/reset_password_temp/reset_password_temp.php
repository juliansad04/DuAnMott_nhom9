<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ResetPasswordTemp
{
    private $db;

    public function __construct()
    {
        $this->db = new Connect();
    }

    public function sendResetEmail($email, $basePath)
    {
        $user = $this->getUserByEmail($email);

        if (!$user) {
            throw new Exception("Không có người dùng nào được đăng ký với địa chỉ email này!");
        }

        $key = md5(2418 * 2 . $email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $addKey;

        $expDate = date("Y-m-d H:i:s", strtotime('+1 day'));

        $this->db->pdo_execute(
            "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
            VALUES (?, ?, ?);",
            $email,
            $key,
            $expDate
        );

        $this->sendEmail($email, $key, $basePath);
    }

    private function getUserByEmail($email)
    {
        $select = "SELECT * FROM `users` WHERE email=?";
        return $this->db->pdo_query_one($select, $email);
    }

    public function deleteResetInfo($email)
    {
        $this->db->pdo_execute(
            "DELETE FROM `password_reset_temp` WHERE `email`=?;",
            $email
        );
    }

    private function sendEmail($email, $key, $basePath)
    {
        $output = '<p>Xin chào,</p>';
        $output .= '<p>Vui lòng nhấp vào đường link sau để đặt lại mật khẩu của bạn.</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="' . $basePath . '/resetmatkhau.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
            reset-password.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p>Vui lòng đảm bảo sao chép toàn bộ đường link vào trình duyệt của bạn.
            Đường link sẽ hết hạn sau 1 ngày vì lý do bảo mật.</p>';
        $output .= '<p>Nếu bạn không yêu cầu email đặt lại mật khẩu này, không cần thực hiện thêm hành động gì.
            Mật khẩu của bạn sẽ không bị đặt lại. Tuy nhiên, bạn có thể muốn đăng nhập vào tài khoản
            và thay đổi mật khẩu bảo mật của mình để đảm bảo an toàn.</p>';
        $output .= '<p>Cảm ơn,</p>';
        $output .= '<p>Shop Mifgois</p>';
        $body = $output;
        $subject = "Khoi phuc mat khau - mifgois.com";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nguyenphuocthanh1904@gmail.com';
        $mail->Password = 'bipv ibye ernu uhfe';
        $mail->Port = 587;
        $mail->SMTPSecure = 'TLS';
        $mail->isHTML(true);
        $mail->From = 'nguyenphuocthanh1904@gmail.com';
        $mail->FromName = 'Mifgois';
        $mail->Sender = 'noreply@yourwebsite.com';
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email);

        try {
            $mail->send();
            echo "
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
            <div class='container mt-5'>
                <div class='alert alert-success'>
                    <p>Một email đã được gửi đến bạn với hướng dẫn về cách đặt lại mật khẩu của bạn.</p>
                </div>
                <div class='text-center mt-3'>
                    <a href='./' class='btn btn-secondary'>Quay lại trang chủ</a>
                </div>
            </div>
            <br /><br /><br />";
        } catch (Exception $e) {
            echo "Lỗi gửi email: " . $mail->ErrorInfo;
        }
    }
    public function processPasswordReset()
    {
        $error = "";

        if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])) {
            $key = $_GET["key"];
            $email = $_GET["email"];
            $curDate = date("Y-m-d H:i:s");
            $query = $this->db->pdo_query(
                "SELECT * FROM `password_reset_temp` WHERE `key`=? and `email`=?;",
                $key,
                $email
            );

            if (count($query) == 0) {
                $error .= '<h2>Liên kết Không Hợp lệ</h2>
                    <p>Liên kết không hợp lệ hoặc đã hết hạn. Bạn có thể đã không sao chép đúng liên kết từ email hoặc đã sử dụng key trước đó, khiến nó bị vô hiệu hóa.</p>
                    <p><a href="quenmatkhau.php">Nhấn vào đây</a> để đặt lại mật khẩu.</p>';
            } else {
                $row = $query[0];
                $expDate = $row['expDate'];
                if ($expDate >= $curDate) {
                    echo '<br />
                        <form method="post" action="./handler/reset-password-process.php" name="update">
                            <input type="hidden" name="action" value="update" />
                            <div class="mb-3">
                                <label for="pass1" class="form-label"><strong>Nhập Mật Khẩu Mới:</strong></label>
                                <input type="password" class="form-control" id="pass1" name="pass1" maxlength="15" required />
                            </div>
                            <div class="mb-3">
                                <label for="pass2" class="form-label"><strong>Nhập Lại Mật Khẩu Mới:</strong></label>
                                <input type="password" class="form-control" id="pass2" name="pass2" maxlength="15" required />
                            </div>
                            <input type="hidden" name="email" value="' . $email . '" />
                            <button type="submit" class="btn btn-primary">Reset Mật Khẩu</button>
                        </form>';
                } else {
                    $error .= "<h2>Liên kết Hết Hạn</h2>
                        <p>Liên kết đã hết hạn. Bạn đang cố gắng sử dụng liên kết đã hết hạn, chỉ có giá trị trong vòng 24 giờ (1 ngày sau khi yêu cầu).<br /><br /></p>";
                }
            }
            if ($error != "") {
                echo "<div class='alert alert-danger'>" . $error . "</div><br />";
            }
        }
    }
    public function updatePassword($email, $pass1, $pass2)
    {
        $error = "";
        $curDate = date("Y-m-d H:i:s");

        if ($pass1 != $pass2) {
            $error .= "<p>Mật khẩu không trùng khớp, vui lòng nhập lại.</p>";
        }

        if ($error != "") {
            echo "<div class='error'>" . $error . "</div><br />";
        } else {
            $this->db->pdo_execute(
                "UPDATE `users` SET `password`=? WHERE `email`=?;",
                $pass1,
                $email
            );
            $this->deleteResetInfo($email);

            echo '<div class="container"><div class="alert alert-success mt-3">
            <p class="mb-0">Chúc mừng! Mật khẩu của bạn đã được cập nhật thành công.</p>
            <p><a href="../" class="btn btn-success mt-3">Đăng nhập ngay</a></p>
            </div></div>';
        }
    }
}