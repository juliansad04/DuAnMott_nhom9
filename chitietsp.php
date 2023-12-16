<!DOCTYPE html>
<html lang="en-CA">

<head>
    <title>Migoi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="cleartype" content="on" />
    <link rel="icon" href="template/Default/img/favicon.ico" type="image/x-icon" />
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <?php
    include("./includes/head.php");
    ?>
</head>


<body>
<header>
    <?php
    include("./includes/header.php");
    ?>
    <?php
    include("./admin/products/products.php");
    include("./admin/comment/comment.php");

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $product = new Product();
        $productDetails = $product->getProductById($productId);

        if ($productDetails !== null) {
            $productName = $productDetails['name'];
            $productDescription = $productDetails['description'];
            $productPrice = $productDetails['price'];
            $productImage = $productDetails['image'];
            $productQuantity = $productDetails['quantity'];
        }
    }
    ?>
</header>
<div class="clear"></div>
<!--start:body-->
<link rel="stylesheet" type="text/css" href="css/product.css">

<section>
    <div class="bg_in">
        <div class="wrapper_all_main">
            <div class="wrapper_all_main_right no-padding-left" style="width:100%;">

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
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <span itemprop="item">
                                    <strong itemprop="name">
                                        <?php echo $productName ?>
                                    </strong>
                                </span>
                            <meta itemprop="position" content="3" />
                        </li>
                    </ol>
                </div>
                <div class="content_page">
                    <div class="content-right-items margin0">
                        <div class="title-pro-des-ct">
                            <h1><?php echo $productName ?></h1>
                        </div>
                        <div class="slider-galery ">
                            <div id="sync1" class="owl-carousel owl-theme">
                                <div class="item">
                                    <img src="./admin/uploads/<?php echo $productImage ?>" width="100%">
                                </div>
                                <div class="item">
                                    <img src="./admin/uploads/<?php echo $productImage ?>" width="100%">
                                </div>
                                <div class="item">
                                    <img src="./admin/uploads/<?php echo $productImage ?>" width="100%">
                                </div>
                            </div>

                            <!-- <div id="sync2" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img src="./admin/uploads/<?php echo $productImage ?>" width="100%">
                                    </div>
                                    <div class="item">
                                        <img src="./admin/uploads/<?php echo $productImage ?>" width="100%">
                                    </div>

                                    <div class="item">
                                        <img src="./admin/uploads/<?php echo $productImage ?>" width="100%">
                                    </div>

                                </div> -->

                        </div>
                        <div class="content-des-pro">
                            <div class="content-des-pro_in">
                                <div class="pro-des-sum">
                                    <div class="price">
                                        <!-- <p class="code_skin" style="margin-bottom:10px">
                                            <span>Mã hàng: <a href="chitietsp.php">CRW-W06</a> | Thương hiệu: <a
                                                    href="">Comrack</a></span>
                                        </p> -->
                                        <div class="status_pro">
                                            <span><b>Trạng thái:</b> Còn hàng</span>
                                        </div>
                                        <div class="status_pro"><span><b>Xuất xứ:</b> Việt Nam</span></div>
                                    </div>
                                    <div class="color_price">
                                        <span class="title_price bg_green">Giá bán</span>
                                        <?php echo number_format($productPrice, 0, ',', '.') ?><span>vnđ</span>
                                        (GIÁ CHƯA VAT)
                                        <div class="clear"></div>
                                    </div>
                                    <!-- <div class="color_price">
                                        <span class="title_price">Giá cũ</span>
                                        <del>10,000 <span>vnđ</span></del>
                                    </div> -->
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="content-pro-des">
                                <div class="content_des">
                                    <p style="font-size: 16px;font-weight: bold;"><?php echo $productName ?></p>
                                    <br />
                                    <p><?php echo $productDescription ?>
                                    </p>


                                </div>
                            </div>
                            <div class="ct">
                                <!-- <div class="number_price">
                                    <div class="custom pull-left">
                                        <button
                                            onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) && qty > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button">-</button>

                                        <input type="text" class="input-text qty" title="Qty" value="1"
                                            maxlength="12" id="qty" name="qty">
                                        <button
                                            onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                            class="increase items-count" type="button">+</button>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div> -->
                                <div class="wp_a">
                                    <a <?php echo $productQuantity > 0 ? 'onclick="addToCart(' . $productId . ');"' : 'class="out-of-stock"'; ?>
                                            class="view_duan">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span class="text-mobile-buy">
                                                <?php echo $productQuantity > 0 ? 'Mua hàng' : 'Hết hàng'; ?>
                                            </span>
                                    </a>
                                    <a href="tel:090 66 99 038" class="view_duan">
                                        <i class="fa fa-phone" aria-hidden="true"></i> <span
                                                class="text-mobile-buy">Gọi ngay</span>
                                    </a>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="tags_products prodcut_detail">
                                <div class="tab_link">
                                    <h3 class="title_tab_link">TAGS: </h3>
                                    <div class="content_tab_link"> <a href="tag/"></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="content-des-pro-suport">
                            <div class="box-setup">
                                <div class="title-setup">
                                    <i class="fa fa-tasks" aria-hidden="true"></i> Dịch vụ &amp; Chú ý
                                </div>
                                <div class="info-setup">
                                    <div class="row-setup">
                                        <p style="text-align:justify">Quý khách vui lòng liên hệ với nhân viên bán
                                            hàng theo số điện thoại Hotline sau :</p>
                                        <p><span style="color:#d50100">0932 023 992</span>&nbsp;để biết thêm chi
                                            tiết về Phụ kiện sản phẩm.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="info-prod prod-price freeship">
                                    <span class="title">
                                        <p>
                                            Bạn sẽ được giao hàng miễn phí trong khu vực nội thành TPHCM khi mua sản
                                            phẩm này.
                                        </p>
                                    </span>
                                <span class="row more"><a href="" title="">Xem thêm</a>
                                    </span>
                            </div>
                            <div class="bx-contact">
                                <span class="title-cnt">Bạn cần hỗ trợ?</span>
                                <p>Chat với chúng tôi :</p>
                                <p><img alt="icon skype " src="image/icon skype.png"
                                        style="height:24px; width:24px" />&nbsp;<a
                                            href="skype:quangtran.123corp?chat">mifgois.com</a></p>
                                <p><img alt="icon skype " src="image/icon skype.png"
                                        style="height:24px; width:24px" />&nbsp;<a
                                            href="skype:quangtran.123corp?chat">mifgois.com</a></p>
                                <p><img alt="icon skype " src="image/icon skype.png"
                                        style="height:24px; width:24px" />&nbsp;<a
                                            href="skype:quangtran.123corp?chat">mifgois.com</a></p>

                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="wrapper_all_main_right">
                <div class="tabs-animation">
                    <div class="bg_in">
                        <div id="nav-anchor"></div>
                        <nav class="nav-tabs">
                            <ul>
                                <li><a href="#productDetail"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                        <span class="text-mobile">Chi tiết sản phẩm</span></a></li>

                                <li><a href="#Comment"><i class="fa fa-comment-o" aria-hidden="true"></i><span
                                                class="text-mobile"> Bình luận</span></a></li>
                            </ul>
                            <div class="name-product">
                                Mì
                                <span class="" style="font-size:16px; color:red; padding-left:5px;">1,960,000
                                        VNĐ</span>
                            </div>
                            <div class="ct btn-wp">
                                <div class="wp_a">
                                    <a onclick="<?php echo isset($_SESSION['id']) ? 'addToCart(' . $productId . ');' : 'alertWaring()'; ?>"
                                       class="view_duan">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                                                class="text-mobile-buy">Mua hàng</span>
                                    </a>
                                    <a href="tel:090 66 99 038" class="view_duan">
                                        <i class="fa fa-phone" aria-hidden="true"></i> <span
                                                class="text-mobile-buy">Gọi ngay</span>
                                    </a>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="product_detail_info">
                    <div class="module_pro_all" id="productDetail">
                        <div class="box-title">
                            <div class="title-bar">
                                <h3>Chi tiết sản phẩm</h3>
                            </div>
                        </div>
                        <div class="tab_content content_text_product content-module">
                            <p><?php echo $productDescription ?></p>
                        </div>
                    </div>

                </div>
                <div class="clear"></div>
                <div class="module_pro_all" id="productDetail">
                    <div class="box-title">
                        <div class="title-bar">
                            <h3>Bình luận sản phẩm</h3>
                            <section class="comment_product" style="background-color: #ffffff;">
                                <div class="container my-5 py-5">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12 col-lg-10 col-xl-8">
                                            <?php
                                            $comment = new Comment();
                                            $user = new User();
                                            $comments = $comment->getCommentById($productId);
                                            foreach ($comments as $commentItem) {
                                                $userInfo = $user->getUserById($commentItem['user_id']);
                                                ?>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-start align-items-center">
                                                            <div>
                                                                <h6 class="fw-bold text-primary mb-1">
                                                                    <?php echo $userInfo['username']; ?> </h6>
                                                                <p class="text-muted small mb-0">
                                                                    Posted on
                                                                    <?php echo date('F j, Y', strtotime($commentItem['comment_date'])); ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <p class="mt-3 mb-4 pb-2"><?php echo $commentItem['comment']; ?>
                                                        </p>
                                                        <hr style="color: #000;">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if (isset($_SESSION['id'])) {
                                                ?>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="./handler/post_comment.php" method="post">
                                                            <div class="d-flex flex-start w-100">
                                                                <div class="form-outline w-100">
                                                                    <textarea class="form-control" id="textAreaExample"
                                                                              name="comment" rows="6"
                                                                              style="width: 1120px;"></textarea>
                                                                    <label class="form-label"
                                                                           for="textAreaExample">Message</label>
                                                                </div>
                                                                <input type="hidden" name="product_id"
                                                                       value="<?php echo $productId ?>">
                                                            </div>
                                                            <div class="float-end mt-2 pt-1">
                                                                <button type="submit" class="btn btn-primary btn-sm"
                                                                        name="post_comment">Gửi bình luận</button>
                                                                <button type="button"
                                                                        class="btn btn-outline-primary btn-sm">Hủy</button>
                                                            </div>
                                                        </form>
                                                        <br>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </section>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="tab_content content_text_product content-module">
                    <div class="namecm col-md-12">
                        <div class="avt">

                        </div>

                    </div>
                </div>
            </div>


            <div class="clear"></div>
            <div class="dmsub">
                <div class="tags_products desktop">
                    <div class="tab_link">
                        <h3 class="title_tab_link">TAGS: </h3>
                        <div class="content_tab_link">
                            <a href="#">Mì</a>
                            <a href="#">Mì ăn liền</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="content-brank">
                 <p><strong>Apple </strong>tự hảo<strong>&nbsp;</strong>là thương hiệu Việt Nam về sản phẩm tủ rack 19", tủ cửa lưới, tủ treo tường, bảo vệ thiết bị mạng an toàn, dễ dàng quản lý và vận hành.</p>
              </div> -->
            <div class="module_pro_all">
                <div class="box-title">
                    <div class="title-bar">
                        <h3>Sản phẩm liên quan</h3>
                    </div>
                </div>
                <div class="pro_all_gird">
                    <div class="girds_all list_all_other_page">
                        <?php
                        $productsRelated = $product->getProductsByCategory($productDetails['category_id']);
                        $counter = 0;
                        foreach ($productsRelated as $productRelated) {
                            if ($counter >= 5) {
                                break;
                            }
                            ?>
                            <div class="grids">
                                <div class="grids_in">
                                    <div class="content">
                                        <div class="img-right-pro">
                                            <a href="chitietsp.php?id=<?php echo $productRelated['id']; ?>">
                                                <img class="lazy img-pro content-image"
                                                     src="./admin/uploads/<?php echo $productRelated['image']; ?>"
                                                     alt="<?php echo $productRelated['name']; ?>">
                                            </a>
                                            <div class="content-overlay"></div>
                                            <div class="content-details fadeIn-top">
                                                <ul class="details-product-overlay">
                                                    <?php
                                                    $cate = new Category();
                                                    $objCate = $cate->getCategoryById($productRelated['category_id']);
                                                    ?>
                                                    <li><?php echo $objCate['name']; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="name-pro-right">
                                            <a href="chitietsp.php?id=<?php echo $productRelated['id']; ?>">
                                                <h3><?php echo $productRelated['name']; ?></h3>
                                            </a>
                                        </div>
                                        <div class="add_card">
                                            <?php if ($productRelated['quantity'] > 0) { ?>
                                                <button type="button"
                                                        onclick="<?php echo isset($_SESSION['id']) ? 'addToCart(' . $productRelated['id'] . ');' : 'alertWaring()'; ?>">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng
                                                </button>
                                            <?php } else { ?>
                                                <span class="out-of-stock"> <div class="cach" style="padding: 10px;">Hết
                                                            hàng</div></span>
                                            <?php } ?>
                                        </div>

                                        <div class="price_old_new">
                                            <div class="price">
                                <span class="news_price"><?php echo number_format($productRelated['price'], 0, ',', '.') ?>
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

            <!--end:left-->
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <script>
        jQuery(document).ready(function() {



            var div_fixed = jQuery('.product_detail_info').offset().top;

            jQuery(window).scroll(function() {

                if (jQuery(window).scrollTop() > div_fixed) {

                    jQuery('.tabs-animation').addClass('fix_top');

                } else {

                    jQuery('.tabs-animation').removeClass('fix_top');

                }

            });

            jQuery(window).load(function() {

                if (jQuery(window).scrollTop() > div_fixed) {

                    jQuery('.tabs-animation').addClass('fix_top');

                }

            });

        });
    </script>
</section>
<!--end:body-->
<?php
include("./includes/linkjs.php");
?>
<?php
include("./includes/footer.php");
?>
<link async rel="stylesheet" href="css/cssfooter.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script defer type="text/javascript" src="js/sweet-alert.js"></script>
<script defer type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script defer src="js/owl.carousel.js" type="text/javascript"></script>
<script defer src="js/jquery.lazyload.min.js" type="text/javascript"></script>
<script defer type="text/javascript" src="js/script_ex.js"></script>
<script defer type="text/javascript" src="js/script_menu.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="template/Default/js/sweet-alert.css"/> -->
<script type="text/javascript">
    $(document).ready(function() {

        var sync1 = $("#sync1");
        var sync2 = $("#sync2");
        var slidesPerPage = 5; //globaly define number of elements per page
        var syncedSecondary = true;

        sync1.owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: false,
            autoplay: true,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<svg width="10%" height="10%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 2px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                '<svg width="3%" height="3%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 2px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
            ],
        }).on('changed.owl.carousel', syncPosition);

        sync2
            .on('initialized.owl.carousel', function() {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: slidesPerPage,
                dots: false,
                nav: false,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if you set loop to false, you have to restore this next line
            //var current = el.item.index;

            //if you disable loop you have to comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }

            //end block

            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();
            https: //thietbivanphong123.com/data/upload/ST8000VN004.jpg
                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
    });
</script>

<div style="height: 1840px;position: fixed;width: 100%;top: 0px;left: 0px;right: 0px;bottom: 0px;z-index: 1001;background: #000 none repeat scroll 0% 0%;opacity: 0.3;display: none;text-align:center"
     id="khungnen"></div>
<div style="display: none;left: 70%;margin-left: -309px;z-index: 1002;position: fixed;top: 40%;margin-top: 0px;"
     id="loadding">
    <img src="image/loader.gif" />
</div>
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