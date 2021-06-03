<?php
require_once("./helper/function.php");
$web_id = 2;

$get_url = get_data_row("SELECT con_rewrite_name_homepage FROM configuration WHERE web_id = $web_id");
foreach ($get_url as $key => $g_url) {
    $url = $g_url;
}

if (isset($_GET['url'])) {
    $url_rough = $_GET['url'];
    $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url_rough);
}

if (strpos($url, "/") != false) {
    $url = $g_url;
    header('location: ../');
}

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $title1 = $_GET['title'];
    $breadcrumbs = $_GET['breadcrumbs'];
    $name_breadcrumbs = $_GET['nameBreadcrumbs'];
    if (isset($_GET['postTypeId'])) {
        $postType = $_GET['postTypeId'];
    } else {
        $postType = '';
    }

    if (isset($_GET['postNews'])) {
        $postNews = $_GET['postNews'];
    } else {
        $postNews = '';
    }
}

$post_content = get_data_rows("SELECT * FROM post_detail");

$category = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id");

$post_type = get_data_rows("SELECT * FROM post_type WHERE allow_show_homepage = 0 AND web_id = $web_id");

/********** LEFT TITLE  **********/

$arr_left_title = get_data_rows("SELECT * FROM post_type");

/********** CONTACT **********/

$arr_contact = get_data_rows("SELECT * FROM configuration WHERE web_id = $web_id");

?>

<!DOCTYPE html>
<html>

