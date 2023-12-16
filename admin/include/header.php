<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .sidebar {
        height: 100vh;
        width: 200px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        display: block;
        padding-top: 60px;
        background: linear-gradient(to bottom, #333, #111);
    }

    .offcanvas-header .btn-close {
        z-index: 1000;
        background-color: #fff;
    }

    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background-color: #555;
        color: #fff;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    .navbar {
        background-color: #fff;
        padding: 10px;
    }

    .navbar-brand {
        font-size: 24px;
    }

    body {
        font-family: 'Arial', sans-serif;
    }

    .navbar-brand,
    .sidebar a {
        font-weight: bold;
    }

    .closebtn {
        color: #fff;
        border: none;
        background: none;
        cursor: pointer;
    }

    .closebtn:hover {
        color: #ccc;
    }

    @media screen and (max-height: 450px) {
        .sidebar {
            padding-top: 15px;
        }

        .sidebar a {
            font-size: 16px;
        }
    }

    .navbar-nav li a {
        color: black;
        text-decoration: none;
        padding: 10px 15px;
        display: inline-block;
    }

    .codengu h2 {
        text-align: center;
        padding-top: 70px;
        font-size: 2em;
        font-weight: bold;
        /* Chữ in đậm */

        /* Hiệu ứng màu gradient */
        background: linear-gradient(45deg, #4CAF50, #2196F3);
        /* Thay đổi màu ở đây */
        -webkit-background-clip: text;
        color: transparent;

        /* Hiệu ứng animation */
        animation: glow 2s linear infinite;

        /* Bóng đổ */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* Định nghĩa animation glow */
    @keyframes glow {
        0% {
            text-shadow: 0 0 10px #4CAF50;
            /* Thay đổi màu ở đây */
        }

        50% {
            text-shadow: 0 0 20px #4CAF50;
            /* Thay đổi màu ở đây */
        }

        100% {
            text-shadow: 0 0 10px #4CAF50;
            /* Thay đổi màu ở đây */
        }
    }

    .codengu {
        margin-top: -120px;
        margin-left: 25px;
        width: 100%;
        height: 150px;
    }

    footer {
        width: 100%;
        height: 100px;
        background-color: #2196F3;
    }
    .offcanvas-start {
        top: 0;
        left: 0;
        width: 200px;
        border-right: 1px solid rgba(0,0,0,.2);
        transform: translateX(-100%);
    }
</style>

<body>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
        aria-controls="offcanvasScrolling"><i class="fa fa-bars" aria-hidden="true"></i></button>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
     id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body sidebar">
        <a class="nav-link" href="./index.php?act=home">Trang chủ</a>
        <a class="nav-link" href="./index.php?act=listuser">Tài khoản</a>
        <a class="nav-link" href="./index.php?act=listcate">Danh mục</a>
        <a class="nav-link" href="./index.php?act=listproducts">Sản phẩm</a>
        <!-- <a class="nav-link" href="./index.php?act=listorder">Đơn hàng</a> -->
        <a class="nav-link" href="./index.php?act=listorderonline">Đơn hàng</a>
        <a class="nav-link" href="./index.php?act=listnews">Tin tức</a>
        <a class="nav-link" href="./index.php?act=thongke">Thống Kê</a>
        <a class="nav-link" href="./index.php?act=logout">Đăng Xuất</a>
    </div>
</div>
<div class="codengu">
    <h2>CHÀO MỪNG ĐẾN VỚI TRANG QUẢN TRỊ WEBSITE MIFGOIS</h2>
</div>
<div id="main">
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <!-- <span style="font-size:30px;cursor:pointer" onclick="openNav()">☰</span> &emsp; -->
            <a class="navbar-brand" href="#"><span class="text-warning">Mif</span>Gois</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- lưu thông tin login -->
                    <?php
                    if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
                        $username = $_SESSION['admin'];

                        echo '<li class="nav-item"><a class="nav-link" href="#">Chào mừng: ' . $username . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- <script>
function openNav() {
    document.getElementById("sidebar").style.display = "block";
}

function closeNav() {
    document.getElementById("sidebar").style.display = "none";
}
</script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
if (isset($_SESSION['admin'])) {
    include './include/footer.php';
}
?>