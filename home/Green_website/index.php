<?php
require_once('../../classes/database.php');
$web_id = 'web_id = 2';
$url = 'trang-chu';

if (isset($_GET['url'])) {
    $url = $_GET['url'];
}

function get_data($url, $web_id)
{
    $sql = "SELECT * FROM categories_multi_parent WHERE cmp_rewrite_name = '$url' AND $web_id";
    $result = new db_query($sql);
    if (mysqli_num_rows($result->result) > 0) {
        $data = mysqli_fetch_array($result->result, MYSQLI_ASSOC);
    }
    unset($sql, $result);
    return $data;
}
$a = get_data($url, $web_id);
if (empty($a)) {
    header('location: ./');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title> Mua bán cây cảnh </title>
    <? include("./includes/inc_head.php"); ?>
</head>

<body>
    <!--------------- HEADER --------------->

    <? include('./includes/inc_header.php') ?>

    <!--------------- SLIDESHOW --------------->

    <? include('./includes/inc_slideshow.php') ?>

    <!--------------- CONTENT --------------->

    <? include('./includes/inc_content.php') ?>

    <!--------------- FOOTER --------------->

    <? include('./includes/inc_footer.php') ?>

    <? include('./includes/inc_foot.php') ?>
</body>

</html>