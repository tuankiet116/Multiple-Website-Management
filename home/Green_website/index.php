<?php
require_once('./helper/function.php');

$web_id = 2;
$url = 'trang-chu';

$per_page_record = 9;

if (isset($_GET['page'])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;

if (isset($_GET['url'])) {
    $url = $_GET['url'];
}

if (isset($_GET['page'])) {
    echo '<h1>' . $_GET['page'] . '</h1>';
}

if (strpos($url, "/") != false) {
    header('location: ../home/Green_website/');
}

$category = get_data_row("SELECT cmp_background, bgt_type, cmp_active, cmp_name, cmp_rewrite_name, cmp_id FROM categories_multi_parent WHERE cmp_rewrite_name = '$url' AND web_id = $web_id");

$url_slide = explode(",", $category['cmp_background']);
if (empty($category) || $category['cmp_active'] == 0) {
    header('location: http://localhost:8091/home/Green_website/');
}

$post_type = get_data_rows("SELECT * FROM post_type");

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
    <title>
        <?php
        if ($category['cmp_name'] == 'trang ch?') {
            echo 'Thi?t k? thi công sân vu?n';
        } else {
            echo $category['cmp_name'];
        }
        ?>
    </title>
    <? include("./includes/inc_head.php"); ?>
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- SLIDESHOW --------------->

    <div class="content">
        <div class="container-fluid">
            <div class="owl-carousel owl-1">
                <?php
                if ($category['bgt_type'] == 'slide') {
                    foreach ($url_slide as $key => $url) { ?>
                        <div>
                            <img src="../../../data/image/images/Web-2/slideshow/<?php echo $url ?>" alt="Carousel background" class="img-fluid">
                        </div>
                <?php }
                } ?>

                <?php
                if ($category['bgt_type'] == 'static') { ?>
                    <div>
                        <img src="../../../data/image/images/Web-2/slideshow/<?php echo $url_slide[0] ?>" alt="Carousel background" class="img-fluid">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--------------- CONTENT --------------->

    <div id="main-container">
        <div class="container-fluid">
            <?php
            foreach ($post_type as $key => $pt) {
                $arr_cmp_id = explode(",", $pt['cmp_id']);
                if (in_array($category['cmp_id'], $arr_cmp_id)) {
                    $pt_id = $pt['post_type_id'];
                    $post = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id");
                    if ($pt['post_type_show'] == 1) { ?>
                        <div class="container">
                            <?php echo '
                            <div class="title">
                                <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                <p class="sub-title">
                                    ' . $pt['post_type_description'] . '
                                </p>
                                <div class="line-title"></div>
                            </div>';

                            $pt_cmp_id = $pt['cmp_id'];

                            echo '<div class="row">';

                            foreach ($post as $key => $p) {
                                echo '
                                    <div class="col-lg-6">
                                        <div class="services">
                                            <a href="news.php?name=' . $p['post_rewrite_name'] . '&title=' . $p['post_title'] . '&breadcrumbs=' . $category['cmp_rewrite_name'] . '&nameBreadcrumbs=' . $category['cmp_name'] . '&postNews=' . $p['ptd_id'] . '" target="_self">
                                                <div class="sv-img">
                                                    <img src="../../data/image/images/Web-2/' . $p['post_image_background'] . '" alt="garden">
                                                </div>
                                                <div class="sv-title">
                                                    <p> ' . $p['post_title'] . ' </p>
                                                </div>
                                                <div class="sv-text">
                                                    <p>
                                                        ' . $p['post_description'] . '
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>';
                            }
                            echo '</div>'; ?>
                        </div> <?php
                            } else if ($pt['post_type_show'] == 2 && $pt['cmp_id'] == $pt_cmp_id) {
                                echo '<div class="container text-center">';

                                echo '
                                <div class="title">
                                    <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                    <p class="sub-title">
                                        ' . $pt['post_type_description'] . '
                                    </p>
                                    <div class="line-title"></div>
                                </div>'; ?>

                        <div class="row mx-auto my-auto">
                            <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner w-100" role="listbox">';
                                    <?php foreach ($post as $key => $p) {
                                        echo '
                                                    <div class="carousel-item">
                                                        <div class="carousel-img col-lg-4 col-md-6 col-sm-12 col-12">
                                                            <div class="carousel-content">
                                                                <img class="img-fluid" src="../../data/image/images/Web-2/' . $p['post_image_background'] . '" alt="carousel image">
                                                                <div class="carousel-title">
                                                                    ' . $p['post_title'] . '
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                    } ?>
                                    <a class="carousel-control-prev bg-dark " href="#myCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next bg-dark " href="#myCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php echo '</div>';
                            } else if ($pt['post_type_show'] == 3 && $pt['cmp_id'] == $pt_cmp_id) { ?>
                        <div class="container">
                            <?php
                                echo '   
                                <div class="title">
                                    <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                    <p class="sub-title">
                                        ' . $pt['post_type_description'] . '
                                    </p>
                                    <div class="line-title"></div>
                                </div>';
                            ?>
                            <div class="row">
                                <?php
                                $post_left = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id LIMIT 1");
                                foreach ($post_left as $key => $p_left) {
                                    echo '
                                        <div class="choose-container col-lg-6">
                                            <a class="choose-left" href="#" target="_self">
                                                <img src="../../data/image/images/Web-2/' . $p_left['post_image_background'] . '" alt="choose image left">
                                                <div class="choose-content">
                                                    <div class="choose-text">
                                                        <p class="choose-title">' . $p_left['post_title'] . '</p>
                                                        <div class="choose-line"></div>
                                                        <p class="choose-word">' . $p_left['post_description'] . '</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>';
                                }
                                ?>

                                <div class="choose-container col-lg-6">
                                    <div class="row">
                                        <?php
                                        $post_right = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id LIMIT 4 OFFSET 1");
                                        foreach ($post_right as $key => $p_right) {
                                            echo '
                                                <div class="choose-right-container col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <a class="choose-right" href="#" target="_self">
                                                        <img src="../../data/image/images/Web-2/' . $p_right['post_image_background'] . '" alt="choose right image">
                                                        <div class="choose-right-content">
                                                            <div class="choose-right-text">
                                                                <p class="choose-right-title">' . $p_right['post_title'] . '</p>
                                                                <div class="choose-right-line"></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php   } else if ($pt['post_type_show'] == 4 && $pt['cmp_id'] == $pt_cmp_id) {
                                foreach ($post as $key => $p) {
                                    if ($p['post_rewrite_name'] == 'banner') {
                                        echo '
                                    <div id="contact">
                                        <img src="../../data/image/images/Web-2/' . $p['post_image_background'] . '" alt="contact image">
                                    </div>
                                ';
                                    }
                                }
                            } else if ($pt['post_type_show'] == 5 && $pt['cmp_id'] == $pt_cmp_id) { ?>
                        <div class="container">
                            <?php
                                echo '   
                                <div class="title">
                                    <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                    <p class="sub-title">
                                        ' . $pt['post_type_description'] . '
                                    </p>
                                    <div class="line-title"></div>
                                </div>';
                            ?>

                            <div class="row">
                                <?php
                                $post_news = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id ORDER BY post_datetime_create DESC LIMIT 5");
                                foreach ($post_news as $key => $p_news) {
                                    if ($p_news['post_image_background'] != '') {
                                        $date = $p_news['post_datetime_create'];
                                        $myDate = date("d-m-Y", strtotime($date));

                                        echo '
                                        <div class="news col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="row news-all">
                                                <div class="news-img col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <a href="" target="_self">
                                                        <img src="../../data/image/images/Web-2/' . $p_news['post_image_background'] . '" alt="news image">
                                                    </a>
                                                </div>
                                                <div class="news-content col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <p class="news-date">' . $myDate . '</p>
                                                    <a href="" target="_self" class="news-title">
                                                        ' . $p_news['post_title'] . '
                                                    </a>
                                                    <a href="" target="_self" class="news-viewmore">
                                                        <i class="fas fa-angle-right"></i>
                                                        Xem ti?p
                                                    </a>
                                                </div>
                                                <div class="news-color-line"></div>
                                            </div>
                                        </div>';
                                    }
                                }
                                ?>

                                <?php
                                foreach ($post as $key => $p) {
                                    if ($p['post_image_background'] == '') {
                                        echo '
                                                <div class="see-more">
                                                    <a href="#" target="_self">
                                                        <i class="fas fa-angle-double-right"></i>
                                                        ' . $p['post_title'] . '
                                                    </a>
                                                </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
            <?php   } else {
                                $shop_topic = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id");
                                echo '<div id="shop">';
                                echo '   <div id="shop-container">';
                                echo '       <div class="container-fluid">
                                        <div class="breadcrumb">';
                                foreach ($shop_topic as $key => $shop) {
                                    if ($shop['cmp_rewrite_name'] == 'trang-chu') {
                                        echo '
                                                        <a href="' . $shop['cmp_rewrite_name'] . '" target="_self">' . $shop['cmp_name'] . '</a>';
                                    }

                                    if ($shop['cmp_rewrite_name'] == 'san-pham') {
                                        echo '
                                                            <span class="navigation-pipe">
                                                                <i class="fas fa-chevron-right"></i>
                                                            </span>
                                                            <a href="' . $shop['cmp_rewrite_name'] . '" target="_self">' . $shop['cmp_name'] . '</a>
                                                        </div>
                                                        <div class="shop-title">' . $shop['cmp_name'] . '</div>';
                                    }
                                }
                                echo '           <div class="row">';

                                $produce = get_data_rows("SELECT * FROM produce WHERE produce_active = 1 LIMIT $start_from, $per_page_record");
                                foreach ($produce as $key => $pr) {
                                    echo '
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <div class="shop-content">
                                                            <div class="shop-image">
                                                                <a href="#" target="_self">
                                                                    <img src="../../data/image/images/Web-2/' . $pr['produce_image_path'] . '" alt="shop image">
                                                                    <div class="shop-detail">
                                                                        <div> Chi ti?t </div>
                                                                    </div>
                                                                </a>
                                                                <div class="new-sticker"> New </div>
                                                            </div>
                                                            <div class="shop-name">
                                                                <a href="#" target="_self">
                                                                    ' . $pr['produce_name'] . '
                                                                </a>
                                                            </div>
                                                            <div class="shop-code">' . $pr['produce_description'] . '</div>
                                                        </div>
                                                    </div>
                                                ';
                                }
                                echo '           </div>';
                                echo '       </div>';

                                echo '      <div id="pagination">
                                        <div id="pag-btn">
                                            <a href="shop.php?page=' . ($page - 1) . '"> 
                                                <button type="button" id="prev-btn"> 
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                            </a>

                                            <div id="prev-disable"></div>
                                        </div>';

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
                                echo '       </div>';
                                echo '   </div>';
                                echo '</div>';
                            }
                        }
                    } ?>
        </div>
    </div>

    <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>