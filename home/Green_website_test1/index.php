<?php
require_once('./helper/function.php');
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

$get_url = get_data_row("SELECT con_rewrite_name_homepage FROM configuration WHERE web_id = $web_id");
foreach ($get_url as $key => $g_url) {
    $url = $g_url;
}

$per_page_record = 9;

if (isset($_GET['page'])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;

if (isset($_GET['url'])) {
    $url_rough = $_GET['url'];
    $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url_rough);
}

if (strpos($url, "/") != false) {
    $url = $g_url;
    header('location: ../');
}

$category = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id");
$arr_con = get_data_row("SELECT * FROM configuration WHERE web_id = $web_id");

$get_slide = get_data_row("SELECT con_background_homepage FROM configuration WHERE web_id = $web_id");
$url_slide = explode(",", $get_slide['con_background_homepage']);

$post_type = get_data_rows("SELECT * FROM post_type WHERE allow_show_homepage = 1 AND web_id = $web_id");

$sql = "SELECT * FROM product";
$result = get_data_rows($sql);
$total_record = sizeof($result);
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
    <title><?php echo $arr_con['con_site_title'] ?></title>
    <? include("./includes/inc_head.php"); ?>
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- USER --------------->

    <? include('./includes/inc_modal.php'); ?>

    <!--------------- SLIDESHOW --------------->

    <div class="content">
        <div class="container-fluid">
            <div class="main-slide">
                <?php
                    foreach ($url_slide as $key => $url) { ?>
                        <div class="main-slide-img">
                            <img src="<?php echo $base_url . $url ?>" alt="Slideshow image">
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
                $pt_id = $pt['post_type_id'];
                $post = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id AND post_image_background IS NOT NULL AND post_active = 1"); ?>
                <div class="container">
                    <?php
                    if ($pt['post_type_show'] == 'grid' && $pt['post_type_active'] == 1) {
                        echo '
                            <div class="title">
                                <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                <p class="sub-title">
                                    ' . $pt['post_type_description'] . '
                                </p>
                                <div class="line-title"></div>
                            </div>';

                        echo '<div class="row">';
                        foreach ($post as $key => $p) {
                            foreach ($category as $key => $cate) {
                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                if ($mod_rewrite == 1) {
                                    $changeUrlName = 'name=' . $p['post_rewrite_name'];
                                    $changeUrlBread = '&breadcrumbs=' . $cate['cmp_rewrite_name'];
                                } else {
                                    $changeUrlName = 'name=' . $p['post_id'];
                                    $changeUrlBread = '&breadcrumbs=' . $cate['cmp_id'];
                                }
                                if ($p['cmp_id'] == $cate['cmp_id']) {
                                    echo '
                                            <div class="col-lg-6">
                                                <div class="services">
                                                    <a href="news.php?' . $changeUrlName . '&title=' . $p['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $p['ptd_id'] . '" target="_self">
                                                        <div class="sv-img">
                                                            <img src="' . $base_url . $p['post_image_background'] . '" alt="garden">
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
                            }
                        }
                        echo '</div>';
                    } else if ($pt['post_type_show'] == 'slide' && $pt['post_type_active'] == 1) {
                        echo '
                            <div class="title">
                                <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                <p class="sub-title">
                                    ' . $pt['post_type_description'] . '
                                </p>
                                <div class="line-title"></div>
                            </div>'; ?>

                        <div class="row mx-auto my-auto">
                            <div id="myCarousel" class="myCarousel-<?php echo $pt['post_type_id']; ?> carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner w-100" role="listbox">
                                    <?php foreach ($post as $key => $p) {
                                        foreach ($category as $key => $cate) {
                                            if ($p['cmp_id'] == $cate['cmp_id']) {
                                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                                if ($mod_rewrite == 1) {
                                                    $changeUrlName = 'name=' . $p['post_rewrite_name'];
                                                    $changeUrlBread = '&breadcrumbs=' . $cate['cmp_rewrite_name'];
                                                } else {
                                                    $changeUrlName = 'name=' . $p['post_id'];
                                                    $changeUrlBread = '&breadcrumbs=' . $cate['cmp_id'];
                                                }
                                                echo '
                                                    <div class="carousel-item">
                                                        <div class="carousel-img col-lg-4 col-md-6 col-sm-12 col-12">       
                                                            <div class="carousel-content">
                                                                <a href="news.php?' . $changeUrlName . '&title=' . $p['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $p['ptd_id'] . '" target="_self">
                                                                    <img class="img-fluid" src="' . $base_url . $p['post_image_background'] . '" alt="carousel image">
                                                                    <div class="carousel-title">
                                                                        ' . $p['post_title'] . '
                                                                        <div class="carousel-text">' . $p['post_description'] . '</div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                        }
                                    } ?>
                                    <a class="carousel-control-prev bg-dark " href=".myCarousel-<?php echo $pt['post_type_id']; ?>" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next bg-dark " href=".myCarousel-<?php echo $pt['post_type_id']; ?>" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($pt['post_type_show'] == 'special' && $pt['post_type_active'] == 1) {
                        echo '
                            <div class="title">
                                <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                <p class="sub-title">
                                    ' . $pt['post_type_description'] . '
                                </p>
                                <div class="line-title"></div>
                            </div>'; ?>

                        <div class="row">
                            <?php
                            $post_left = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id AND post_active = 1 LIMIT 1");
                            foreach ($post_left as $key => $p_left) {
                                foreach ($category as $key => $cate) {
                                    if ($p['cmp_id'] == $cate['cmp_id']) {
                                        $mod_rewrite = $arr_con['con_mod_rewrite'];
                                        if ($mod_rewrite == 1) {
                                            $changeUrlName = 'name=' . $p_left['post_rewrite_name'];
                                            $changeUrlBread = '&breadcrumbs=' . $cate['cmp_rewrite_name'];
                                        } else {
                                            $changeUrlName = 'name=' . $p_left['post_id'];
                                            $changeUrlBread = '&breadcrumbs=' . $cate['cmp_id'];
                                        }
                                        echo '
                                            <div class="choose-container col-lg-6">
                                                <a class="choose-left" href="news.php?' . $changeUrlName . '&title=' . $p_left['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $p_left['ptd_id'] . '" target="_self">
                                                    <img src="' . $base_url . $p_left['post_image_background'] . '" alt="choose image left">
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
                                }
                            }
                            ?>

                            <div class="choose-container col-lg-6">
                                <div class="row">
                                    <?php
                                    $post_right = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id AND post_active = 1 LIMIT 4 OFFSET 1");
                                    foreach ($post_right as $key => $p_right) {
                                        foreach ($category as $key => $cate) {
                                            if ($p['cmp_id'] == $cate['cmp_id']) {
                                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                                if ($mod_rewrite == 1) {
                                                    $changeUrlName = 'name=' . $p_right['post_rewrite_name'];
                                                    $changeUrlBread = '&breadcrumbs=' . $cate['cmp_rewrite_name'];
                                                } else {
                                                    $changeUrlName = 'name=' . $p_right['post_id'];
                                                    $changeUrlBread = '&breadcrumbs=' . $cate['cmp_id'];
                                                }
                                                echo '
                                                    <div class="choose-right-container col-lg-6 col-md-6 col-sm-6 col-6">
                                                        <a class="choose-right" href="news.php?' . $changeUrlName . '&title=' . $p_right['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $p_right['ptd_id'] . '" target="_self">
                                                            <img src="' . $base_url . $p_right['post_image_background'] . '" alt="choose right image">
                                                            <div class="choose-right-content">
                                                                <div class="choose-right-text">
                                                                    <p class="choose-right-title">' . $p_right['post_title'] . '</p>
                                                                    <div class="choose-right-line"></div>
                                                                    <p class="choose-right-word">' . $p_right['post_description'] . '</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php
            $banner = get_data_row("SELECT * FROM configuration WHERE con_banner_active = 1 AND web_id = $web_id");
            echo '
                    <div id="contact">
                        <img src="' . $base_url . $banner['con_banner_image'] . '" alt="contact image">
                    </div>';
            ?>

            <div class="container">
                <div class="title">
                    <p class="main-title"> Bài viết mới nhất </p>
                    <p class="sub-title"></p>
                    <div class="line-title"></div>
                </div>

                <div class="row">
                    <?php
                    $news = get_data_rows("SELECT * FROM post WHERE post_image_background IS NOT NULL AND 
                                                   post_active = 1 ORDER BY post_datetime_create DESC LIMIT 6");
                    foreach ($news as $key => $n) {
                        foreach ($category as $key => $cate) {
                            $mod_rewrite = $arr_con['con_mod_rewrite'];
                            if ($mod_rewrite == 1) {
                                $changeUrlName = 'name=' . $n['post_rewrite_name'];
                                $changeUrlBread = '&breadcrumbs=' . $cate['cmp_rewrite_name'];
                            } else {
                                $changeUrlName = 'name=' . $n['post_id'];
                                $changeUrlBread = '&breadcrumbs=' . $cate['cmp_id'];
                            }

                            if ($n['cmp_id'] == $cate['cmp_id']) {
                                $news_date = $n['post_datetime_create'];
                                $my_newsDate = date("d-m-Y", strtotime($news_date));

                                echo '
                                            <div class="news col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="row news-all">
                                                    <div class="news-img col-lg-6 col-md-12 col-sm-12 col-12">
                                                        <a href="news.php?' . $changeUrlName . '&title=' . $n['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $n['ptd_id'] . '" target="_self">
                                                            <img src="' . $base_url . $n['post_image_background'] . '" alt="news image">
                                                        </a>
                                                    </div>
                                                    <div class="news-content col-lg-6 col-md-12 col-sm-12 col-12">
                                                        <p class="news-date">' . $my_newsDate . '</p>
                                                        <a href="news.php?' . $changeUrlName . '&title=' . $n['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $n['ptd_id'] . '" target="_self" class="news-title">' . $n['post_title'] . '</a>
                                                        <a href="news.php?' . $changeUrlName . '&title=' . $n['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $n['ptd_id'] . '" target="_self" class="news-viewmore">
                                                            <i class="fas fa-angle-right"></i>
                                                            Xem tiếp
                                                        </a>
                                                    </div>
                                                    <div class="news-color-line"></div>
                                                </div>
                                            </div>';
                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>



    <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>