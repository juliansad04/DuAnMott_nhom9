<?php session_start();
ob_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <title>Login Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../admin/content/css/style.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</head>

<body>
<?php
?>
<section class="ftco-section">
    <div class="container">
        <?php
        include './include/pdo.php';
        include './users/user.php';
        include './category/category.php';
        include './products/products.php';
        include './comment/comment.php';
        include './orders/order.php';
        include './order_detail/order_detail.php';
        include './news/news.php';
        include './online_order/online_order.php';
        include './online_order_details/online_order_details.php';
        include './carts/carts.php';
        include './thongke/thongke.php';
        $action = 'home';
        if (isset($_GET['act'])) {
            $action = $_GET['act'];
        }
        if (!isset($_SESSION['admin'])) {
            $action = "login";
        }
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            include "./include/header.php";
        }
        switch ($action) {
            // home
            case 'home':
                if (isset($_SESSION['admin'])) {
                    include './include/home.php';
                }
                break;
            // login
            case 'login':
                include './include/login.php';
                break;
            //logout
            case 'logout':
                session_destroy();
                header("Location: index.php?act=login");
                break;
            // danh mục
            case 'listcate':
                $cate = new Category();
                $listcate = $cate->getCategory();
                include './category/list.php';
                break;
            case 'addcate':
                if (isset($_POST['addcate'])) {
                    $newName = $_POST['name'];
                    $cate = new Category();
                    $cate->insertCategory(null, $newName);
                    $listcate = $cate->getCategory();
                    header("Location: index.php?act=listcate");
                } else {
                    include './category/add.php';
                }
                break;
            case 'updatecate':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateCategory'])) {
                    $id = $_POST['id'];
                    $newName = $_POST['name'];

                    $cate = new Category();
                    $cate->updateCategory($id, $newName);
                    header("Location: index.php?act=listcate");
                } else {
                    include './category/update.php';
                }
                break;
            case 'deletecate':
                if (isset($_GET['id'])) {
                    $cate = new Category();
                    $mess = $cate->deleteCategory($_GET['id']);
                }
                header("Location: index.php?act=listcate&mess=" . $mess);
                break;
            case 'listuser':
                $user = new user();
                $listuser = $user->getUser();
                include './users/list.php';
                break;
            case 'adduser':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addUser'])) {
                    $tmpusername = $_POST['username'];
                    $tmppassword = $_POST['password'];
                    $tmpname = $_POST['fullname'];
                    $tmpemail = $_POST['email'];
                    $tmpavatar = $_FILES['avatar']['name'];
                    $tmpaddress = $_POST['address'];
                    $tmpphone = $_POST['phone'];

                    $upload_dir = './uploads/';
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_dir . $tmpavatar);

                    $user = new user();
                    $user->insertUser($tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone, $_POST['role']);
                    header("Location: index.php?act=listuser");
                } else {
                    include './users/add.php';
                }
                break;
            case 'updateuser':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
                    $userId = $_POST['userId'];
                    $tmpusername = $_POST['username'];
                    $tmppassword = $_POST['password'];
                    $tmpname = $_POST['fullname'];
                    $tmpemail = $_POST['email'];
                    $tmpavatar = $_FILES['avatar']['name'];
                    $tmpaddress = $_POST['address'];
                    $tmpphone = $_POST['phone'];

                    $upload_dir = './uploads/';
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_dir . $tmpavatar);

                    $user = new user();
                    $user->updateUser($userId, $tmpusername, $tmppassword, $tmpname, $tmpemail, $tmpavatar, $tmpaddress, $tmpphone, $_POST['role']);
                    header("Location: index.php?act=listuser");
                } else {
                    include './users/update.php';
                }
                break;
            case 'deleteuser':
                if (isset($_GET['id'])) {
                    try {
                        $user = new user();
                        $mess = $user->deleteUser($_GET['id']);
                        header("Location: index.php?act=listuser&mess=" . $mess);
                    } catch (Exception $e) {
                        header("Location: index.php?act=listuser&mess=Không được phép xóa tài khoản do dữ liệu vẫn còn trong hệ thống");
                    };
                }
                break;
            // news
            case 'listnews':
                $news = new news();
                $user = new user();
                $listnews = $news->getNews();
                include './news/list.php';
                break;
            case 'addnews':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addNews'])) {
                    $tmptitle_news = $_POST['title_news'];
                    $tmpimg_news = $_FILES['img_news']['name'];

                    $upload_dir = './uploads/';
                    move_uploaded_file($_FILES['img_news']['tmp_name'], $upload_dir . $tmpimg_news);
                    $tmpcontent_news = $_POST['content_news'];
                    $news = new news();
                    $news->insertNews($tmptitle_news, $tmpimg_news, $tmpcontent_news, $_SESSION["user_id"]);
                    header("Location: index.php?act=listnews");
                } else {
                    include './news/add.php';
                }
                break;
            case 'updatenews':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateNews'])) {
                    $newsId = $_POST['newsId'];
                    $tmptitle_news = $_POST['title_news'];
                    $tmpimg_news = $_FILES['img_news']['name'];
                    $tmpcontent_news = $_POST['content_news'];

                    $upload_dir = './uploads/';
                    move_uploaded_file($_FILES['img_news']['tmp_name'], $upload_dir . $tmpimg_news);

                    $news = new news();
                    $news->updateNews($newsId, $tmptitle_news, $tmpimg_news, $tmpcontent_news);
                    header("Location: index.php?act=listnews");
                } else {
                    include './news/update.php';
                }
                break;
            case 'deletenews':
                if (isset($_GET['id'])) {
                    $news = new news();
                    $news->deleteNews($_GET['id']);
                }
                header("Location: index.php?act=listnews");
                break;
            //product
            case 'listproducts':
                $products = new Product();
                $listproducts = $products->getProducts();
                include './products/list.php';
                break;
            case 'addproduct':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addProduct'])) {
                    $tmpName = $_POST['name'];
                    $tmpDescription = $_POST['description'];
                    $tmpPrice = $_POST['price'];
                    $tmpImage = $_FILES['image']['name'];
                    $categoryId = $_POST['category'];

                    $upload_dir = './uploads/';
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $tmpImage);

                    $product = new Product();
                    $product->insertProduct($tmpName, $tmpDescription, $tmpPrice, $tmpImage, $categoryId);
                    header("Location: index.php?act=listproducts");
                } else {
                    include './products/add.php';
                }
                break;
            case 'updateproduct':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProduct'])) {
                    $tmpId = $_POST['id'];
                    $tmpName = $_POST['name'];
                    $tmpDescription = $_POST['description'];
                    $tmpPrice = $_POST['price'];
                    $tmpImage = $_FILES['image']['name'];
                    $categoryId = $_POST['category'];
                    $upload_dir = './uploads/';
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $tmpImage);

                    $product = new Product();
                    $product->updateProduct($tmpId, $tmpName, $tmpDescription, $tmpPrice, $tmpImage, $categoryId);
                    header("Location: index.php?act=listproducts");
                } else {
                    include './products/update.php';
                }
                break;
            case 'deleteproduct':
                if (isset($_GET['id'])) {
                    try {
                        $product = new Product();
                        $product->deleteProduct($_GET['id']);
                        header("Location: index.php?act=listproducts");
                    } catch (Exception $e) {
                        header("Location: index.php?act=listproducts&mess=Không được phép xóa sản phẩm do dữ liệu vẫn còn trong hệ thống");
                    };
                }
                break;
            case 'listcomment':
                if (isset($_GET['id'])) {
                    $comment = new Comment();
                    $listComments = $comment->getCommentById($_GET['id']);
                    include './comment/list.php';
                }
                break;
            case 'deletecomment':
                if (isset($_GET['id']) && isset($_GET['idcmt'])) {
                    $comment = new Comment();
                    $comment->deleteComment($_GET['idcmt']);
                    header("Location: index.php?act=listcomment&id=" . $_GET['id']);
                }
                break;
            case 'listorder':
                $order = new Order();
                $user = new user();

                $listOrders = $order->getAllOrders();
                include './orders/list.php';
                break;
            case 'addorder':
                $order = new Order();
                $orderDetail = new OrderDetail();
                $products = new Product();
                $listproducts = $products->getProducts();

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addOrder'])) {

                    $customer_name = $_POST["customer_name"];
                    $order_date = $_POST["order_date"];
                    $user_id = $_POST["user_id"];
                    $products_json = $_POST["selectedProducts"];
                    $selectedProducts = json_decode($products_json, true);


                    $orderId = $order->createOrder($user_id, $order_date, $customer_name);

                    if ($orderId) {

                        foreach ($selectedProducts as $product) {
                            $productId = $product['productId'];
                            $quantity = $product['quantity'];

                            $productInfo = $products->getProductById($productId);

                            $totalPrice = $quantity * $productInfo['price'];

                            $orderDetail->createOrderDetail($orderId, $productId, $quantity, $totalPrice);
                        }

                        echo "Đã thêm đơn hàng thành công!";
                        header("Location: index.php?act=listorder");
                    } else {
                        echo "Có lỗi khi thêm đơn hàng!";
                    }
                }

                include './orders/add.php';
                break;
            case 'deleteorder':
                if (isset($_GET['id'])) {
                    $order = new Order();
                    $order->deleteOrder($_GET['id']);
                }
                header("Location: index.php?act=listorder");
                break;
            case 'updateorder':
                if (isset($_GET['id'])) {
                    $order = new Order();
                    $orderDetail = new OrderDetail();
                    $products = new Product();
                    $listproducts = $products->getProducts();
                    $orderInfo = $order->getOrderById($_GET['id']);
                    $ListOrderDetail = $orderDetail->getOrderDetailById($orderInfo['id']);
                    include './orders/update.php';

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editOrder'])) {

                        if (
                            isset($_POST["customer_name"]) &&
                            isset($_POST["order_date"]) &&
                            isset($_POST["user_id"]) &&
                            isset($_POST["selectedProducts"])
                        ) {

                            $customer_name = $_POST["customer_name"];
                            $order_date = $_POST["order_date"];
                            $user_id = $_POST["user_id"];
                            $products_json = $_POST["selectedProducts"];
                            $selectedProducts = json_decode($products_json, true);

                            $order->deleteOrder($_GET['id']);

                            $orderId = $order->createOrder($user_id, $order_date, $customer_name);

                            if ($orderId) {

                                foreach ($selectedProducts as $product) {
                                    $productId = $product['productId'];
                                    $quantity = $product['quantity'];

                                    $productInfo = $products->getProductById($productId);

                                    $totalPrice = $quantity * $productInfo['price'];

                                    $orderDetail->createOrderDetail($orderId, $productId, $quantity, $totalPrice);
                                }

                                echo "Đã thêm đơn hàng thành công!";
                                header("Location: index.php?act=listorder");
                            } else {
                                echo "Có lỗi khi thêm đơn hàng!";
                            }
                        } else {

                            echo "Thiếu dữ liệu cần thiết.";
                        }
                    }
                }
                break;
            case 'listorderdetail':
                if (isset($_GET['id'])) {
                    $orderDetail = new OrderDetail();
                    $listOrderDetail = $orderDetail->getOrderDetailById($_GET['id']);
                    include './order_detail/list.php';
                }
                break;
            case 'listorderonline':
                $order = new OnlineOrder();
                $user = new user();

                $listOrderDetail = $order->getAllOnlineOrders();
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateOrderOnline'])) {
                    $id = $_POST['orderId'];
                    $status = $_POST['status'];
                    $order->updateOrderStatus($id, $status);
                    header("Location: index.php?act=listorderonline");
                }
                include './online_order/list.php';
                break;
            case 'listorderonlinedetail':
                if (isset($_GET['id'])) {
                    $orderDetail = new OnlineOrderDetail();
                    $listOrderDetail = $orderDetail->getOnlineOrderDetailById($_GET['id']);
                    include './online_order_details/list.php';
                }
                break;
            case 'thongke':
                $thongke = new Thongke();
                $order = new Order();
                $orderOnline = new OnlineOrder();
                $product = new Product();
                $user = new User();
                include './thongke/list.php';
                break;
            default:
                include './include/home.php';
                break;
        }
        ?>
    </div>
</section>
<?php
include './include/footer.php';
?>

<script src="../admin/content/js/jquery.min.js"></script>
<script src="../admin/content/js/popper.js"></script>
<script src="../admin/content/js/bootstrap.min.js"></script>
<script src="../admin/content/js/main.js"></script>

</body>

</html>