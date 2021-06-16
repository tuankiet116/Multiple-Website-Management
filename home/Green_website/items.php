<?php
require_once("./helper/function.php");
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

?>

<!DOCTYPE html>
<html>

<head>
    <title> Báo giá sản phẩm </title>
    <? include("./includes/inc_head.php"); ?>
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- CONTENT --------------->

    <?php $bread_topic = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id"); ?>
    <div id="shop">
        <div id="shop-container">
            <div class="container-fluid">
                <div class="breadcrumb">
                    <a href="index.php" target="_self">
                        Trang chủ
                    </a>

                    <span class="navigation-pipe">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <a href="shop.php" target="_self">Báo giá sản phẩm</a>
                </div>

                <div class="shop-title">Báo giá sản phẩm</div>

                <div class="product-container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="product-image">

                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12" style="padding-left: 20px">
                            <div class="product-content">
                                <div class="product-name">
                                    <span> Tên sản phẩm </span>
                                </div>

                                <div class="product-info">
                                    <p class="product-info-title"> Thông tin sản phẩm: </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>