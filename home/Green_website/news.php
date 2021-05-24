<?php
require_once('../../classes/database.php');
$web_id = 'web_id = 2';

/********** LEFT TITLE  **********/

$arr_left_title = array();
$sql = "SELECT * FROM post_type";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_left_title, $row);
    }
}
unset($result, $sql);

/********** HOUSE **********/

$arr_house = array();
$sql = "SELECT * FROM categories_multi_parent WHERE cmp_parent_id = 8 AND $web_id";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_house, $row);
    }
}
unset($result, $sql);

/********** NEWS POST **********/

$arr_news_post = array();
$sql = "SELECT * FROM post ORDER BY post_datetime_create DESC LIMIT 6";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_news_post, $row);
    }
}
unset($result, $sql);

/********** CONTACT **********/

$arr_contact = array();
$sql = "SELECT con_hotline, con_hotline_banhang, con_hotline_hotro_kythuat, con_email 
        FROM configuration WHERE $web_id ";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_contact, $row);
    }
}
unset($result, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title> Dịch vụ mua bán cây cảnh </title>
    <? include("./includes/inc_head.php"); ?>
    <link rel="stylesheet" href="../Green_website/resource/css/news.css">
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- CONTENT --------------->

    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-md-2 order-sm-2 order-2">
                <div class="news-left">
                    <div class="news-left-title">
                        <?php
                        foreach ($arr_left_title as $key => $title) {
                            if ($title['post_type_id'] == 5 && $title['post_type_show'] == 'title') {
                                echo '
                                    <a href="#" target="_self">
                                        ' . $title['post_type_title'] . '
                                    </a>';
                            }
                        }
                        ?>
                    </div>

                    <div class="news-left-content">
                        <ul class="list-post">
                            <?php
                            foreach ($arr_house as $key => $house) {
                                if ($house['cmp_active'] == 1) {
                                    echo '
                                            <li>
                                                <a href="#" target="_self">
                                                    <i class="fas fa-chevron-right"></i>
                                                    ' . $house['cmp_name'] . '
                                                </a>
                                            </li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="news-left">
                    <?php
                    foreach ($arr_left_title as $key => $title) {
                        if ($title['post_type_id'] == 6 && $title['post_type_show'] == 'title') {
                            echo '
                                    <div class="news-left-title">
                                        <a href="#" target="_self">
                                            ' . $title['post_type_title'] . '
                                        </a>
                                    </div>';
                        }
                    }
                    ?>

                    <div class="news-left-content">
                        <ul class="list-news">
                            <?php
                            foreach ($arr_news_post as $key => $news_post) {
                                if ($news_post['cmp_id'] == 8 && $news_post['post_image_background'] != '') {

                                    $date = $news_post['post_datetime_create'];
                                    $myDate = date("d-m-Y", strtotime($date));

                                    echo '
                                        <li>
                                            <div class="list-news-container">
                                                <div class="list-news-image">
                                                    <a href="#" target="_self">
                                                        <img src="' . $news_post['post_image_background'] . '" alt="list news image">
                                                    </a>
                                                </div>

                                                <div class="list-news-content">
                                                    <a href="#" target="_self">
                                                        ' . $news_post['post_title'] . '
                                                    </a>

                                                    <div class="list-news-date">
                                                        <p>' . $myDate . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="news-left">
                    <?php
                    foreach ($arr_left_title as $key => $title) {
                        if ($title['post_type_id'] == 7 && $title['post_type_show'] == 'title') {
                            echo '
                                    <div class="news-left-title">
                                        <a href="#" target="_self">
                                            ' . $title['post_type_title'] . '
                                        </a>
                                    </div>';
                        }
                    }
                    ?>

                    <div class="news-left-content">
                        <?php
                        foreach ($arr_left_title as $key => $title) {
                            if ($title['post_type_id'] == 8 && $title['post_type_show'] == 'sub-title') {
                                echo '
                                    <div class="hotline-title">' . $title['post_type_title'] . '</div>';
                            }
                        }
                        ?>

                        <div class="hotline-logo">
                            <img src="../Green_website/resource/images/hotline3.png" alt="hotline">
                        </div>

                        <?php
                        foreach ($arr_contact as $key => $contact) {
                            echo '
                                <div class="hotline-contact">
                                    <a href="#" target="_self">
                                        <i class="fas fa-phone-alt"></i>
                                        ' . $contact['con_hotline'] . '
                                    </a>
                                </div>
                                
                                <div class="hotline-contact">
                                    <a href="#" target="_self">
                                        <i class="far fa-envelope"></i>
                                        ' . $contact['con_email'] . '
                                    </a>
                                </div>';
                        }
                        ?>

                        <div class="hotline-social-media">
                            <table>
                                <tr>
                                    <td>
                                        <a href="#" target="_self">
                                            <i class="fab fa-facebook-square fb"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" target="_self">
                                            <i class="fab fa-twitter-square tw"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" target="_self">
                                            <i class="fab fa-instagram-square ins"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="hotline-support">
                            <?php
                            foreach ($arr_left_title as $key => $title) {
                                if ($title['post_type_id'] == 9 && $title['post_type_show'] == 'sub-title') {
                                    echo '
                                        <div class="hotline-title">' . $title['post_type_title'] . '</div>';
                                }
                            }
                            ?>

                            <?php
                            foreach ($arr_contact as $key => $contact) {
                                echo '
                                    <div class="hotline-contact">
                                        <a href="#" target="_self" style="font-size: 22px">
                                            <i class="fas fa-mobile-alt"></i>
                                            ' . $contact['con_hotline_hotro_kythuat'] . '
                                        </a>
                                    </div>

                                    <div class="hotline-contact">
                                        <a href="#" target="_self">
                                            <i class="far fa-envelope"></i>
                                            ' . $contact['con_email'] . '
                                        </a>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="news-right col-lg-9 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="news-right-container">
                    <div class="breadcrumb">
                        <a href="#" target="_self">Trang chủ</a>

                        <span class="navigation-pipe">
                            <i class="fas fa-chevron-right"></i>
                        </span>

                        <a href="#" target="_self">Dịch vụ</a>

                        <span class="navigation-pipe">
                            <i class="fas fa-chevron-right"></i>
                        </span>

                        <a href="#" target="_self">Thiết kế thi công sân vườn biệt thự</a>
                    </div>

                    <div class="news-right-content">
                        <p></p>
                    </div>

                    <div class="contact-footer">
                        <h5>Mời liên hệ:</h5>
                        <p>Địa chỉ: </p>
                        <p>VPGD: </p>
                        <p>Nhà vườn: </p>
                        <p>Hotline: </p>
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