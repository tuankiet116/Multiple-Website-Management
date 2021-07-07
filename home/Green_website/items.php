<?php
require_once("./helper/function.php");
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

$get_web_icon = get_data_row("SELECT * FROM configuration WHERE web_id = $web_id");
$web_bottom_icon = $get_web_icon['con_logo_bottom'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$items = get_data_row("SELECT * FROM product WHERE product_id = $id AND product_active = 1");
$get_other_product = get_data_rows("SELECT * FROM product WHERE NOT (product_id = $id) AND product_active = 1");
$con_item = get_data_row("SELECT * FROM configuration WHERE web_id = $web_id");
$count_post_item = get_data_rows("SELECT COUNT(*) FROM post WHERE product_id = $id AND post_active = 1");
$count_p_it = $count_post_item[0]['COUNT(*)'];
$post_item = get_data_rows("SELECT * FROM post WHERE product_id = $id AND post_active = 1");
$category = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id");

?>

<!DOCTYPE html>
<html>

<head>
    <title> <?php echo $items['product_name'] ?> </title>
    <? include("./includes/inc_head.php"); ?>
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- CONTENT --------------->

    <div id="shop">
        <div id="shop-container">
            <div class="container-fluid">
                <div class="breadcrumb">
                    <a href="index.php" target="_self">
                        Trang chủ
                    </a>

                    <span class="navigation-pipe">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <a href="shop.php" target="_self">Báo giá sản phẩm</a>
                </div>

                <div class="shop-title"> <?php echo $items['product_name'] ?> </div>

                <div class="product-container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="product-image">
                                <img src="<?php echo $base_url . $items['product_image_path'] ?>" alt="product image">
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12" style="padding-left: 20px">
                            <div class="product-content">
                                <div class="product-name">
                                    <span> <?php echo $items['product_name'] ?> </span>
                                </div>

                                <div class="product-info">
                                    <p class="product-info-title"> Loại sản phẩm: </p>
                                    <p class="product-info-text">

                                    </p>
                                </div>

                                <div class="product-info">
                                    <p class="product-info-title"> Thông tin sản phẩm: </p>
                                    <p class="product-info-text">
                                        <?php echo $items['product_description'] ?>
                                    </p>
                                </div>

                                <div class="product-price">
                                    <p class="product-price-title"> Giá sản phẩm: </p>
                                    <p class="product-price-cash">
                                        <span class="price-numbers"> <?php echo $items['product_price'] ?> </span>
                                        <span style="font-size: 13px"> <?php echo $items['product_currency'] ?> </span>
                                    </p>
                                </div>

                                <div class="product-contact">
                                    <a href="" target="_self">
                                        <div class="product-add">
                                            <i class="fas fa-cart-plus"></i>
                                            Thêm giỏ hàng
                                        </div>
                                    </a>

                                    <a href="tel:<?php echo $con_item['con_hotline_banhang'] ?>" target="_self">
                                        <div class="product-call">
                                            <i class="fas fa-shopping-cart"></i>
                                            Mua ngay
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if ($count_p_it >= 1) { ?>
                    <div class="shop-title"> Bài viết liên quan </div>

                    <div class="product-post">
                        <div class="row slide-product-post">
                            <?php
                            foreach ($post_item as $key => $p_item) {
                                foreach ($category as $key => $cate) {
                                    $mod_rewrite = $arr_con['con_mod_rewrite'];
                                    if ($mod_rewrite == 1) {
                                        if ($p_item['post_rewrite_name'] != "" || $p_item['post_rewrite_name'] != null) {
                                            $changeUrlName = 'name=' . $p_item['post_rewrite_name'];
                                        } else if ($p_item['post_rewrite_name'] == "" || $p_item['post_rewrite_name'] == null) {
                                            $changeUrlName = 'pid=' . $p_item['post_id'];
                                        }
                                    } else {
                                        $changeUrlName = 'pid=' . $p_item['post_id'];
                                    }

                                    if ($p_item['cmp_id'] == $cate['cmp_id']) {
                                        echo '
                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                    <div class="product-post-container">
                                                        <a href="../news.php?' . $changeUrlName . '" target="_self">
                                                            <div class="product-post-image">
                                                                <img src="' . $base_url . $p_item['post_image_background'] . '" alt="product post image">
                                                            </div>
                                                        </a>
                                                        
                                                        <div class="product-post-text">
                                                            <a href="../news.php?' . $changeUrlName . '" target="_self">
                                                                <div class="product-post-title">
                                                                    ' . $p_item['post_title'] . '
                                                                </div>
                                                            </a>

                                                            <div class="product-post-word">
                                                                ' . $p_item['post_description'] . '
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php
                } else if ($count_p_it == 0) {
                    echo '';
                }
                ?>

                <div class="shop-title"> Sản phẩm khác </div>

                <div class="other-product">
                    <div class="row slide-other-product">
                        <?php
                        foreach ($get_other_product as $key => $g_op) {
                            echo '
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="shop-content">
                                        <div class="shop-image">
                                            <a href="#" target="_self">
                                                <img src="' . $base_url . $g_op['product_image_path'] . '" alt="shop image">
                            
                                                <div class="shop-detail">
                                                    <a href="items.php?id=' . $g_op['product_id'] . '" target="_self">
                                                        <div> Chi tiết </div>
                                                    </a>
                                                </div>
                                                
                                            </a>

                                            <div class="new-sticker"> New </div>
                                        </div>

                                        <div class="shop-name">
                                            <a href="items.php?id=' . $g_op['product_id'] . '" target="_self">
                                                ' . $g_op['product_name'] . '
                                            </a>
                                        </div>

                                        <div class="shop-des">
                                            <span class="price-numbers" style="font-size: 17px; font-weight: bold"> ' . $g_op['product_price'] . ' </span>
                                            <span> ' . $g_op['product_currency'] . '</span>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="shop-content">
                                <div class="shop-image">
                                    <a href="#" target="_self">
                                        <img src="" alt="shop image">

                                        <div class="shop-detail">
                                            <a href="" target="_self">
                                                <div> Chi tiết </div>
                                            </a>
                                        </div>

                                    </a>

                                    <div class="new-sticker"> New </div>
                                </div>

                                <div class="shop-name">
                                    <a href="" target="_self">

                                    </a>
                                </div>

                                <div class="shop-des">
                                    <span class="price-numbers" style="font-size: 17px; font-weight: bold"> </span>
                                    <span> </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="shop-content">
                                <div class="shop-image">
                                    <a href="#" target="_self">
                                        <img src="" alt="shop image">

                                        <div class="shop-detail">
                                            <a href="" target="_self">
                                                <div> Chi tiết </div>
                                            </a>
                                        </div>

                                    </a>

                                    <div class="new-sticker"> New </div>
                                </div>

                                <div class="shop-name">
                                    <a href="" target="_self">

                                    </a>
                                </div>

                                <div class="shop-des">
                                    <span class="price-numbers" style="font-size: 17px; font-weight: bold"> </span>
                                    <span> </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="shop-content">
                                <div class="shop-image">
                                    <a href="#" target="_self">
                                        <img src="" alt="shop image">

                                        <div class="shop-detail">
                                            <a href="" target="_self">
                                                <div> Chi tiết </div>
                                            </a>
                                        </div>

                                    </a>

                                    <div class="new-sticker"> New </div>
                                </div>

                                <div class="shop-name">
                                    <a href="" target="_self">

                                    </a>
                                </div>

                                <div class="shop-des">
                                    <span class="price-numbers" style="font-size: 17px; font-weight: bold"> </span>
                                    <span> </span>
                                </div>
                            </div>
                        </div>
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