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


?>

<!DOCTYPE html>
<html>

<head>
    <title> Giỏ hàng </title>
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
                    <a href="shop.php" target="_self">Giỏ hàng</a>
                </div>

                <div class="shop-title"> Giỏ hàng </div>

                <div class="cart-container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-12 cart-padding">
                            <div class="cart-left">
                                <div class="cart-name">
                                    <span> Danh sách sản phẩm </span>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Sản phẩm </th>
                                            <th> Giá </th>
                                            <th> Số lượng </th>
                                            <th> Tổng </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <i class="far fa-times-circle cart-close"></i>
                                                <a class="cart-product-name" href="" target=""> Sản phẩm 1 </a>
                                            </td>
                                            <td> 200.000 đ </td>
                                            <td>
                                                <div class="input-group inline-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn-minus">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity" min="0" name="quantity" value="1" type="number">
                                                    <div class="input-group-append">
                                                        <button class="btn-plus">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> 200.000 đ </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="far fa-times-circle cart-close"></i>
                                                Sản phẩm 2
                                            </td>
                                            <td> 300.000 đ </td>
                                            <td>
                                                <div class="input-group inline-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn-minus">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity" min="0" name="quantity" value="1" type="number">
                                                    <div class="input-group-append">
                                                        <button class="btn-plus">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> 300.000 đ </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="far fa-times-circle cart-close"></i>
                                                Sản phẩm 3
                                            </td>
                                            <td> 150.000 đ </td>
                                            <td>
                                                <div class="input-group inline-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn-minus">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity" min="0" name="quantity" value="1" type="number">
                                                    <div class="input-group-append">
                                                        <button class="btn-plus">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> 150.000 đ </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="far fa-times-circle cart-close"></i>
                                                Sản phẩm 4
                                            </td>
                                            <td> 180.000 đ </td>
                                            <td>
                                                <div class="input-group inline-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn-minus">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity" min="0" name="quantity" value="1" type="number">
                                                    <div class="input-group-append">
                                                        <button class="btn-plus">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> 180.000 đ </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="cart-left-button">
                                    <a class="cart-more" href="" target="_self">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                        Tiếp tục xem sản phẩm
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="cart-right">
                                <div class="cart-name">
                                    <span> Cộng giỏ hàng </span>
                                </div>

                                <div class="cart-right-content">
                                    <div class="cart-total">
                                        <span> Số lượng </span>
                                        <span> 4 </span>
                                    </div>

                                    <div class="cart-price">
                                        <span> Tạm tính </span>
                                        <span> 830.000 đ </span>
                                    </div>

                                    <div class="cart-total-price">
                                        <span> Tổng </span>
                                        <span> 830.000 đ </span>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-payment">
                                <a class="cart-momo" href="" target="_self">
                                    <div>
                                        <img src="<?php echo $base_url ?>data/image/product/momo-logo.png" alt="momo logo">
                                        Thanh toán MOMO
                                    </div>
                                </a>

                                <a class="cart-pay-after" href="" target="_self">
                                    <div>
                                        <i class="fas fa-shopping-cart"></i>
                                        Thanh toán sau khi nhận
                                    </div>
                                </a>
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