<head>
    <title> <?php echo $title1 ?> </title>
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
                    <?php
                    // foreach ($arr_left_title as $key => $lt) {
                    //     if ($lt['post_type_id'] == 10 && $lt['post_type_show'] == 'column' && $lt['post_type_active'] == 1) {
                    //         echo '
                    //                 <div class="news-left-title">
                    //                     <a href="#" target="_self">
                    //                         ' . $lt['post_type_title'] . '
                    //                     </a>
                    //                 </div>';
                    //     }
                    // }
                    ?>

                    <div class="news-left-title">
                        <a href="" target="_self">
                            Chuyên mục khác
                        </a>
                    </div>

                    <div class="news-left-content">
                        <ul class="list-post">
                            <?php
                            $other_cate = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NOT NULL AND post_type_id IS NOT NULL");
                            foreach ($other_cate as $key => $oc) {
                                $oc_id = $oc['cmp_id'];
                                $other_cate_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $oc_id AND ptd_id IS NULL AND post_active = 1");
                                foreach ($other_cate_post as $key => $ocp) {
                                    echo '
                                            <li>
                                                <a href="news.php?name=' . $ocp['post_rewrite_name'] . '&title=' . $ocp['post_title'] . '&breadcrumbs=' . $oc['cmp_rewrite_name'] . '&nameBreadcrumbs=' . $oc['cmp_name'] . '&postTypeId=' . $oc['post_type_id'] . '" target="_self">
                                                    <i class="fas fa-chevron-right"></i>
                                                    ' . $ocp['post_title'] . '
                                                </a>
                                            </li>
                                        ';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="news-left">
                    <div class="news-left-title">
                        <a href="#" target="_self">
                            Hỗ trợ trực tuyến
                        </a>
                    </div>

                    <div class="news-left-content">
                        <div class="hotline-title">Trực tuyến</div>

                        <div class="hotline-logo">
                            <img src="../../data/image/post/hotline3.png" alt="hotline">
                        </div>

                        <?php
                        foreach ($arr_contact as $key => $contact) {
                            if ($contact['con_active_contact'] == 1) {
                                echo '
                                        <div class="hotline-contact">
                                            <a href="tel:' . $contact['con_hotline'] . '" target="_self">
                                                <i class="fas fa-phone-alt"></i>
                                                ' . $contact['con_hotline'] . '
                                            </a>
                                        </div>
                                
                                        <div class="hotline-contact">
                                            <a href="#" target="_self">
                                                <i class="far fa-envelope"></i>
                                                ' . $contact['con_admin_email'] . '
                                            </a>
                                        </div>';
                            }
                        }
                        ?>

                        <div class="hotline-social-media">
                            <table>
                                <tr>
                                    <?php
                                    foreach ($arr_contact as $key => $contact) {
                                        if ($contact['con_active_contact'] == 1) {
                                            echo '
                                                <td>
                                                    <a href="' . $contact['con_link_fb'] . '" target="_self">
                                                        <i class="fab fa-facebook-square fb"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="' . $contact['con_link_twitter'] . '" target="_self">
                                                        <i class="fab fa-twitter-square tw"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="' . $contact['con_link_insta'] . '" target="_self">
                                                        <i class="fab fa-instagram-square ins"></i>
                                                    </a>
                                                </td>';
                                        }
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>

                        <div class="hotline-support">
                            <div class="hotline-title"> Hỗ trợ </div>
                            <?php
                            foreach ($arr_contact as $key => $contact) {
                                if ($contact['con_active_contact'] == 1) {
                                    echo '
                                            <div class="hotline-contact">
                                                <a href="tel:' . $contact['con_hotline_hotro_kythuat'] . '" target="_self" style="font-size: 22px">
                                                    <i class="fas fa-mobile-alt"></i>
                                                    ' . $contact['con_hotline_hotro_kythuat'] . '
                                                </a>
                                            </div>

                                            <div class="hotline-contact">
                                                <a href="#" target="_self">
                                                    <i class="far fa-envelope"></i>
                                                    ' . $contact['con_admin_email'] . '
                                                </a>
                                            </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php $bread_topic = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id ") ?>
            <div class="news-right col-lg-9 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="news-right-container">
                    <div class="breadcrumb">
                        <a href="index.php" target="_self"> Trang chủ </a>

                        <span class="navigation-pipe">
                            <i class="fas fa-chevron-right"></i>
                        </span>

                        <?php
                        foreach ($bread_topic as $key => $bread) {
                            if ($bread['cmp_rewrite_name'] == $breadcrumbs || $bread['cmp_id'] == $breadcrumbs) {
                                $bread_parents = $bread['cmp_parent_id'];
                                if ($bread_parents == null) {
                                    echo '
                                        <a href="" target="_self">' . $bread['cmp_name'] . '</a>

                                        <span class="navigation-pipe">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>';
                                } else {
                                    $bread_name = get_data_rows("SELECT cmp_name FROM categories_multi_parent WHERE cmp_id = $bread_parents");
                                    foreach ($bread_name as $key => $b_name) {
                                        echo '
                                        <a href="" target="_self">' . $b_name['cmp_name'] . '</a>

                                        <span class="navigation-pipe">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>';
                                    }
                                }
                            }
                        } ?>

                        <a href="#" target="_self"><?php echo $title1 ?> </a>
                    </div>
                    <div class="news-right-content">
                        <p class="news-right-content-title"><?php echo $title1; ?></p>

                        <?php
                        // foreach ($post_content as $p_content) {
                        //     if ($p_content['ptd_id'] == $postNews) {
                        //         echo $p_content['ptd_text'];
                        //     }
                        // }

                        foreach ($post_type as $key => $p_type) {
                            if ($p_type['post_type_show'] != '') {
                                $p_type_id = $p_type['post_type_id'];
                                $get_post = get_data_rows("SELECT * FROM post WHERE post_type_id = $p_type_id AND post_active = 1");
                                if ($p_type['post_type_id'] == $postType) {
                                    foreach ($get_post as $key => $g_post) {
                                        foreach ($category as $key => $cate) {
                                            $mod_rewrite = $arr_con['con_mod_rewrite'];
                                            if ($mod_rewrite == 1) {
                                                $changeUrlName = 'name=' . $g_post['post_rewrite_name'];
                                                $changeUrlBread = '&nameBreadcrumbs=' . $cate['cmp_rewrite_name'];
                                            } else {
                                                $changeUrlName = 'name=' . $g_post['post_id'];
                                                $changeUrlBread = '&nameBreadcrumbs=' . $cate['cmp_id'];
                                            }

                                            if ($g_post['cmp_id'] == $cate['cmp_id']) {

                                                $date = $g_post['post_datetime_create'];
                                                $myDate = date("d-m-Y", strtotime($date));

                                                echo '
                                                <div class="container post-list">
                                                    <div class="row">
                                                        <div class="post-list-img col-lg-4 col-md-4 col-sm-6 col-6">
                                                            <a href="news.php?' . $changeUrlName . '&title=' . $g_post['post_title'] . '&breadcrumbs=' . $cate['cmp_rewrite_name'] . $changeUrlBread . '&postNews=' . $g_post['ptd_id'] . '" target="_self">
                                                                <img src="../../' . $g_post['post_image_background'] . '" alt="post list image">
                                                            </a>
                                                        </div>

                                                        <div class="post-list-container col-lg-8 col-md-8 col-sm-6 col-6">                                                                                
                                                            <div class="post-list-title">
                                                                <a href="news.php?' . $changeUrlName . '&title=' . $g_post['post_title'] . '&breadcrumbs=' . $cate['cmp_rewrite_name'] . $changeUrlBread . '&postNews=' . $g_post['ptd_id'] . '" target="_self">
                                                                    <p>' . $g_post['post_title'] . '</p>
                                                                </a>
                                                            </div>
                                                            
                                                            <div class="post-list-date">' . $myDate . '</div>

                                                            <div class="post-list-content">
                                                                <p>' . $g_post['post_description'] . '</p>
                                                            </div>
                                                            
                                                            <a href="news.php?' . $changeUrlName . '&title=' . $g_post['post_title'] . '&breadcrumbs=' . $cate['cmp_rewrite_name'] . $changeUrlBread . '&postNews=' . $g_post['ptd_id'] . '" class="post-list-button" target="_self">Xem tiếp</a>
                                                        </div>
                                                    </div>                 
                                                </div>';
                                            }
                                        }
                                    }
                                }
                            } else {
                                foreach ($post_content as $p_content) {
                                    if ($p_content['ptd_id'] == $postNews) {
                                        echo $p_content['ptd_text'];
                                    }
                                }
                            }
                        }
                        ?>
                    </div>

                    <div class="contact-footer">
                        <h5>Mời liên hệ:</h5>
                        <?php
                        foreach ($arr_contact as $key => $call) {
                            if ($call['con_active_contact'] == 1) {
                                echo '
                                    <p> Địa chỉ: ' . $call['con_address'] . '</p>
                                    <p> Hotline: ' . $call['con_hotline'] . '</p>
                                ';
                            }
                        }
                        ?>
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