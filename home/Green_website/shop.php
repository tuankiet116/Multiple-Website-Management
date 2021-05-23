<?php
require_once('../../classes/database.php');

$result_per_page = 12;

$arr_shop = array();
$sql = "SELECT * FROM produce";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_shop, $row);
    }
}
unset($result, $sql);
$result_number = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title> Báo giá sản phẩm </title>
    <? include("./includes/inc_head.php"); ?>
    <link rel="stylesheet" href="../Green_website/resource/css/shop.css">
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- CONTENT --------------->

    <div id="shop">
        <div id="shop-container">
            <div class="container-fluid">
                <div class="breadcrumb">
                    <a href="#" target="_self">Trang chủ</a>

                    <span class="navigation-pipe">
                        <i class="fas fa-chevron-right"></i>
                    </span>

                    <a href="#" target="_self">Báo giá sản phẩm</a>
                </div>

                <div class="shop-title"> Báo giá sản phẩm </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="shop-content">
                            <div class="shop-image">
                                <a href="#" target="_self">
                                    <img src="../Green_website/resource/images/rooftop-garden2.jpg" alt="shop image">

                                    <div class="shop-detail">
                                        <div> Chi tiết </div>
                                    </div>
                                </a>
                            </div>

                            <div class="shop-name">
                                <a href="#" target="_self">
                                    Sân vườn trên mái
                                </a>
                            </div>

                            <div class="shop-code">SP0113</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="shop-content">
                            <div class="shop-image">
                                <img src="../Green_website/resource/images/rooftop-garden2.jpg" alt="shop image">
                            </div>

                            <div class="shop-name">
                                Sân vườn trên mái
                            </div>

                            <div class="shop-code">SP0113</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="shop-content">
                            <div class="shop-image">
                                <img src="../Green_website/resource/images/rooftop-garden2.jpg" alt="shop image">
                            </div>

                            <div class="shop-name">
                                Sân vườn trên mái
                            </div>

                            <div class="shop-code">SP0113</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="shop-content">
                            <div class="shop-image">
                                <img src="../Green_website/resource/images/rooftop-garden2.jpg" alt="shop image">
                            </div>

                            <div class="shop-name">
                                Sân vườn trên mái
                            </div>

                            <div class="shop-code">SP0113</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="shop-content">
                            <div class="shop-image">
                                <img src="../Green_website/resource/images/rooftop-garden2.jpg" alt="shop image">
                            </div>

                            <div class="shop-name">
                                Sân vườn trên mái
                            </div>

                            <div class="shop-code">SP0113</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="shop-content">
                            <div class="shop-image">
                                <img src="../Green_website/resource/images/rooftop-garden2.jpg" alt="shop image">
                            </div>

                            <div class="shop-name">
                                Sân vườn trên mái
                            </div>

                            <div class="shop-code">SP0113</div>
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