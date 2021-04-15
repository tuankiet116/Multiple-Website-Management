<?
include("inc_security.php");
checkAddEdit("edit");

$fs_redirect = base64_decode(getValue("url", "str", "GET", base64_encode("listing.php")));
$record_id = getValue("record_id");
$infoUser = array();
if ($record_id > 0) {
    //lay du lieu cua record can sua doi
    $db_data = new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
    if ($row = mysqli_fetch_assoc($db_data->result)) {
        $infoUser = $row;
    } else {
        exit("Cannot find data");
    }
    $db_data->close();
    unset($db_data);
}


//Khai báo biến khi thêm mới
$fs_title = "Reset Mật Khẩu Tài Khoản";
$fs_action = getURL();
$fs_errorMsg = "";
$status_update = 0;
$new_pasword = getValue("new_pasword", "str", "POST", "", 1);
$confirm_pasword = getValue("confirm_pasword", "str", "POST", "", 1);

$myform = new generate_form();
$myform->add("new_pasword", "new_pasword", 0, 1, 0, 1, "Bạn chưa nhập Mật khẩu mới.", 0, "");
$myform->add("confirm_pasword", "confirm_pasword", 0, 1, 0, 1, "Vui lòng xác nhận lại Mật khẩu mới.", 0, "");

///Get action variable for add new data
$action = getValue("action", "str", "POST", "");
//Check $action for insert new data
if ($action == "execute") {

    $fs_errorMsg .= $myform->checkdata();
    if($new_pasword !== $confirm_pasword) $fs_errorMsg .= "&bull; Mật khẩu mới và Mật khẩu xác nhận không trùng khớp.<br />";

    if ($fs_errorMsg == "") {
        $password = md5($new_pasword . $infoUser['use_salt']);
        $db_execute = new db_execute("UPDATE " . $fs_table . " SET use_password = '" . replaceMQ($password) . "' WHERE use_id = " . $record_id);
        unset($db_execute);
        $status_update = 1;
    }
}//End if($action == "execute")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?= $load_header ?>
    <?php
    //add form for javacheck
    $myform->addFormname("edit");
    $myform->checkjavascript();
    //chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
    $myform->evaluate();
    $fs_errorMsg .= $myform->strErrorField;
    ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<div class="container">
    <div class="row">
        <p style="text-align: left; padding:20px 0px; font-size: 16px">Đổi Mật khẩu cho Sinh Viên: <b
                style="font-size: 16px"><?= $infoUser['use_name'] ?></b></p>
    </div>
    <div class="row">
        <?
        $form = new form();
        $form->create_form("edit", $fs_action, "post", "multipart/form-data", 'onsubmit="validateForm(); return false;"');
        $form->create_table();
        ?>
        <?= $form->errorMsg($fs_errorMsg) ?>
        <?= $form->password("Mật khẩu mới", "new_pasword", "new_pasword", $new_pasword, "Mật khẩu mới", 1, 200, "", 255, "", "", "") ?>
        <?= $form->password("Xác nhận mật khẩu", "confirm_pasword", "confirm_pasword", $confirm_pasword, "Xác nhận mật khẩu", 1, 200, "", 255, "", "", "") ?>
        <?= $form->button("submit" . $form->ec . "button", "submit" . $form->ec . "button", "submit" . $form->ec . "button", "Cập nhật" . $form->ec . "Đóng", "Cập nhật" . $form->ec . "Đóng", '' . $form->ec . ' onclick="window.parent.closeWindowPrompt();"', ""); ?>
        <?= $form->hidden("action", "action", "execute", ""); ?>
        <?
        $form->close_table();
        $form->close_form();
        unset($form);
        ?>
    </div>
    <? if($status_update == 1){ ?>
    <div class="row">
        <div style="text-align: center;">
            <img src="/images/ico_ok.png" alt="" style="width: 30px"> <b style="color: #0bc54f; font-size: 12px; line-height: 30px">Thay đổi Mật khẩu thành công !</b>
        </div>
    </div>
    <? } ?>
</div>
<?= template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>