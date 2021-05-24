<?php
require_once('../../classes/database.php');

$per_page_record = 9;

if (isset($_GET['page'])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;

/********** SHOP **********/

$arr_shop = array();
$sql = "SELECT * FROM produce LIMIT $start_from, $per_page_record";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_shop, $row);
    }
}
unset($result, $sql);

/********** PAGINATION **********/

$arr_count = array();
$sql = "SELECT COUNT(*) FROM produce";
$result = new db_query($sql);
$row = mysqli_fetch_row($result->result);
$total_record = $row[0];
unset($result, $sql);

$total_pages = ceil($total_record / $per_page_record);
$pageLink = "";

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
                    <a href="#" target="_self">Trang chủ </a>

                    <span class="navigation-pipe">
                        <i class="fas fa-chevron-right"></i>
                    </span>

                    <a href="#" target="_self">Báo giá sản phẩm</a>
                </div>

                <div class="shop-title"> Báo giá sản phẩm </div>

                <div class="row">
                    <?php
                    foreach ($arr_shop as $key => $shop) {
                        if ($shop['produce_active'] == 1) {
                            echo '
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="shop-content">
                                        <div class="shop-image">
                                            <a href="#" target="_self">
                                                <img src="' . $shop['produce_image_path'] . '" alt="shop image">

                                                <div class="shop-detail">
                                                    <div> Chi tiết </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="shop-name">
                                            <a href="#" target="_self">
                                                ' . $shop['produce_name'] . '
                                            </a>
                                        </div>

                                        <div class="shop-code">' . $shop['produce_description'] . '</div>
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
                                prev_button.style.backgroundColor = 'rgb(210, 210, 210)';
                            </script>";
                    }

                    if ($page == $total_pages) {
                        echo "
                            <script type='text/javascript'>
                                var next_disable = document.getElementById('next-disable');
                                next_disable.style.display = 'block';

                                var next_button = document.getElementById('next-btn');
                                next_button.style.backgroundColor = 'rgb(210, 210, 210)';
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