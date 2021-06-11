<?php
require_once('./helper/function.php');
require_once('./helper/url.php');

$get_web_id = get_data_row("SELECT * FROM website_config WHERE web_url = '$main_url' AND web_active = 1");
$web_id = $get_web_id['web_id'];
$web_icon = $get_web_id['web_icon'];

$get_url = get_data_row("SELECT con_rewrite_name_homepage FROM configuration WHERE web_id = $web_id");
foreach ($get_url as $key => $g_url) {
    $url = $g_url;
}

$per_page_record = 9;

if (isset($_GET['page'])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;

if (isset($_GET['url'])) {
    $url_rough = $_GET['url'];
    $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url_rough);
}

if (strpos($url, "/") != false) {
    $url = $g_url;
    header('location: ../');
}

$category = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id");
$arr_con = get_data_row("SELECT * FROM configuration WHERE web_id = $web_id");

$get_slide = get_data_row("SELECT con_background_homepage FROM configuration WHERE web_id = $web_id");
$url_slide = explode(",", $get_slide['con_background_homepage']);

$post_type = get_data_rows("SELECT * FROM post_type WHERE allow_show_homepage = 1 AND web_id = $web_id");

$sql = "SELECT COUNT(*) FROM product";
$result = new db_query($sql);
$row = mysqli_fetch_row($result->result);
$total_record = $row[0];
unset($result, $sql);

$total_pages = ceil($total_record / $per_page_record);
$pageLink = "";

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $arr_con['con_site_title'] ?></title>
    <? include("./includes/inc_head.php"); ?>
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- SLIDESHOW --------------->

    <div class="content">
        <div class="container-fluid">
            <div class="owl-carousel owl-1">
                <?php
                foreach ($url_slide as $key => $url) { ?>
                    <div>
                        <img src="<?php echo $base_url.$url ?>" alt="Carousel background" class="img-fluid">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--------------- CONTENT --------------->

    

    <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>