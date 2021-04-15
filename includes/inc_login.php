<?
$errorMsg   = "";
$login_name = getValue("login_name", "str", "POST", "");
$login_password = getValue("login_password", "str", "POST", "");
$action = getValue("action", "str", "POST", "");

if($action == "login"){
    $myuser = new user($login_name, $login_password);
    if ($myuser->u_id > 0) {
        $myuser->savecookie();
        redirect(ACC_URL);
    }else{
        $errorMsg = "Đăng nhập không thành công. Vui lòng thử lại !";
    }
}
?>
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>VVECO Personal Manager</b> system</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"></p>

            <form action="<?=LOGIN_URL?>" method="post" id="login-form" class="needs-validation" novalidate>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="login_name" name="login_name" placeholder="Mã SV/Số CMT/Hộ chiếu" value="<?=$login_name?>" required>
                    <div class="invalid-feedback">Vui lòng nhập Mã SV/Số CMT/Hộ chiếu để đăng nhập.</div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Mật khẩu" value="" required>
                    <div class="invalid-feedback">Vui lòng nhập Mật khẩu đăng nhập.</div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <? if($errorMsg != ""){ ?>
                        <div class="text-danger" style="padding-bottom: 20px">
                            <?=$errorMsg?>
                        </div>
                        <? } ?>

                        <input type="hidden" id="action" name="action" value="login" />
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>