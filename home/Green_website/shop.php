<?php
require_once("./helper/function.php");

$per_page_record = 9;

if (isset($_GET['page'])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;

/********** SHOP **********/

$arr_shop = get_data_rows("SELECT * FROM produce LIMIT $start_from, $per_page_record");

/********** PAGINATION **********/

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
    <title> Báo giá s?n ph?m </title>
    <? include("./includes/inc_head.php"); ?>
    <link rel="stylesheet" href="../Green_website/resource/css/shop.css">
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
                    <?php
                    foreach ($bread_topic as $key => $bread) {
                        if ($bread['cmp_rewrite_name'] == 'trang-chu') {
                            echo '
                                    <a href="' . $bread['cmp_rewrite_name'] . '" target="_self">' . $bread['cmp_name'] . '</a>';
                        }

                        if ($bread['cmp_rewrite_name'] == 'san-pham') {
                            echo '
                                    <span class="navigation-pipe">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <a href="' . $bread['cmp_rewrite_name'] . '" target="_self">' . $bread['cmp_name'] . '</a>
                                </div>
                                <div class="shop-title">' . $bread['cmp_name'] . '</div>';
                        }
                    } ?>

                    <div class="row">
                        <?php
                        foreach ($arr_shop as $key => $shop) {
                            if ($shop['produce_active'] == 1) {
                                echo '
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="shop-content">
                                        <div class="shop-image">
                                            <a href="#" target="_self">
                                                <img src="../../data/image/images/Web-2/' . $shop['produce_image_path'] . '" alt="shop image">

                                                <div class="shop-detail">
                                                    <div> Chi ti?t </div>
                                                </div>
                                            </a>

                                            <div class="new-sticker"> New </div>
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