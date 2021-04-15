<?
require_once("config.php");
$myuser->logout();

$time_redirect	= 2;
ob_start("callback");
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="<?=$time_redirect?>; URL=/" />
        <title>Hệ thống điểm danh sinh viên | Đăng xuất</title>
        <? include("../includes/inc_head.php"); ?>
    </head>
    <body class="hold-transition login-page" style="height: 50vh;">
    <div class="logout-box" style="padding: 0px 20px">
        <div class="login-logo">
            <a href="/"><b>Face EPU</b> system</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" style="line-height: 180%; border-radius: 5px">
                <div class="text-danger"><i class="fa fa-power-off" aria-hidden="true"></i> <strong>Bạn đã đăng xuất khỏi hệ thống !</strong></div>
                <div>Bạn hãy <a href="/">ấn vào đây</a> để ra ngoài, hoặc website sẽ tự động quay ra trong <?=$time_redirect?> giây nữa.</div>
                <div style="text-align: center"><img src="/images/loading_process.gif" width="50"></div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    </body>
    </html>
<?
ob_end_flush()
?>