<?php
include("./admin/products/products.php");
$product = new Product();
?>

<!DOCTYPE html>
<html lang="en-CA">

<head>
    <?php
    include("./includes/head.php");
    ?>

</head>

<body>
<header>
    <?php
    include("./includes/header.php");
    ?>
</header>
<div class="clear"></div>

<section>
    <?php
    include("./includes/slider.php");
    ?>

</section>

<section>
    <div class="bg_in">
        <div class="module_pro_all">
            <div class="box-title">
                <div class="title-bar">
                    <h1>Mì ly</h1>
                    <a class="read_more" href="sanpham.php">
                        Xem thêm
                    </a>
                </div>
            </div>
            <div class="pro_all_gird">
                <div class="girds_all list_all_other_page">
                    <?php
                    $productsMyGoiInCategory = $product->getProductsByCategory(7);
                    $counter = 0;
                    foreach ($productsMyGoiInCategory as $productMyGoi) {
                        if ($counter >= 5) {
                            break;
                        }
                        ?>
                        <div class="grids">
                            <div class="grids_in">
                                <div class="content">
                                    <div class="img-right-pro">
                                        <a href="sanpham.php">
                                            <img class="lazy img-pro content-image"
                                                 src="./admin/uploads/<?php echo $productMyGoi['image']; ?>"
                                                 alt="<?php echo $productMyGoi['name']; ?>">
                                        </a>
                                        <div class="content-overlay"></div>
                                        <div class="content-details fadeIn-top">
                                            <ul class="details-product-overlay">
                                                <?php
                                                $cate = new Category();
                                                $objCate = $cate->getCategoryById($productMyGoi['category_id']);
                                                ?>
                                                <li><?php echo $objCate['name']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="name-pro-right">
                                        <a href="chitietsp.php?id=<?php echo $productMyGoi['id']; ?>">
                                            <h3><?php echo $productMyGoi['name']; ?></h3>
                                        </a>
                                    </div>
                                    <div class="add_card">
                                        <button type="button"
                                                onclick="<?php echo isset($_SESSION['id']) ? 'addToCart(' . $productMyGoi['id'] . ');' : 'alertWaring()'; ?>">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng
                                        </button>
                                    </div>
                                    <div class="price_old_new">
                                        <div class="price">
                                            <span
                                                class="news_price"><?php echo number_format($productMyGoi['price']); ?>
                                                vnd</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                    ?>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="module_pro_all">
            <div class="box-title">
                <div class="title-bar">
                    <h1>Mì tô</h1>
                    <a class="read_more" href="sanpham.php">
                        Xem thêm
                    </a>
                </div>
            </div>
            <div class="pro_all_gird">
                <div class="girds_all list_all_other_page ">

                    <?php
                    $productsMyLyInCategory = $product->getProductsByCategory(8);
                    $counter = 0;
                    foreach ($productsMyLyInCategory as $productMyLy) {
                        if ($counter >= 5) {
                            break;
                        }
                        ?>
                        <div class="grids">
                            <div class="grids_in">
                                <div class="content">
                                    <div class="img-right-pro">
                                        <a href="sanpham.php">
                                            <img class="lazy img-pro content-image"
                                                 src="./admin/uploads/<?php echo $productMyLy['image']; ?>"
                                                 alt="<?php echo $productMyLy['name']; ?>">
                                        </a>
                                        <div class="content-overlay"></div>
                                        <div class="content-details fadeIn-top">
                                            <ul class="details-product-overlay">
                                                <?php
                                                $cate = new Category();
                                                $objCate = $cate->getCategoryById($productMyLy['category_id']);
                                                ?>
                                                <li><?php echo $objCate['name']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="name-pro-right">
                                        <a href="chitietsp.php?id=<?php echo $productMyLy['id']; ?>">
                                            <h3><?php echo $productMyLy['name']; ?></h3>
                                        </a>
                                    </div>
                                    <div class="add_card">
                                        <button type="button"
                                                onclick="<?php echo isset($_SESSION['id']) ? 'addToCart(' . $productMyLy['id'] . ');' : 'alertWaring()'; ?>">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng
                                        </button>
                                    </div>
                                    <div class="price_old_new">
                                        <div class="price">
                                            <span class="news_price"><?php echo number_format($productMyLy['price']); ?>
                                                vnd</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                    ?>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="module_pro_all">
            <div class="box-title">
                <div class="title-bar">
                    <h1>Mì gói</h1>
                    <a class="read_more" href="sanpham.php">
                        Xem thêm
                    </a>
                </div>
            </div>
            <div class="pro_all_gird">
                <div class="girds_all list_all_other_page ">
                    <?php
                    $productsMiToInCategory = $product->getProductsByCategory(9);
                    $counter = 0;
                    foreach ($productsMiToInCategory as $productMiTo) {
                        if ($counter >= 5) {
                            break;
                        }
                        ?>
                        <div class="grids">
                            <div class="grids_in">
                                <div class="content">
                                    <div class="img-right-pro">
                                        <a href="sanpham.php">
                                            <img class="lazy img-pro content-image"
                                                 src="./admin/uploads/<?php echo $productMiTo['image']; ?>"
                                                 alt="<?php echo $productMiTo['name']; ?>">
                                        </a>
                                        <div class="content-overlay"></div>
                                        <div class="content-details fadeIn-top">
                                            <ul class="details-product-overlay">
                                                <?php
                                                $cate = new Category();
                                                $objCate = $cate->getCategoryById($productMiTo['category_id']);
                                                ?>
                                                <li><?php echo $objCate['name']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="name-pro-right">
                                        <a href="chitietsp.php?id=<?php echo $productMiTo['id']; ?>">
                                            <h3><?php echo $productMiTo['name']; ?></h3>
                                        </a>
                                    </div>
                                    <div class="add_card">
                                        <button type="button"
                                                onclick="<?php echo isset($_SESSION['id']) ? 'addToCart(' . $productMiTo['id'] . ');' : 'alertWaring()'; ?>">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng
                                        </button>
                                    </div>
                                    <div class="price_old_new">
                                        <div class="price">
                                            <span class="news_price"><?php echo number_format($productMiTo['price']); ?>
                                                vnd</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                    ?>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>

</section>
<!--end:body-->
<?php
include("./includes/footer.php");
?>
<?php
include("./includes/linkjs.php");
?>
</body>
<script>
    function alertWaring() {
        Toastify({
            text: "Đăng nhập để thêm sản phẩm vào giỏ hàng",
            duration: 3000,
            style: {
                background: "#D81A1C",
            }
        }).showToast();
    }
</script>
<script>
    function addToCart(productId) {
        var userId = <?php echo $_SESSION['id']; ?>;
        var quantity = 1;

        var xhr = new XMLHttpRequest();
        var url = "./handler/add_to_cart.php";
        var data = "userId=" + userId + "&productId=" + productId + "&quantity=" + quantity;

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    Toastify({
                        text: "Sản phẩm đã được thêm vào giỏ hàng!",
                        duration: 3000
                    }).showToast();
                    console.log("xong");
                } else {
                    console.error("Có lỗi xảy ra: " + xhr.statusText);
                }
            }
        };

        xhr.send(data);
    }
</script>

</html>