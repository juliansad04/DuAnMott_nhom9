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
<div class="container">
    <div class="breadcrumbs">

        <ol itemscope itemtype="http://schema.org/BreadcrumbList">

            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                <a itemprop="item" href=".">

                    <span itemprop="name">Trang chủ</span></a>

                <meta itemprop="position" content="1" />

            </li>

            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                <a itemprop="item" href="sanpham.php">

                    <span itemprop="name">Tin tức</span></a>

                <meta itemprop="position" content="2" />

            </li>


        </ol>

    </div>
    <div class="content_page">
        <div class="box-title">
            <div class="title-bar">
                <h1>Tin tức</h1>
            </div>
        </div>
        <div class="content_text">
            <ul class="list_ul">
                <?php
                $newsModel = new News();
                $newsList = $newsModel->getNews();

                foreach ($newsList as $newsItem) {
                    $shortContent = substr($newsItem['content_news'], 0, 300);
                    echo '<li class="lists">
            <div class="img-list">
                <a href="./chitiettin.php?id=' . $newsItem['id'] . '">
                    <img src="./admin/uploads/' . $newsItem['img_news'] . '">
                </a>
            </div>
            <div class="content-list">
                <div class="content-list_inm">
                    <div class="title-list">
                        <h3>
                            <a href="./chitiettin.php?id=' . $newsItem['id'] . '">' . $newsItem['title_news'] . '</a>
                        </h3>
                    </div>
                    <div class="content-list-in">
                        <p>' . $shortContent . '...</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </li>';
                }

                ?>
            </ul>
            <div class="clear"></div>
            <div class="wp_page">
                <div class="page">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--end:body-->
<?php
include("./includes/footer.php");
?>
<?php
include("./includes/linkjs.php");
?>
<script defer>
    (function(i, s, o, g, r, a, m) {

        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {

            (i[r].q = i[r].q || []).push(arguments)

        }, i[r].l = 1 * new Date();
        a = s.createElement(o),

            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', 'template/Default/js/analytics.js', 'ga');

    ga('create', 'UA-83194388-1', 'auto', {
        'siteSpeedSampleRate': 10
    });

    window.onload = function() {

        ga('send', 'pageview');

    };
</script>

<link async rel="stylesheet" href="template/Default/css/cssfooter.css" />
<div style="height: 1840px;position: fixed;width: 100%;top: 0px;left: 0px;right: 0px;bottom: 0px;z-index: 1001;background: #000 none repeat scroll 0% 0%;opacity: 0.3;display: none;text-align:center"
     id="khungnen"></div>
<div style="display: none;left: 70%;margin-left: -309px;z-index: 1002;position: fixed;top: 40%;margin-top: 0px;"
     id="loadding">
    <img src="template/Default/img/loader.gif" />
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();

    (function() {

        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];

        s1.async = true;

        s1.src = 'https://embed.tawk.to/5a73ecf4d7591465c7074ef6/default';

        s1.charset = 'UTF-8';

        s1.setAttribute('crossorigin', '*');

        s0.parentNode.insertBefore(s1, s0);

    })();
</script>
<!--End of Tawk.to Script-->
</body>

</html>