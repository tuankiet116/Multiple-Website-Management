<?
require_once("config.php");
ob_start("callback");

if ($myuser->u_id > 0) {
	redirect(ACC_URL);
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hệ thống điểm danh sinh viên | 404 Not found</title>
        <? include("../includes/inc_head.php"); ?>
    </head>
    <body class="hold-transition notfound-page">
        <? include("../includes/inc_notfound.php"); ?>
        <? include("../includes/inc_footer.php"); ?>
    </body>
    </html>
<?
ob_end_flush();
?>