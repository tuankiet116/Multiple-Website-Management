<?php
require_once('../../classes/database.php');

/********** TITLE **********/
$arr_title = array();
$sql = "SELECT * FROM post_type";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_title, $row);
    }
}
unset($result, $sql);

/********** POST **********/
$post = "SELECT post_id, post_title, post_description, post_image_background FROM post";
$result_post = new db_query($post);

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
            while ($row = mysqli_fetch_assoc($result_post->result)) {
                echo '
                        <div class="col-lg-6">
                            <div class="services">
                                <a href="./news.php" target="_self">
                                    <div class="sv-img">
                                        <img src="' . $row['post_image_background'] . '" alt="garden">
                                    </div>
                                    <div class="sv-title">
                                        <p> ' . $row['post_title'] . ' </p>
                                    </div>
                                    <div class="sv-text">
                                        <p>
                                            ' . $row['post_description'] . '
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>';
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
            <div class="choose-container col-lg-6">
                <a class="choose-left" href="#" target="_self">
                    <img src="../Green_website/resource/images/choose3.jpg" alt="choose image left">
                    <div class="choose-content">
                        <div class="choose-text">
                            <p class="choose-title"> Giá thi công cạnh tranh.</p>

                            <div class="choose-line"></div>

                            <p class="choose-word">Tại sao nên chọn chúng tôi</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="choose-container col-lg-6">
                <div class="row">
                    <div class="choose-right-container col-lg-6 col-md-6 col-sm-6 col-6">
                        <a class="choose-right" href="#" target="_self">
                            <img src="../Green_website/resource/images/hon-non-bo2.jpg" alt="choose right image">
                            <div class="choose-right-content">
                                <div class="choose-right-text">
                                    <p class="choose-right-title">Dự án thiết kế & thi công</p>

                                    <div class="choose-right-line"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="choose-right-container col-lg-6 col-md-6 col-sm-6 col-6">
                        <a class="choose-right" href="#" target="_self">
                            <img src="../Green_website/resource/images/slideshow/koi-pond2.jpeg" alt="choose right image">
                            <div class="choose-right-content">
                                <div class="choose-right-text">
                                    <p class="choose-right-title">Dịch vụ hỗ trợ 24/7</p>

                                    <div class="choose-right-line"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="choose-right-container col-lg-6 col-md-6 col-sm-6 col-6">
                        <a class="choose-right" href="#" target="_self">
                            <img src="../Green_website/resource/images/garden2.jpg" alt="choose right image">
                            <div class="choose-right-content">
                                <div class="choose-right-text">
                                    <p class="choose-right-title">Đội ngũ thiết kế, thi công trình độ cao</p>

                                    <div class="choose-right-line"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="choose-right-container col-lg-6 col-md-6 col-sm-6 col-6">
                        <a class="choose-right" href="#" target="_self">
                            <img src="../Green_website/resource/images/slideshow/villa2.jpg" alt="choose right image">
                            <div class="choose-right-content">
                                <div class="choose-right-text">
                                    <p class="choose-right-title">Thi công sân vườn chuyên nghiệp</p>

                                    <div class="choose-right-line"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact">
        <img src="../Green_website/resource/images/contact-image6.png" alt="contact image">
    </div>

    <div class="container">
        <div class="title">
            <p class="main-title">Tin nổi bật </p>
            <p class="sub-title">
                Tin tức mới nhất từ trang của chúng tôi
            </p>
            <div class="line-title"></div>
        </div>

        <div class="row">
            <div class="news col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row news-all">
                    <div class="news-img col-lg-6 col-md-12 col-sm-12 col-12">
                        <a href="./news.php" target="_self">
                            <img src="../Green_website/resource/images/japan-garden1.jpg" alt="news image">
                        </a>
                    </div>

                    <div class="news-content col-lg-6 col-md-12 col-sm-12 col-12">
                        <p class="news-date"> 10/05/2021 </p>

                        <a href="./news.php" target="_self" class="news-title">Nhà vườn kiểu Nhật</a>

                        <a href="./news.php" target="_self" class="news-viewmore">
                            <i class="fas fa-angle-right"></i>
                            Xem tiếp
                        </a>
                    </div>

                    <div class="news-color-line"></div>
                </div>
            </div>

            <div class="news col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row news-all">
                    <div class="news-img col-lg-6 col-md-12 col-sm-12 col-12">
                        <a href="./news.php" target="_self">
                            <img src="../Green_website/resource/images/slideshow/lake-house2.jpg" alt="news image">
                        </a>
                    </div>

                    <div class="news-content col-lg-6 col-md-12 col-sm-12 col-12">
                        <p class="news-date"> 06/05/2021 </p>

                        <a href="./news.php" target="_self" class="news-title">Biệt phủ với sân vườn hồ cá đẳng cấp</a>

                        <a href="./news.php" target="_self" class="news-viewmore">
                            <i class="fas fa-angle-right"></i>
                            Xem tiếp
                        </a>
                    </div>

                    <div class="news-color-line"></div>
                </div>
            </div>

            <div class="news col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row news-all">
                    <div class="news-img col-lg-6 col-md-12 col-sm-12 col-12">
                        <a href="./news.php" target="_self">
                            <img src="../Green_website/resource/images/garden4.jpg" alt="news image">
                        </a>
                    </div>

                    <div class="news-content col-lg-6 col-md-12 col-sm-12 col-12">
                        <p class="news-date"> 28/04/2021 </p>

                        <a href="./news.php" target="_self" class="news-title">Tuyển kiến trúc sư cảnh quan</a>

                        <a href="./news.php" target="_self" class="news-viewmore">
                            <i class="fas fa-angle-right"></i>
                            Xem tiếp
                        </a>
                    </div>

                    <div class="news-color-line"></div>
                </div>
            </div>

            <div class="news col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row news-all">
                    <div class="news-img col-lg-6 col-md-12 col-sm-12 col-12">
                        <a href="./news.php" target="_self">
                            <img src="../Green_website/resource/images/slideshow/koi-pond6.jpg" alt="news image">
                        </a>
                    </div>

                    <div class="news-content col-lg-6 col-md-12 col-sm-12 col-12">
                        <p class="news-date"> 12/04/2021 </p>

                        <a href="./news.php" target="_self" class="news-title">Hồ Koi vườn nhật đẹp như công viên</a>

                        <a href="./news.php" target="_self" class="news-viewmore">
                            <i class="fas fa-angle-right"></i>
                            Xem tiếp
                        </a>
                    </div>

                    <div class="news-color-line"></div>
                </div>
            </div>
        </div>

        <div class="see-more">
            <a href="#" target="_self">
                <i class="fas fa-angle-double-right"></i>
                Xem thêm
            </a>
        </div>
    </div>

</div>