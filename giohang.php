<?php
session_start();
if (isset($_SESSION['id'])) {
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
        include('./admin/cart_items/cart_items.php');
        include('./admin/products/products.php');
        include("./includes/header.php");
        include("./admin/shopping_cart/shopping_cart.php");
        ?>
    </header>
    <div class="clear"></div>
    <!--start:body-->
    <script type="text/javascript">
        function del(id, name)

        {

            var id_del = id;

            var name_del = name;

            swal({

                    title: "Bạn có muốn xóa sản phẩm " + name_del + " ?",

                    type: "warning",

                    showCancelButton: true,

                    confirmButtonColor: "#DD6B55",

                    confirmButtonText: "YES!",

                    closeOnConfirm: false
                },

                function() {

                    window.location = "./handler/delete_item_cart.php?id=" + id_del;

                });

        }

        function checkIt(e) {

            // cho phep nhap so, nut backspace, delete vau dau .

            var keynum;

            if (window.event) // IE

            {

                keynum = e.keyCode;

            } else if (e.which) // Netscape/Firefox/Opera

            {

                keynum = e.which;

            }

            if (((keynum > 45) && (keynum < 58)) || (keynum == 8) || (keynum == 9) || (keynum == 190) || (keynum == 39) || (
                keynum == 37) || (keynum >= 96 && keynum <= 105)) return true;

            else return false;



            // 37 : left ; 39: right

        }

        function KiemTraEmail()

        {

            var x = document.FormDatHang;

            var n = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            var xx = x.txtEmail.value;

            if (!xx.match(n))

            {

                swal({

                        title: "Email không hợp lệ",

                        type: "error",

                        showCancelButton: false,

                        confirmButtonColor: '#F19F00',

                        confirmButtonText: 'OK',

                    },

                    function(isConfirm) {

                        if (isConfirm) {

                            x.txtEmail.focus();

                            jQuery("#sub").attr("type", "button");

                            return false;

                        }

                    });

            } else {

                jQuery("#sub").attr("type", "submit");

                return true;

            }

        }
    </script>
    <section>
        <div class="bg_in">
            <div class="content_page cart_page">
                <div class="breadcrumbs">
                    <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href=".">
                                <span itemprop="name">Trang chủ</span></a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <span itemprop="item">
                                    <strong itemprop="name">
                                        Giỏ hàng
                                    </strong>
                                </span>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </div>
                <div class="box-title">
                    <div class="title-bar">
                        <h1>Giỏ hàng của bạn</h1>
                    </div>
                </div>
                <div class="content_text">
                    <div class="container_table">
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr class="tr tr_first">
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Mã sản phẩm</th>
                                <th>Giá</th>
                                <th style="width:100px;">Số lượng</th>
                                <th>Thành tiền</th>
                                <th style="width:50px; text-align:center;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $shoppingCart = new ShoppingCart();
                            $userId = $_SESSION['id'];
                            $cartDetails = $shoppingCart->getCartWithDetailsById($userId);


                            foreach ($cartDetails['details'] as $cartItem) {
                                ?>
                                <tr class="tr">
                                    <td data-th="Hình ảnh">
                                        <div class="col_table_image col_table_hidden-xs"><img src="./admin/uploads/<?php echo $cartItem['image_url']; ?>" alt="<?php echo $cartItem['product_name']; ?>" class="img-responsive" />
                                        </div>
                                    </td>
                                    <td data-th="Sản phẩm">
                                        <div class="col_table_name">
                                            <h4 class="nomargin"><?php echo $cartItem['product_name']; ?></h4>
                                        </div>
                                    </td>
                                    <td data-th="Mã sản phẩm">
                                        <div class="col_table_name">
                                            <h4 class="nomargin"><?php echo $cartItem['product_id']; ?></h4>
                                        </div>
                                    </td>
                                    <td data-th="Giá"><span class="color_red font_money"><?php echo number_format($cartItem['price'], 0, ',', '.') ?> VNĐ</span></td>

                                    </td>
                                    <form action="./handler/update_cart_item_quantity.php" method="POST">
                                        <td data-th="Số lượng">
                                            <div class="clear margintop5">
                                                <div class="floatleft">
                                                    <?php
                                                    $minQuantity = 1;
                                                    $currentQuantity = $cartItem['quantity'];
                                                    $displayQuantity = max($minQuantity, $currentQuantity);
                                                    ?>
                                                    <input type="number" class="inputsoluong" name="newQuantity" value="<?php echo $displayQuantity; ?>" min="<?php echo $minQuantity; ?>">
                                                </div>
                                                <input type="hidden" name="cartItemId" value="<?php echo $cartItem['id']; ?>">
                                                <div class="floatleft width50">
                                                    <button class="btn_df btn_table_td_rf_del btn-sm">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </td>
                                    </form>

                                    <td data-th="Thành tiền" class="text_center"><span class="color_red font_money"><?php echo number_format($cartItem['total_price'], 0, ',', '.') ?> VNĐ</span></td>
                                    </td>
                                    <td class="actions aligncenter" data-th="">
                                        <a onclick="return del(<?php echo $cartItem['id']; ?>, '<?php echo $cartItem['product_name']; ?>');" class="btn_df btn_table_td_rf_del btn-sm"><i class="fa fa-trash-o"></i>
                                            <span class="display_mobile">Xóa sản phẩm</span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="7" class="textright_text">
                                    <div class="sum_price_all">
                                        <span class="text_price">Tổng tiền thành toán</span>:
                                        <span class="text_price color_red"><?php echo $cartDetails['cart']['total_price']; ?></span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr class="tr_last">
                                <td colspan="7">
                                    <a href="." class="btn_df btn_table floatleft"><i class="fa fa-long-arrow-left"></i> Tiếp tục mua hàng</a>
                                    <div class="clear"></div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="contact_form">
                        <div class="contact_left">
                            <div class="ch-contacts-details">
                                <ul class="contact-list">
                                    <li class="addr">
                                        <strong class="title">Địa chỉ của chúng tôi</strong>
                                        <p><em><strong>Migoi</strong></em><br />
                                        <p>Trung Tâm Bán Hàng:</p>
                                        <p>CN1: 333B Minh Phụng, Phường 100, Quận Cam, HCM</p>
                                        <p>CN2: 293 Lý Thái Tổ, Phường 10, Quận 10, HCM</p>
                                        <p>N3: 339 Quang Trung, Phường 10, Q. Gò Vấp, HCM</p>
                                        <p> Hotline: 0122122122 - 0122122122 (zalo)</p>
                                        </p>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="contact_right">
                            <div class="form_contact_in">
                                <div class="box_contact">
                                    <form name="FormDatHang" method="post" action="./handler/order.php">
                                        <div class="content-box_contact">
                                            <div class="row">
                                                <div class="input">
                                                    <label>Họ và tên: <span style="color:red;">*</span></label>
                                                    <input type="text" name="txtHoTen" id="txtHoTen">
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <div class="row">
                                                <div class="input">
                                                    <label>Số điện thoại: <span style="color:red;">*</span></label>
                                                    <input type="text" name="txtDienThoai" id="txtDienThoai" oninput="validatePhoneNumber(this)">
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <div class="row">
                                                <div class="input">
                                                    <label>Địa chỉ: <span style="color:red;">*</span></label>
                                                    <input type="text" name="txtDiaChi" id="txtDiaChi">
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <div class="row">
                                                <div class="input">
                                                    <label>Email: <span style="color:red;">*</span></label>
                                                    <input type="text" name="txtEmail" id="txtEmail" onchange="return KiemTraEmail(this)">
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <div class="row">
                                                <div class="input">
                                                    <label>Nội dung: <span style="color:red;">*</span></label>
                                                    <textarea type="text" name="txtNoiDung" id="txtNoiDung" class="clsipa"></textarea>
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                            <div class="row btnclass">
                                                <div class="input ipmaxn">
                                                    <input type="submit" class="btn-gui" name="place_order" id="place_order" value="Gửi đơn hàng" onclick="return KiemTra()">
                                                    <input type="reset" class="btn-gui" value="Nhập lại">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <!---row---->
                                            <div class="clear"></div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---End bg_in----->
    <script>
        function checkIt(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                alert("Số điện thoại phải là các con số.");
                return false;
            }
            return true;
        }

        function KiemTraEmail(input) {
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!input.value.match(emailRegex)) {
                alert("Email không hợp lệ");
                return false;
            }
            return true;
        }

        function validatePhoneNumber(input) {
            input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters

            if (input.value.length < 10 || input.value.length > 11 || !input.value.startsWith('0')) {
                input.setCustomValidity("Số điện thoại không hợp lệ. Phải là số và bắt đầu từ số 0, từ 10-11 số.");
            } else {
                input.setCustomValidity("");
            }
        }

        function KiemTra() {
            var x = document.getElementById("txtHoTen").value.trim();
            var y = document.getElementById("txtDiaChi").value.trim();
            var dt = document.getElementById("txtDienThoai").value.trim();
            var xx = document.getElementById("txtEmail").value.trim();
            var nd = document.getElementById("txtNoiDung").value.trim();

            if (x === "") {
                alert("Họ tên không được để trống!");
                return false;
            }

            if (y === "") {
                alert("Địa chỉ không được để trống!");
                return false;
            }

            if (dt.length < 10 || dt.length > 11 || !/^[0-9]+$/.test(dt) || !dt.startsWith('0')) {
                alert("Số điện thoại không hợp lệ. Phải là số và bắt đầu từ số 0, từ 10-11 số.");
                return false;
            }

            if (!xx.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)) {
                alert("Email không hợp lệ");
                return false;
            }

            if (nd === "") {
                alert("Nội dung không được để trống!");
                return false;
            }

            // If all validations pass, the form will be submitted
            return true;
        }
    </script>

    <script>
        function muahang(doc) {

            $.post('./gio-hang/', $(doc).serialize(), function(data) {

                alert(data);

                location.reload();

            })

            return false;

        }
    </script>
    <!--end:body-->
    <?php
    include("./includes/footer.php");
    ?>
    <?php
    include("./includes/linkjs.php");
    ?>
    </body>

    </html>
    <?php
} else {

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
        include('./admin/cart_items/cart_items.php');
        include('./admin/products/products.php');
        include("./includes/header.php");
        include("./admin/shopping_cart/shopping_cart.php");
        ?>
    </header>

    <div class="container" style="padding: 50px 0">
        <h1>vui lòng đăng nhập để xem giỏ hàng</h1>
    </div>
    <?php
    include("./includes/footer.php");
    ?>
    <?php
    include("./includes/linkjs.php");
    ?>

    </html>
    <?php
}
?>