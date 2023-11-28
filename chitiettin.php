<!DOCTYPE html>
<html lang="en-CA">

<head>
    <?php
    include("./includes/head.php");
    include("./admin/news/news.php");
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
<section>
    <div class="bg_in">
        <div class="wrapper_all_main">
            <div class="wrapper_all_main_right">
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
                                        Giới thiệu
                                    </strong>
                                </span>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </div>
                <!--breadcrumbs-->
                <div class="content_page">
                    <div class="box-title">
                        <div class="title-bar">
                            <h1>Giới thiệu</h1>
                        </div>
                    </div>
                    <div class="content_text">
                        <?php
                        if(isset($_GET['id'])) {
                            $newsId = $_GET['id'];

                            $newsModel = new news();

                            $newsItem = $newsModel->getNewsById($newsId);

                            if($newsItem) {
                                echo '<h1>' . $newsItem['title_news'] . '</h1>';
                                echo '<p>' . $newsItem['content_news'] . '</p>';
                            } else {
                                echo 'Không tìm thấy tin tức';
                            }
                        } else {
                            echo 'Tham số "id" không tồn tại trong URL';
                        }
                        ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!--start:left-->
            <div class="wrapper_all_main_left">
            </div>
            <!--end:left-->
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
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