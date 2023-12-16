<?php ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["id"])) {
    // Người dùng đã đăng nhập, gửi trạng thái đăng nhập vào JavaScript
    echo '<script>var userLoggedIn = true;</script>';
} else {
    // Người dùng chưa đăng nhập, không gửi trạng thái đăng nhập vào JavaScript
    echo '<script>var userLoggedIn = false;</script>';
}
?>


<?php
include("./admin/include/pdo.php");
include("./admin/users/user.php");
include("./admin/category/category.php");
include("./admin/carts/carts.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["Name"];
    $password = $_POST["Password"];

    $user = new User();
    $result = $user->checkUser($username, $password);

    if ($result) {
        $_SESSION["id"] = $result['id'];
        $_SESSION["username"] = $result['username'];

        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Đăng nhập thành công',
                    showConfirmButton: true,
                }).then(() => {
                    window.location.href = './'; 
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Tên đăng nhập hoặc mật khẩu không đúng',
                    showConfirmButton: true,
                    footer: 'Nếu quên mật khẩu, bấm vào <a href=\"quenmatkhau.php\"><strong>đây</strong></a> để lấy lại mật khẩu'
                });
              </script>";
    }
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Retrieve form data
    $username = trim($_POST["Name"]);
    $email = trim($_POST["Email"]);
    $password = trim($_POST["Password"]);
    $confirmPassword = trim($_POST["ConfirmPassword"]);


    $user = new user();
    $userId = $user->registerUser($username, $password, $username, $email, null, null, null);
    if ($userId) {
        $cart = new Cart();
        $createdAt = date("Y-m-d H:i:s");
        $cartId = $cart->createCart($userId, $createdAt);

        if ($cartId) {
            $_SESSION['registerSuccess'] = "Đăng kí tài khoản thành công";
            header("Location: ./");
            exit();
        } else {
            $user->deleteUser($userId);
            echo "Lỗi khi tạo giỏ hàng";
        }
    } else {
        echo "Lỗi khi tạo tài khoản";
    }
    exit();
}

function isValidUsername($username) {
    $length = strlen($username);
    if ($length < 4 || $length > 20) {
        return false;
    }
    if (!ctype_alnum($username)) {
        return false;
    }
    return true;
}
?>

<?php if (!empty($_SESSION['registerSuccess'])) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: '<?php echo $_SESSION['registerSuccess']; ?>',
            showConfirmButton: true,
        }).then(() => {
            window.location.href = './';
            <?php unset($_SESSION['registerSuccess']); ?>
        });
    </script>
<?php endif; ?>

