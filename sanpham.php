<!DOCTYPE html>
<html lang="en-CA">

<head>
    <?php
    include("./includes/head.php");
    include("./admin/products/products.php");
    ?>
</head>

<body>
<header>
    <?php
    include("./includes/header.php");
    ?>
</header>
<div class="clear"></div>
<div class="clear"></div>
<!--start:body-->

<section>

    <div class="bg_in">
        <div class="breadcrumbs">

            <ol itemscope itemtype="http://schema.org/BreadcrumbList">

                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                    <a itemprop="item" href=".">

                        <span itemprop="name">Trang chủ</span></a>

                    <meta itemprop="position" content="1" />

                </li>

                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                    <a itemprop="item" href="sanpham.php">

                        <span itemprop="name">Sản phẩm</span></a>

                    <meta itemprop="position" content="2" />

                </li>
            </ol>
        </div>
        <div class="module_pro_all">
            <div class="box-title">
                <div class="title-bar">
                    <h1>
                        <?php
                        if (isset($_GET['cate'])) {
                            $categoryId = $_GET['cate'];
                            $category = new Category();
                            $categoryInfo = $category->getCategoryById($categoryId);

                            if ($categoryInfo) {
                                echo 'Danh mục: ' . $categoryInfo['name'];
                            } else {
                                echo 'Danh mục không tồn tại';
                            }
                        } else {
                            echo 'Danh mục: Tất cả sản phẩm';
                        }
                        ?>
                    </h1>
                    <a class="read_more" href="sanpham.php">
                        Xem thêm
                    </a>
                </div>
            </div>
            <div class="pro_all_gird">
                <div class="girds_all list_all_other_page ">
                    <?php
                    $product = new Product();
                    if (isset($_GET['search'])) {
                        $searchTerm = $_GET['search'];
                        $products = $product->searchProductByName($searchTerm);
                    } elseif (isset($_GET['cate'])) {
                        $categoryId = $_GET['cate'];
                        $products = $product->getProductsByCategory($categoryId);
                    } else {
                        $products = $product->getProducts();
                    }


                    if (empty($products)) {
                        echo '<p>Không có sản phẩm nào được tìm thấy.</p>';
                    } else {
                        foreach ($products as $productItem) {
                            ?>
                            <div class="grids">
                                <div class="grids_in">
                                    <div class="content">
                                        <div class="img-right-pro">
                                            <a href="sanpham.php">
                                                <img class="lazy img-pro content-image" src="./admin/uploads/<?php echo $productItem['image']; ?>" alt="<?php echo $productItem['name']; ?>">
                                            </a>
                                            <div class="content-overlay"></div>
                                            <div class="content-details fadeIn-top">
                                                <ul class="details-product-overlay">
                                                    <?php
                                                    $cate = new Category();
                                                    $objCate = $cate->getCategoryById($productItem['category_id']);
                                                    ?>
                                                    <li><?php echo $objCate['name']; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="name-pro-right">
                                            <a href="chitietsp.php?id=<?php echo $productItem['id']; ?>">
                                                <h3><?php echo $productItem['name']; ?></h3>
                                            </a>
                                        </div>
                                        <div class="add_card">
                                            <?php if ($productItem['quantity'] > 0) { ?>
                                                <button type="button" onclick="<?php echo isset($_SESSION['id']) ? 'addToCart(' . $productItem['id'] . ');' : 'alertWaring()'; ?>">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng
                                                </button>
                                            <?php } else { ?>

                                                <span class="out-of-stock">
                                                        <div class="cach" style="padding: 10px;">Hết
                                                            hàng</div>
                                                    </span>
                                            <?php } ?>
                                        </div>
                                        <div class="price_old_new">
                                            <div class="price">
                                                <span class="news_price"><?php echo number_format($productItem['price'], 0, ',', '.') ?> VNĐ</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
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
        var quantity = 1;

        var xhr = new XMLHttpRequest();
        var url = "./handler/add_to_cart.php";
        var data = "productId=" + productId + "&quantity=" + quantity;

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