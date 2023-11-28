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
<!--start:body-->
<script>
    function inputNumber2(e)

    {

        // cho phep nhap so, nut backspace, delete vau dau .

        var keynum;

        if(window.event) // IE

        {

            keynum = e.keyCode;

        }

        else if(e.which) // Netscape/Firefox/Opera

        {

            keynum = e.which;

        }

        if ( ((keynum > 45) && (keynum <58)) || (keynum == 8) || (keynum == 9) || (keynum == 190) || (keynum == 39)|| (keynum == 37)  || (keynum >= 96 && keynum <= 105)) return true;

        else return false;

        // 37 : left ; 39: right

    }

    function KiemTraEmailLH()

    {

        var x = document.FormLienHe;

        var n = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        var xx=x.txtEmail.value;

        if(!xx.match(n))

        {

            swal({

                    title: "Email không hợp lệ",

                    type: "error",

                    showCancelButton: false,

                    confirmButtonColor: '#F19F00',

                    confirmButtonText: 'OK',

                },

                function(isConfirm){

                    if (isConfirm){

                        x.txtEmail.focus();

                        jQuery("#sub").attr("type", "button");

                        return false;

                    }

                });

        }else{

            jQuery("#sub").attr("type", "submit");

            return true;

        }

    }

    function lienHe(doc){

        document.getElementById("khungnen").style.display = "block";

        document.getElementById("loadding").style.display = "block";

        jQuery.post('./lien-he/',$(doc).serialize(),function(data){

            document.getElementById("khungnen").style.display = "none";

            document.getElementById("loadding").style.display = "none";

            if(data == 0){

                swal({

                        title: "Yêu cầu liên hệ của bạn đã được gửi. Chúng tôi sẽ có phản hồi sớm nhất đến bạn.",

                        type: "success",

                        showCancelButton: false,

                        confirmButtonColor: '#F19F00',

                        confirmButtonText: 'OK',

                    },

                    function(isConfirm){

                        if (isConfirm){

                            location.reload();

                        }

                    });

            }else if(data == 1 || data != 0){

                swal({

                        title: "Đã xảy ra lỗi trong quá trình gửi.",

                        type: "error",

                        showCancelButton: false,

                        confirmButtonColor: '#F19F00',

                        confirmButtonText: 'OK',

                    },

                    function(isConfirm){

                        if (isConfirm){

                            return false;

                        }

                    });

            }

        })

        return false;

    }

</script>
<section>
    <div class="bg_in">
        <div class="contact_form">
            <div class="contact_left">
                <div class="ch-contacts-details">
                    <ul class="contact-list">
                        <li class="addr">
                            <strong class="title">Địa chỉ của chúng tôi</strong>
                            <p>
                                <em><strong>Migoi</strong></em><br />
                                <em> 333B Minh Phụng, Phường 100, Quận Cam, HCM<br />
                                    Điện thoại : 0122122122<br />
                                    <!--   <strong>Điện thoại: <span style="color:#FF0000"></span></strong></em> -->
                            </p>
                        </li>
                    </ul>
                    <div class="hiring-box">
                        <strong class="title">Chào bạn!</strong>

                        <p>Mọi thắc mắc bạn hãy gửi về mail của chúng tôi <strong>thanhcodephpngu@gmail.com</strong> chúng tôi sẽ giải đáp cho bạn.</p>

                        <p><a href="#" class="arrow-link"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Về trang chủ</a></p>

                    </div>
                </div>
            </div>
            <div class="contact_right">
                <div class="form_contact_in">
                    <div class="box_contact">
                        <form name="FormDatHang" method="post" action="gio-hang/" >
                            <div class="content-box_contact">
                                <div class="row">
                                    <div class="input">
                                        <label>Họ và tên: <span style="color:red;">*</span></label>
                                        <input type="text" name="txtHoTen" required class="clsip">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!---row---->
                                <div class="row">
                                    <div class="input">
                                        <label>Số điện thoại: <span style="color:red;">*</span></label>
                                        <input type="text" name="txtDienThoai" required onkeydown="return checkIt(event)" class="clsip">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!---row---->
                                <div class="row">
                                    <div class="input">
                                        <label>Địa chỉ: <span style="color:red;">*</span></label>
                                        <input type="text" name="txtDiaChi" required class="clsip" >
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!---row---->
                                <div class="row">
                                    <div class="input">
                                        <label>Email: <span style="color:red;">*</span></label>
                                        <input type="text" name="txtEmail" onchange="return KiemTraEmail(this);" required class="clsip">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!---row---->
                                <div class="row">
                                    <div class="input">
                                        <label>Nội dung: <span style="color:red;">*</span></label>
                                        <textarea type="text" name="txtNoiDung" class="clsipa"></textarea>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!---row---->
                                <div class="row btnclass">
                                    <div class="input ipmaxn ">
                                        <input type="submit" class="btn-gui" name="frmSubmit" id="frmSubmit" value="Gửi đơn hàng">
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
</section>
<!---End bg_in----->
<!--end:body-->
<?php
include("./includes/footer.php");
?>
<?php
include("./includes/linkjs.php");
?>
</body>
</html>