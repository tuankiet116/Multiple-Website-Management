<?
require_once("config.php");
ob_start("callback");

if ($myuser->u_id <= 0) {
    redirect(LOGIN_URL);
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hệ thống điểm danh sinh viên | Lịch sử điểm danh</title>
        <? include("../includes/inc_head.php"); ?>
    </head>
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <? include("../includes/inc_top_menu.php"); ?>
        <? include("../includes/inc_left_menu.php"); ?>
        <? include("../includes/inc_history_calender.php"); ?>
    </div>
    <? include("../includes/inc_footer.php"); ?>
    </body>
    </html>

<?
ob_end_flush();
?>