<?php
require_once('../../classes/database.php');

/********** TITLE **********/

$arr_title = array();
$sql = "SELECT * FROM post_type";
$result = new db_query($sql);
unset($result, $sql);

/********** POST **********/

$arr_post = array();
$sql = "SELECT * FROM post";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_post, $row);
    }
}
unset($result, $sql);

/********** CAROUSEL **********/

$arr_carousel = array();
$sql = "SELECT * FROM categories_multi_parent WHERE bgt_type = 'carousel' AND $web_id";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_carousel, $row);
    }
}
unset($result, $sql);

/********** IMAGE BANNER **********/

$arr_banner = array();
$sql = "SELECT * FROM categories_multi_parent WHERE bgt_type = 'banner' AND $web_id";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_banner, $row);
    }
}
unset($result, $sql);
?>

<div id="main-container">
    <div class="container">
        <?php
        foreach ($arr_title as $key => $title) {
            if ($title['post_type_id'] == 1 && $title['post_type_show'] == 'title') {
                echo '
                        <div class="title">
                            <p class="main-title"> ' . $title['post_type_title'] . ' </p>
                            <p class="sub-title">
                                ' . $title['post_type_description'] . '
                            </p>
                            <div class="line-title"></div>
                        </div>';
            }
        }
        ?>
        <div class="row">

            <?php
            foreach ($arr_post as $key => $post) {
                if ($post['cmp_id'] == 3) {
                    echo '
                        <div class="col-lg-6">
                            <div class="services">
                                <a href="./news.php" target="_self">
                                    <div class="sv-img">
                                        <img src="' . $post['post_image_background'] . '" alt="garden">
                                    </div>
                                    <div class="sv-title">
                                        <p> ' . $post['post_title'] . ' </p>
                                    </div>
                                    <div class="sv-text">
                                        <p>
                                            ' . $post['post_description'] . '
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>';
                }
            }
            ?>
        </div>
    </div>
    <div class="container text-center">
        <?php
        foreach ($arr_title as $key => $title) {
            if ($title['post_type_id'] == 2 && $title['post_type_show'] == 'title') {
                echo '
                        <div class="title">
                            <p class="main-title"> ' . $title['post_type_title'] . ' </p>
                            <div class="line-title"></div>
                        </div>';
            }
        }
        ?>
        <div class="row mx-auto my-auto">
            <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    <?php
                    foreach ($arr_carousel as $key => $carousel) {
                        if ($carousel['cmp_active'] == 1) {
                            echo '
                                    <div class="carousel-item">
                                        <div class="carousel-img col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="carousel-content">
                                                <img class="img-fluid" src=" ' . $carousel['cmp_background'] . ' " alt="carousel image">
                                                <div class="carousel-title">
                                                    ' . $carousel['cmp_name'] . '
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }
                    ?>
                </div>
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
    <div class="container">
        <?php
        foreach ($arr_title as $key => $title) {
            if ($title['post_type_id'] == 3 && $title['post_type_show'] == 'title') {
                echo '
                        <div class="title">
                            <p class="main-title"> ' . $title['post_type_title'] . ' </p>
                            <div class="line-title" style="margin-top: 25px;"></div>
                        </div>';
            }
        }
        ?>
        <div class="row">
            <?php
            foreach ($arr_post as $key => $post) {
                if ($post['cmp_id'] == 7 && $post['post_description'] != '') {
                    echo '
                        <div class="choose-container col-lg-6">
                            <a class="choose-left" href="#" target="_self">
                                <img src="' . $post['post_image_background'] . '" alt="choose image left">
                                <div class="choose-content">
                                    <div class="choose-text">
                                        <p class="choose-title">' . $post['post_title'] . '</p>
                                        <div class="choose-line"></div>
                                        <p class="choose-word">' . $post['post_description'] . '</p>
                                    </div>
                                </div>
                            </a>
                        </div>';
                }
            }
            ?>

            <div class="choose-container col-lg-6">
                <div class="row">
                    <?php
                    foreach ($arr_post as $key => $post) {
                        if ($post['cmp_id'] == 7 && $post['post_description'] == '') {
                            echo '
                                <div class="choose-right-container col-lg-6 col-md-6 col-sm-6 col-6">
                                    <a class="choose-right" href="#" target="_self">
                                        <img src="' . $post['post_image_background'] . '" alt="choose right image">
                                        <div class="choose-right-content">
                                            <div class="choose-right-text">
                                                <p class="choose-right-title">' . $post['post_title'] . '</p>
                                                <div class="choose-right-line"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    foreach ($arr_banner as $key => $banner) {
        if ($banner['cmp_active'] == 1) {
            echo '
                <div id="contact">
                    <img src="' . $banner['cmp_background'] . '" alt="contact image">
                </div>';
        }
    }
    ?>

    <div class="container">
        <?php
        foreach ($arr_title as $key => $title) {
            if ($title['post_type_id'] == 4 && $title['post_type_show'] == 'title') {
                echo '
                        <div class="title">
                            <p class="main-title"> ' . $title['post_type_title'] . ' </p>
                            <p class="sub-title">
                                ' . $title['post_type_description'] . '
                            </p>
                            <div class="line-title"></div>
                        </div>';
            }
        }
        ?>

        <div class="row">
            <?php
            foreach ($arr_post as $key => $post) {
                if ($post['cmp_id'] == 8 && $post['post_description'] == '' && $post['post_meta_description'] != 'more') {
                    echo '
                        <div class="news col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row news-all">
                                <div class="news-img col-lg-6 col-md-12 col-sm-12 col-12">
                                    <a href="./news.php" target="_self">
                                        <img src="' . $post['post_image_background'] . '" alt="news image">
                                    </a>
                                </div>
                                <div class="news-content col-lg-6 col-md-12 col-sm-12 col-12">
                                    <p class="news-date">' . $post['post_datetime_create'] . '</p>
                                    <a href="" target="_self" class="news-title">
                                        ' . $post['post_title'] . '
                                    </a>
                                    <a href="" target="_self" class="news-viewmore">
                                        <i class="fas fa-angle-right"></i>
                                        Xem tiếp
                                    </a>
                                </div>
                                <div class="news-color-line"></div>
                            </div>
                        </div>';
                }
            }
            ?>
        </div>

        <?php
        foreach ($arr_post as $key => $post) {
            if ($post['cmp_id'] == 8 && $post['post_description'] == '' && $post['post_meta_description'] == 'more') {
                echo '
                        <div class="see-more">
                            <a href="#" target="_self">
                                <i class="fas fa-angle-double-right"></i>
                                ' . $post['post_title'] . '
                            </a>
                        </div>';
            }
        }
        ?>
    </div>
</div>