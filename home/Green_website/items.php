<?php
require_once("./helper/function.php");
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$items = get_data_row("SELECT * FROM product WHERE product_id = $id AND product_active = 1");
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
                                    <p class="product-info-title"> Thông tin sản phẩm: </p>
                                    <p class="product-info-text">
                                        <?php echo $items['product_description'] ?>
                                    </p>
                                </div>

                                <div class="product-price">
                                    <p class="product-price-title"> Giá sản phẩm: </p>
                                    <p class="product-price-cash">
                                        <?php echo $items['product_price'] ?>
                                        <span style="font-size: 13px"> <?php echo $items['product_currency'] ?> </span>
                                    </p>
                                </div>

                                <div class="product-contact">
                                    <a href="#" target="_self">
                                        <div class="product-back">
                                            <i class="fas fa-redo-alt"></i>
                                            Quay lại
                                        </div>
                                    </a>

                                    <a href="#" target="_self">
                                        <div class="product-call">
                                            <i class="fas fa-phone-alt"></i>
                                            Liên hệ
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shop-title"> Bài viết liên quan </div>

                <div class="product-post">
                    <div class="row">
                        <?php
                            foreach ($post_item as $key => $p_item) {
                                foreach ($category as $key => $cate) {
                                    $mod_rewrite = $arr_con['con_mod_rewrite'];
                                    if ($mod_rewrite == 1) {
                                        $changeUrlName = 'name=' . $p_item['post_rewrite_name'];
                                        $changeUrlBread = '&breadcrumbs=' . $cate['cmp_rewrite_name'];
                                    } else {
                                        $changeUrlName = 'name=' . $p_item['post_id'];
                                        $changeUrlBread = '&breadcrumbs=' . $cate['cmp_id'];
                                    }

                                    if ($p_item['cmp_id'] == $cate['cmp_id']) {
                                        echo '
                                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                <div class="product-post-container">
                                                    <a href="news.php?' . $changeUrlName . '&title=' . $p_item['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $p_item['ptd_id'] . '" target="_self">
                                                        <div class="product-post-image">
                                                            <img src="' . $base_url . $p_item['post_image_background'] . '" alt="product post image">
                                                        </div>
                                                    </a>
                                                    
                                                    <div class="product-post-text">
                                                        <a href="news.php?' . $changeUrlName . '&title=' . $p_item['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $cate['cmp_name'] . '&postNews=' . $p_item['ptd_id'] . '" target="_self">
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
            </div>
        </div>
    </div>
            <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>