<?php
require_once("./config/funtion.php");
require_once("./config/config.php");

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $title = $_GET['title'];
    $link_breadcrumbs = $_GET['breadcrumbs'];
    $name_breadcrumbs = $_GET['nameBreadcrumbs'];
}

$post_detail = get_data_row("SELECT post_detail.ptd_id, post_detail.ptd_text FROM post_detail, post WHERE post.ptd_id = post_detail.ptd_id AND post.post_rewrite_name = '$name'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./includes/inc_head.php") ?>
    <title><?php echo $title ?></title>
</head>

<body>
    <?php include("./includes/inc_header.php") ?>
    <div class="container">
        <div class="row">
            <div class="service col-lg-12">
                <ul id="breadcrumbs" class="breadcrumbs">
                    <li class="item-home">
                        <a href="http://localhost:8091/home/Cleaning_website/" target="_self">Trang chủ</a>
                    </li>
                    <?php if($link_breadcrumbs != 'trang-chu'){?>
                    <li class="separator" style="font-size: 16px"> » </li>
                    <li class="item-home">
                        <a href="http://localhost:8091/home/Cleaning_website/<?php echo $link_breadcrumbs?>" target="_self"><?php echo $name_breadcrumbs?></a>
                    </li>
                    <?php }?>
                    <li class="separator" style="font-size: 16px"> » </li>
                    <li class="item-cat">
                        <p><?php echo $title ?></p>
                    </li>
                </ul>

                <div class="service-container">
                    <?php echo $post_detail['ptd_text'] ?>
                </div>
            </div>
        </div>
    </div>

    <div id="contact">
        <div id="phone">
            <i class="fas fa-phone-alt"></i>
        </div>

        <div id="number"> 035.955.9225 </div>
    </div>

    <?php include("./includes/inc_footer.php") ?>
    <?php include("./includes/inc_foot.php") ?>
</body>

</html>

