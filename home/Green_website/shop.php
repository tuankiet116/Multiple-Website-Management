<?php
require_once("./helper/function.php");
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

$get_web_icon = get_data_row("SELECT * FROM configuration WHERE web_id = $web_id");
$web_bottom_icon = $get_web_icon['con_logo_bottom'];

// $web_id = 2;

$per_page_record = 9;

if (isset($_GET['page'])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

if (isset($_GET['gid'])) {
    $gid = $_GET['gid'];
    $arr_gr_shop = get_data_rows("SELECT * FROM product WHERE web_id = $web_id AND product_gr_id = $gid");
    $get_gr_shop = get_data_row("SELECT * FROM product_group WHERE product_gr_id = $gid AND product_gr_active = 1");
}

$start_from = ($page - 1) * $per_page_record;

/********** SHOP **********/

$arr_shop = get_data_rows("SELECT * FROM product WHERE web_id = $web_id LIMIT $start_from, $per_page_record");

$arr_product_gr = get_data_rows("SELECT * FROM product_group WHERE product_gr_active = 1");

$arr_product = get_data_rows("SELECT * FROM product WHERE web_id = $web_id AND product_active = 1 LIMIT 12");

/********** CONTACT **********/

$arr_contact = get_data_rows("SELECT * FROM configuration WHERE web_id = $web_id");

/********** PAGINATION **********/

$sql = "SELECT * FROM product";
$result = get_data_rows($sql);
$total_record = sizeof($result);
// $sql = "SELECT COUNT(*) FROM product";
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
    <title> Sản phẩm </title>
    <? include("./includes/inc_head.php"); ?>
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

            <?php $bread_topic = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id ") ?>
            <div class="news-right col-lg-9 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="news-right-container">
                    <div class="breadcrumb">
                        <a href="../index.php" target="_self"> Trang chủ </a>

                        <span class="navigation-pipe">
                            <i class="fas fa-chevron-right"></i>
                        </span>

                        <a href="../index.php" target="_self"> Sản phẩm </a>
                    </div>

                    <div class="news-right-content">
                        <div class="shop-title">
                            <?php
                            if (!isset($_GET['gid'])) {
                                echo 'Báo giá sản phẩm';
                            } else if (isset($_GET['gid'])) {
                                echo $get_gr_shop['product_gr_name'];
                            }
                            ?>
                        </div>

                        <?php
                             
                        ?>
                        <div class="shop-container">
                            <div class="shop-container-title">
                                <a href="" target="_self">
                                    Cây nhập khẩu
                                </a>
                            </div>

                            <div class="row">
                                <div class="shop-content col-lg-3">
                                    <div class="shop-items">
                                        <div class="shop-items-image">
                                            <div class="shop-items-fade">
                                                <div class="shop-items-fade-margin">
                                                    <a href="" target="_self">
                                                        <button class="shop-items-detail">
                                                            Chi tiết
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="shop-items-name">
                                            <div class="shop-items-box">
                                                <a href="" target="_self" class="shop-items-title"> Cây lan </a>
                                            </div>

                                            <p class="shop-items-price"> 300.000đ </p>

                                            <div class="shop-items-add-box">
                                                <button class="shop-items-add">
                                                    <i class="fas fa-cart-plus"></i>
                                                    Thêm giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="shop-content col-lg-3">
                                    <div class="shop-items">
                                        <div class="shop-items-image">
                                            <div class="shop-items-fade">
                                                <div class="shop-items-fade-margin">
                                                    <a href="" target="_self">
                                                        <button class="shop-items-detail">
                                                            Chi tiết
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="shop-items-name">
                                            <div class="shop-items-box">
                                                <a href="" target="_self" class="shop-items-title"> Cây lan </a>
                                            </div>

                                            <p class="shop-items-price"> 300.000đ </p>

                                            <div class="shop-items-add-box">
                                                <button class="shop-items-add">
                                                    <i class="fas fa-cart-plus"></i>
                                                    Thêm giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="shop-content col-lg-3">
                                    <div class="shop-items">
                                        <div class="shop-items-image">
                                            <div class="shop-items-fade">
                                                <div class="shop-items-fade-margin">
                                                    <a href="" target="_self">
                                                        <button class="shop-items-detail">
                                                            Chi tiết
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="shop-items-name">
                                            <div class="shop-items-box">
                                                <a href="" target="_self" class="shop-items-title"> Cây lan </a>
                                            </div>

                                            <p class="shop-items-price"> 300.000đ </p>

                                            <div class="shop-items-add-box">
                                                <button class="shop-items-add">
                                                    <i class="fas fa-cart-plus"></i>
                                                    Thêm giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="shop-content col-lg-3">
                                    <div class="shop-items">
                                        <div class="shop-items-image">
                                            <div class="shop-items-fade">
                                                <div class="shop-items-fade-margin">
                                                    <a href="" target="_self">
                                                        <button class="shop-items-detail">
                                                            Chi tiết
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="shop-items-name">
                                            <div class="shop-items-box">
                                                <a href="" target="_self" class="shop-items-title"> Cây lan </a>
                                            </div>

                                            <p class="shop-items-price"> 300.000đ </p>

                                            <div class="shop-items-add-box">
                                                <button class="shop-items-add">
                                                    <i class="fas fa-cart-plus"></i>
                                                    Thêm giỏ hàng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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