<div class="header_top_menu">
    <div class="header_top_menu_all">
        <div class="header_top">
            <div class="bg_in">
                <div class="logo">
                    <a href="."><img src="img/logo.png" width="150px" height="80px" alt="logohere.jpeg" /></a>
                </div>
                <nav class="menu_top">

                </nav>
                <div class="cart_wrapper">
                    <div class="col_50">
                        <div class="hot_line_top">
                            <br />

                            <div class="col-lg-12 header-right mt-lg-0 mt-2">
                                <!-- header lists -->

                                <?php
                                if (isset($_SESSION["username"])) {
                                    $username = $_SESSION["username"];
                                    echo "<div class='flex-container'>";
                                    echo "<a href='taikhoan.php' class='flex-container'>";
                                    echo "<i class='fa fa-user' aria-hidden='true'></i>";
                                    echo "<span>" . $username . "</span>";
                                    echo "</a>";
                                    echo "<a href='./includes/logout.php'>Đăng xuất</a>";
                                    echo "</div>";
                                } else {
                                    echo "<ul><li class='text-center border-right text-white'><a href='#' data-toggle='modal' data-target='#exampleModal' class='text-white'>Đăng nhập |</a></li><li class='text-center text-white'><a href='#' data-toggle='modal' data-target='#exampleModal2' class='text-white'>Đăng ký</a></li></ul>";
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="btn_menu_search">
        <div class="bg_in">
            <div class="table_row_search">
                <div class="menu_top_cate">
                    <div class="">
                        <div class="menu" id="menu_cate">
                            <div class="menu_left">
                                <i class="fa fa-bars" aria-hidden="true"></i> Danh mục sản phẩm
                            </div>
                            <div class="cate_pro">
                                <div id='cssmenu_flyout' class="display_destop_menu">
                                    <ul>
                                        <?php
                                        $category = new Category();
                                        $categories = $category->getCategory();

                                        foreach ($categories as $cat) {
                                            ?>
                                            <li class='active has-sub'>
                                                <a
                                                        href='sanpham.php?cate=<?php echo $cat['id']; ?>'><span><?php echo $cat['name']; ?></span></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="search_top">
                    <div id='cssmenu'>
                        <ul>
                            <li class='active'><a href='index.php'>Trang chủ</a></li>
                            <li class=''><a href='chitiettin.php'>Giới thiệu</a></li>
                            <li class=''>

                                <a href='sanpham.php'>Sản phẩm</a>

                                <ul>


                                </ul>
                            </li>

                            <li class=''><a href='tintuc.php'>Tin tức</a></li>
                            <li class=''><a href='lienhe.php'>Liên hệ</a></li>
                            <li class=''><a href='giohang.php'>Giỏ hàng</a></li>
                            <form class="search_form" method="get" action="">
                                <input class="searchTerm" name="search" placeholder="Nhập từ cần tìm..." />
                                <button class="searchButton" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- log in -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <label class="col-form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" placeholder=" " name="Name" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder=" " name="Password" required="">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" name="login" value="Log in">
                    </div>
                    <!-- <div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
								<label class="custom-control-label" for="customControlAutosizing">Lưu mật khẩu?</label>
							</div>
						</div> -->
                    <p class="text-center dont-do mt-3" style="color:black">Không có tài khoản |
                        <a href="#" data-toggle="modal" data-target="#exampleModal2">
                            Đăng ký ngay</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- register -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng ký</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label class="col-form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control registerName" placeholder=" " name="Name">
                        <span style="color: red;" class="error-message" id="name-error"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="email" class="form-control registerEmail" placeholder=" " name="Email">
                        <span style="color: red;" class="error-message" id="email-error"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control registerPass" placeholder=" " name="Password"
                               id="password1">
                        <span style="color: red;" class="error-message" id="password-error"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control registerConfirmPass" placeholder=" "
                               name="ConfirmPassword" id="password2">
                        <span style="color: red;" class="error-message" id="confirm-password-error"></span>
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="Register" name="register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var inactivityTime = 0;
    var logoutTime = 120; // thời gian đăng xuất sau 10 giây không hoạt động (có thể thay đổi)

    function resetTimer() {
        inactivityTime = 0;
    }

    function checkInactivity() {
        inactivityTime++;
        if (userLoggedIn && inactivityTime >= logoutTime) {
            // Thực hiện đăng xuất chỉ khi người dùng đã đăng nhập
            Swal.fire({
                icon: 'info',
                title: 'Tự động đăng xuất',
                text: 'Bạn đã được đăng xuất do không hoạt động.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = './includes/logout.php';
            });
        }
    }

    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keydown', resetTimer);
    document.addEventListener('click', resetTimer);
    document.addEventListener('scroll', resetTimer);

    setInterval(checkInactivity, 1000); // Kiểm tra mỗi giây
</script>

<script>
    function validateForm() {
        // Reset previous error messages
        document.getElementById('name-error').innerText = '';
        document.getElementById('email-error').innerText = '';
        document.getElementById('password-error').innerText = '';
        document.getElementById('confirm-password-error').innerText = '';

        var username = document.querySelector('.registerName').value;
        var email = document.querySelector('.registerEmail').value;
        var password = document.querySelector('.registerPass').value;
        var confirmPassword = document.querySelector('.registerConfirmPass').value;

        var isValid = true;

        if (username.trim() === '') {
            document.getElementById('name-error').innerText = 'Vui lòng nhập tên đăng nhập.';
            isValid = false;
        } else if (!isValidUsername(username)) {
            document.getElementById('name-error').innerText = 'Tên đăng nhập phải chứa ít nhất 5 ký tự, bao gồm ít nhất 1 chữ cái và 1 số.';
            isValid = false;
        }

        if (email.trim() === '') {
            document.getElementById('email-error').innerText = 'Vui lòng nhập địa chỉ email.';
            isValid = false;
        }

        if (password.trim() === '') {
            document.getElementById('password-error').innerText = 'Vui lòng nhập mật khẩu.';
            isValid = false;
        } else if (!isValidPassword(password)) {
            document.getElementById('password-error').innerText = 'Mật khẩu phải chứa ít nhất 5 ký tự, bao gồm ít nhất 1 chữ cái và 1 số.';
            isValid = false;
        }

        if (confirmPassword.trim() === '') {
            document.getElementById('confirm-password-error').innerText = 'Vui lòng xác nhận mật khẩu.';
            isValid = false;
        }

        if (password !== confirmPassword) {
            document.getElementById('confirm-password-error').innerText = 'Mật khẩu và xác nhận mật khẩu không khớp.';
            isValid = false;
        }

        return isValid;
    }

    function isValidUsername(username) {
        // Username must be at least 5 characters and contain at least 1 letter and 1 number
        var usernameRegex = /^(?=.*[A-Za-z])(?=.*\d).{5,}$/;
        return usernameRegex.test(username);
    }

    function isValidPassword(password) {
        // Password must contain at least one letter and one number
        var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d).{5,}$/;
        return passwordRegex.test(password);
    }


</script>