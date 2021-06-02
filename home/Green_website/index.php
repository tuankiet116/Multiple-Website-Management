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
    header('location: ./');
}

$category = get_data_row("SELECT cmp_background, bgt_type, cmp_active, cmp_name, cmp_rewrite_name, cmp_id, post_type_id FROM categories_multi_parent WHERE cmp_rewrite_name = '$url' AND web_id = $web_id");
$arr_post_type_id = explode(',', $category['post_type_id']);
$handle_post_type_id = implode("','", $arr_post_type_id);

$url_slide = explode(",", $category['cmp_background']);
if (empty($category) || $category['cmp_active'] == 0) {
    header('location: ./index.php');
}

$post_type = get_data_rows("SELECT * FROM post_type WHERE post_type_id IN ('".$handle_post_type_id."') AND allow_show_homepage = 1 AND web_id = $web_id");

$sql = "SELECT COUNT(*) FROM product";
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
        if ($category['cmp_name'] == 'Trang chủ') {
            echo 'Thiết kế thi công sân vườn';
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
                $pt_id = $pt['post_type_id'];
                $post = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id"); ?>
                <div class="container">
                    <?php 

                    if ($pt['post_type_show'] == 'grid' && $pt['post_type_active'] == 1) {
                        echo'
                            <div class="title">
                                <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                <p class="sub-title">
                                    ' . $pt['post_type_description'] . '
                                </p>
                                <div class="line-title"></div>
                            </div>';

                        echo'<div class="row">';
                        foreach ($post as $key => $p) {        
                            echo'
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
                        echo'</div>'; 
                    } 
                    else if ($pt['post_type_show'] == 'slide' && $pt['post_type_active'] == 1) {
                        echo'
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
                                        echo'
                                            <div class="carousel-item">
                                                <div class="carousel-img col-lg-4 col-md-6 col-sm-12 col-12">       
                                                    <div class="carousel-content">
                                                        <a href="news.php?name=' . $p['post_rewrite_name'] . '&title=' . $p['post_title'] . '&breadcrumbs=' . $category['cmp_rewrite_name'] . '&nameBreadcrumbs=' . $category['cmp_name'] . '&postNews=' . $p['ptd_id'] . '" target="_self">
                                                            <img class="img-fluid" src="../../data/image/images/Web-2/' . $p['post_image_background'] . '" alt="carousel image">
                                                            <div class="carousel-title">
                                                                ' . $p['post_title'] . '
                                                                <div class="carousel-text">' . $p['post_description'] . '</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>';
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
                    <?php } 
                    else if ($pt['post_type_show'] == 'special' && $pt['post_type_active'] == 1) {
                        echo'
                            <div class="title">
                                <p class="main-title"> ' . $pt['post_type_title'] . ' </p>
                                <p class="sub-title">
                                    ' . $pt['post_type_description'] . '
                                </p>
                                <div class="line-title"></div>
                            </div>'; ?>

                        <div class="row">
                            <?php
                            $post_left = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id LIMIT 1");
                            foreach ($post_left as $key => $p_left) {
                                echo'
                                    <div class="choose-container col-lg-6">
                                        <a class="choose-left" href="news.php?name=' . $p_left['post_rewrite_name'] . '&title=' . $p_left['post_title'] . '&breadcrumbs=' . $category['cmp_rewrite_name'] . '&nameBreadcrumbs=' . $category['cmp_name'] . '&postNews=' . $p_left['ptd_id'] . '" target="_self">
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
                                                <a class="choose-right" href="news.php?name=' . $p_right['post_rewrite_name'] . '&title=' . $p_right['post_title'] . '&breadcrumbs=' . $category['cmp_rewrite_name'] . '&nameBreadcrumbs=' . $category['cmp_name'] . '&postNews=' . $p_right['ptd_id'] . '" target="_self">
                                                    <img src="../../data/image/images/Web-2/' . $p_right['post_image_background'] . '" alt="choose right image">
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
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                </div> 
                <?php
                    if ($pt['post_type_show'] == '' && $pt['post_type_title'] == '' && $pt['post_type_description'] == '' && $pt['post_type_active'] == 1) {
                        $banner = get_data_rows("SELECT * FROM configuration WHERE web_id = $web_id");
                        foreach ($banner as $key => $b) {
                            echo '
                                <div id="contact">
                                    <img src="../../data/image/images/Web-2/' . $b['con_banner_image'] . '" alt="contact image">
                                </div>';
                        }
                    }
                ?>
            <?php 
                
            } 
            ?>
                    
        </div>
    </div>

    <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>