<?php
require_once('./config/funtion.php');
require_once('./config/config.php');

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $title = $_GET['title'];
    $breadcrumbs = $_GET['breadcrumbs'];
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
                    <li class="separator" style="font-size: 16px"> » </li> 
                    <?php if($breadcrumbs != 'trang-chu'){?>
                    <li class="item-cat">
                        <a href="http://localhost:8091/home/Cleaning_website/<?php echo $breadcrumbs ?>" target="_self"><?php echo $name_breadcrumbs ?></a>
                    </li>
                    <li class="separator" style="font-size: 16px"> » </li>  
                    <?php }?>
                    <li class="item-cat">
                        <p><?php echo $title ?></p>
                    </li>
                </ul>

                <div class="service-container">
                    <?php 
                        if($post_detail==''){
                            echo '<h1>chưa có gì</h1>';
                        } 
                        else{
                            echo $post_detail['pdt_text'];
                        }
                    ?>
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

