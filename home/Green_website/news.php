<?php
require_once("./helper/function.php");
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

$get_web_icon = get_data_row("SELECT * FROM configuration WHERE web_id = $web_id");
$web_bottom_icon = $get_web_icon['con_logo_bottom'];

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
    $get_post = get_data_row("SELECT * FROM post WHERE post_rewrite_name = '$name' AND post_active = 1");
    $get_ptd_id = $get_post['ptd_id'];
    $get_post_detail = get_data_row("SELECT * FROM post_detail WHERE ptd_id = $get_ptd_id");
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $get_post = get_data_row("SELECT * FROM post WHERE post_id = $pid AND post_active = 1");
    $get_ptd_id = $get_post['ptd_id'];
    $get_post_detail = get_data_row("SELECT * FROM post_detail WHERE ptd_id = $get_ptd_id");
}

$category = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id");

$post_type = get_data_rows("SELECT * FROM post_type WHERE web_id = $web_id");

/********** LEFT TITLE  **********/

$arr_left_title = get_data_rows("SELECT * FROM post_type");

/********** CONTACT **********/

$arr_contact = get_data_rows("SELECT * FROM configuration WHERE web_id = $web_id");

?>

<!DOCTYPE html>
<html>

<head>
    <title> <?php echo $get_post['post_title'] ?> </title>
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
                        <a href="" target="_self">
                            Chuyên mục khác
                        </a>
                    </div>

                    <div class="news-left-content">
                        <ul class="list-post">
                            <?php
                            $other_cate = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NOT NULL AND cmp_active = 1 AND web_id = $web_id");
                            foreach ($other_cate as $key => $oc) {
                                $oc_id = $oc['cmp_id'];
                                $oc_p = get_data_rows("SELECT * FROM post WHERE cmp_id = $oc_id LIMIT 1");

                                $oc_cmp_id = $oc['cmp_id'];
                                $oc_pt_id = $oc['post_type_id'];
                                $oc_pt = explode(",", $oc_pt_id);
                                $count_oc_pt = count($oc_pt);
                                if ($count_oc_pt == 1) {
                                    foreach ($oc_p as $key => $op) {

                                        $changeUrlId = 'id=' . $oc['post_type_id'];

                                        echo '
                                            <li>
                                                <a href="../post_list/post_list.php?' . $changeUrlId . '" target="_self">
                                                    <i class="fas fa-chevron-right"></i>
                                                    ' . $oc['cmp_name'] . '
                                                </a>
                                            </li>
                                ';
                                    }
                                } else if ($count_oc_pt > 1) {
                                    if ($oc_pt_id != "" || $oc_pt_id != null) {
                                        $topic_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $oc_cmp_id AND post_active = 1 AND post_type_id IN ($oc_pt_id)");
                                        $mod_rewrite = $arr_con['con_mod_rewrite'];
                                        if ($mod_rewrite == 1) {
                                            if ($oc['cmp_rewrite_name'] != "" || $oc['cmp_rewrite_name'] != null) {
                                                $changeUrlName = 'name=' . $oc['cmp_rewrite_name'];
                                            } else if ($oc['cmp_rewrite_name'] == "" || $oc['cmp_rewrite_name'] == null) {
                                                $changeUrlName = 'cid=' . $oc['cmp_id'];
                                            }
                                        } else {
                                            $changeUrlName = 'cid=' . $oc['cmp_id'];
                                        }

                                        echo '
                                            <li>
                                                <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                                    <i class="fas fa-chevron-right"></i>
                                                    ' . $oc['cmp_name'] . '
                                                </a>
                                            </li>
                                        ';
                                    } else if ($oc_pt_id == "" || $oc_pt_id == null) {
                                        echo '
                                            <li>
                                                <a href="error.php" target="_self">
                                                    <i class="fas fa-chevron-right"></i>
                                                    ' . $oc['cmp_name'] . '
                                                </a>
                                            </li>
                                        ';
                                    }
                                } else if ($count_oc_pt == 0) {
                                    echo '
                                        <li>
                                            <a href="error.php" target="_self">
                                                <i class="fas fa-chevron-right"></i>
                                                ' . $oc['cmp_name'] . '
                                            </a>
                                        </li>
                                    ';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <?php
                foreach ($arr_contact as $key => $contact) {
                    if ($contact['con_banner_active'] == 1) {
                        echo '
                            <div class="news-left">
                                <div class="news-left-title">
                                    <a href="#" target="_self">
                                        Hỗ trợ trực tuyến
                                    </a>
                                </div>

                                <div class="news-left-content">
                                    <div class="hotline-title">Trực tuyến</div>

                                    <div class="hotline-logo">
                                        <img src="' . $base_url . 'data/image/post/hotline3.png" alt="hotline">
                                    </div>
            
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
                                    </div>
                                    
                                    <div class="hotline-social-media">
                                        <table>
                                            <tr>      
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
                                                </td>                                    
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="hotline-support">
                                        <div class="hotline-title"> Hỗ trợ </div>

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
                                        </div>        
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
                ?>
            </div>

            <div class="news-right col-lg-9 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="news-right-container">
                    <div class="breadcrumb">
                        <a href="../index.php" target="_self"> Trang chủ </a>

                        <span class="navigation-pipe">
                            <i class="fas fa-chevron-right"></i>
                        </span>

                        <?php
                        $get_cmp_id = $get_post['cmp_id'];
                        $get_cmp_name = get_data_row("SELECT * FROM categories_multi_parent WHERE cmp_id = $get_cmp_id");
                        if ($get_cmp_name['cmp_parent_id'] != "" || $get_cmp_name['cmp_parent_id'] != null) {
                            $get_cmp_pr_id = $get_cmp_name['cmp_parent_id'];
                            $get_parent_name = get_data_row("SELECT * FROM categories_multi_parent WHERE cmp_id = $get_cmp_pr_id");
                            echo '
                                    <a href="#" target="_self">' . $get_parent_name['cmp_name'] . '</a>

                                    <span class="navigation-pipe">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>

                                    <a href="#" target="_self">' . $get_cmp_name['cmp_name'] . '</a>
                                ';
                        } else {
                            echo '
                                    <a href="#" target="_self">' . $get_cmp_name['cmp_name'] . '</a>
                                ';
                        }

                        ?>

                    </div>
                    <div class="news-right-content">

                        <p class="news-right-content-title"> <?php echo $get_post['post_title'] ?> </p>

                        <?php
                        echo '<div class="news-right-main">
                                        ' . $get_post_detail['ptd_text'] . '
                                        </div>';

                        echo '<script type="text/javascript">
                                        $(document).ready(function(){
                                            var srcImg = $(".news-right-main img").attr("src");
                                            $(".news-right-main img").attr("src", "' . $base_url . '" + srcImg);
                                            });
                                        </script>';
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

                <?php 
                    if ($get_post['product_id'] != "" || $get_post['product_id'] != null) {
                        $get_product_id = $get_post['product_id'];
                        $get_product_list = get_data_rows("SELECT * FROM product WHERE product_id = $get_product_id AND product_active = 1");
                        echo'
                            <div class="news-right-container">
                                <div class="news-right-content">
                                    <p class="news-right-content-title" style="padding-top: 8px"> Sản phẩm liên quan </p>

                                    <div class="container-fluid news-right-product">
                                        <div class="row">
                        ';
                                    foreach ($get_product_list as $key => $g_pl) {
                                        echo '
                                            <div class="news-product-container col-lg-4 col-md-6 col-sm-12 col-12">
                                                <div class="news-product-content">
                                                    <a href="items.php?id=' . $g_pl['product_id'] . '" target="_self">
                                                        <div class="news-product-image">
                                                            <img src="' . $base_url . $g_pl['product_image_path'] . '" alt="product list image">

                                                            <span class="news-product-new"> New </span>
                                                        </div>
                                                    </a>

                                                    <div class="news-product-title">
                                                        <a href="items.php?id=' . $g_pl['product_id'] . '" target="_self"> ' . $g_pl['product_name'] . ' </a>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                    }
                        echo'
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    } 
                    else {
                        echo '';
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