<?php
require_once("./helper/function.php");
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

// $web_id = 2;

$per_page_record = 9;

if (isset($_GET['page'])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

if (isset($_GET['gid'])) {
    $gid = $_GET['gid'];
    $arr_gr_shop = get_data_rows("SELECT * FROM product WHERE web_id = $web_id AND product_gr_id = $gid");
    $get_gr_shop = get_data_row("SELECT * FROM product_group WHERE product_gr_id = $gid AND product_gr_active = 1");
}

$start_from = ($page - 1) * $per_page_record;

/********** SHOP **********/

$arr_shop = get_data_rows("SELECT * FROM product WHERE web_id = $web_id LIMIT $start_from, $per_page_record");

/********** PAGINATION **********/

$sql = "SELECT * FROM product";
$result = get_data_rows($sql);
$total_record = sizeof($result);
// $sql = "SELECT COUNT(*) FROM product";
// $result = new db_query($sql);
// $row = mysqli_fetch_row($result->result);
// $total_record = $row[0];
// unset($result, $sql);

$total_pages = ceil($total_record / $per_page_record);
$pageLink = "";

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

    <?php  $bread_topic = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id"); ?>
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
                <div class="shop-title">
                    <?php
                        if (!isset($_GET['gid'])) {
                            echo 'Báo giá sản phẩm';
                        } 
                        else if (isset($_GET['gid'])) {
                            echo $get_gr_shop['product_gr_name'];
                        }
                    ?>
                </div>
                
                <div class="row">
                    <?php
                    if (!isset($_GET['gid'])) {
                        foreach ($arr_shop as $key => $shop) {
                            if ($shop['product_active'] == 1) {
                                echo '
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="shop-content">
                                            <div class="shop-image">
                                                <a href="#" target="_self">
                                                    <img src="' . $base_url . $shop['product_image_path'] . '" alt="shop image">
                            
                                                    <div class="shop-detail">
                                                        <a href="items.php?id=' . $shop['product_id'] . '" target="_self">
                                                            <div> Chi tiết </div>
                                                        </a>
                                                    </div>
                                                    
                                                </a>

                                                <div class="new-sticker"> New </div>
                                            </div>

                                            <div class="shop-name">
                                                <a href="items.php?id=' . $shop['product_id'] . '" target="_self">
                                                    ' . $shop['product_name'] . '
                                                </a>
                                            </div>

                                            <div class="shop-des">
                                                <span class="price-numbers" style="font-size: 17px; font-weight: bold"> ' . $shop['product_price'] . ' </span>
                                                <span> ' . $shop['product_currency'] . '</span>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            else {
                                echo '';
                            }
                        }
                    }
                    else if (isset($_GET['gid'])) {
                        foreach ($arr_gr_shop as $key => $gr_shop) {
                            if ($gr_shop['product_active'] == 1) {
                                echo '
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="shop-content">
                                            <div class="shop-image">
                                                <a href="#" target="_self">
                                                    <img src="' . $base_url . $gr_shop['product_image_path'] . '" alt="shop image">
                            
                                                    <div class="shop-detail">
                                                        <a href="items.php?id=' . $gr_shop['product_id'] . '" target="_self">
                                                            <div> Chi tiết </div>
                                                        </a>
                                                    </div>
                                                    
                                                </a>

                                                <div class="new-sticker"> New </div>
                                            </div>

                                            <div class="shop-name">
                                                <a href="items.php?id=' . $gr_shop['product_id'] . '" target="_self">
                                                    ' . $gr_shop['product_name'] . '
                                                </a>
                                            </div>

                                            <div class="shop-des">
                                                <span class="price-numbers" style="font-size: 17px; font-weight: bold"> ' . $gr_shop['product_price'] . ' </span>
                                                <span> ' . $gr_shop['product_currency'] . '</span>
                                            </div>
                                        </div>
                                    </div>';
                            } else {
                                echo '';
                            }
                        }
                    }
                    ?>
                </div>
            </div>

            <div id="pagination">
                <?php
                echo "
                    <div id='pag-btn'>
                        <a href='shop.php?page=" . ($page - 1) . "'> 
                            <button type='button' id='prev-btn'> 
                                <i class='fas fa-chevron-left'></i>
                            </button>
                        </a>

                        <div id='prev-disable'></div>
                    </div>";

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $pageLink .= "<a class='pages-number active' href='shop.php?page="
                            . $i . "'>" . $i . " </a>";
                    } else {
                        $pageLink .= "<a class='pages-number' href='shop.php?page=" . $i . "'>   
                                        " . $i . " </a>";
                    }
                };
                echo $pageLink;

                echo "
                    <div id='pag-btn'>
                        <a href='shop.php?page=" . ($page + 1) . "'> 
                            <button type='button' id='next-btn'>
                                <i class='fas fa-chevron-right'></i>
                            </button>
                        </a>

                        <div id='next-disable'></div>
                    </div>";

                if ($page == 1) {
                    echo "
                        <script type='text/javascript'>
                            var prev_disable = document.getElementById('prev-disable');
                            prev_disable.style.display = 'block';

                            var prev_button = document.getElementById('prev-btn');
                            prev_button.style.display = 'none';
                        </script>";
                }

                if ($page == $total_pages) {
                    echo "
                        <script type='text/javascript'>
                            var next_disable = document.getElementById('next-disable');
                            next_disable.style.display = 'block';

                            var next_button = document.getElementById('next-btn');
                            next_button.style.display = 'none';
                        </script>";
                }
                ?>
            </div>
        </div>
    </div>

    <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>