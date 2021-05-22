<?php
    error_reporting(0);
    require_once("./helper/funtion.php");
    $web_id = 1;
    if(isset($_GET['name']) && $_GET['title']){
        $name = $_GET['name'];
        $title = $_GET['title'];
    }
    $query = "SELECT post_detail.ptd_id, post_detail.ptd_text FROM post_detail, post WHERE post.ptd_id = post_detail.ptd_id AND post.post_rewrite_name = '$name'";
    $post_detail = get_data_row($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./includes/inc_head.php")?>
    <title><?php echo $title ?></title>
</head>
<body>
    <?php include("./includes/inc_header.php")?>
    <div class="content_detail">
        <?php 
            if(!empty($post_detail)){
                echo $post_detail['ptd_text'] . '<h1>'.$title.'</h1>';   
            }
        ?>
    </div>

    <?php include("./includes/inc_footer.php")?>
    <?php include("./includes/inc_foot.php")?>
</body>
</html>