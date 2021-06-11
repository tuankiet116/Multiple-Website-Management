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
                <div class="shop-title">Báo giá sản phẩm</div>
                
                <div class="row">
                    <?php
                    foreach ($arr_shop as $key => $shop) {
                        if ($shop['product_active'] == 1) {
                            echo'
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="shop-content">
                                    <div class="shop-image">
                                        <a href="#" target="_self">
                                            <img src="' . $base_url . $shop['product_image_path'] . '" alt="shop image">

                                            <div class="shop-detail">
                                                <div> Chi tiết </div>
                                            </div>
                                        </a>

                                        <div class="new-sticker"> New </div>
                                    </div>

                                    <div class="shop-name">
                                        <a href="#" target="_self">
                                            ' . $shop['product_name'] . '
                                        </a>
                                    </div>

                                    <div class="shop-code">' . $shop['product_description'] . '</div>
                                </div>
                            </div>';
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