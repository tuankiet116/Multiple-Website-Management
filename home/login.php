<?
require_once("config.php");
ob_start("callback");
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hệ Thống Nhân Sự| Đăng nhập</title>
        <? include("../includes/inc_head.php"); ?>
    </head>
    <body class="hold-transition login-page">
        <? include("../includes/inc_login.php"); ?>
        <? include("../includes/inc_footer.php"); ?>
    </body>
    </html>
<?
ob_end_flush()
?>