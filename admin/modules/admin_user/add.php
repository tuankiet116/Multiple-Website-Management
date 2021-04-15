<?
require_once("inc_security.php");

// Check quyền thêm mới
checkAddEdit("add");

$ff_action = $_SERVER['REQUEST_URI'];
$ff_redirect_succ = "listing.php";
$ff_redirect_fail = "";
$Action = getValue("Action", "str", "POST", "");
$arelate_select = getValue("arelate_select", "arr", "POST", array());

//get vaule from POST
$adm_loginname = getValue("adm_loginname", "str", "POST", "", 1);
//password hash md5 --> only replace \' = '
$adm_password = getValue("adm_password", "str", "POST", "", 1);
//get Access Module list
$module_list = "";
$module_list = getValue("mod_id", "arr", "POST", "");

//$user_lang_id_list = getValue("user_lang_id","arr","POST","");
$user_lang_id_list = array(0 => 1); // Luôn lấy tiếng Việt

$errorMsg = "";
$allow_insert = 1;

$myform = new generate_form();
$myform->add("adm_loginname", "adm_loginname", 0, 0, "", 1, translate_text("Tên đăng nhập không được để trống và phải có độ dài tối thiểu 3 ký tự"), 1, translate_text("Tài khoản đã tồn tại. Vui lòng thử tài khoản khác."));
$myform->add("adm_password", "adm_password", 4, 0, "", 1, translate_text("Mật khẩu phải đặt tối thiểu 4 ký tự."), 0, "");
$myform->add("adm_email", "adm_email", 2, 0, "", 1, translate_text("Email không đúng định dạng."), 0, "");
$myform->add("adm_name", "adm_name", 0, 0, "", 0, "", 0, "");
$myform->add("adm_job", "adm_job", 1, 0, 0, 0, "", 0, "");
$myform->add("adm_phone", "adm_phone", 0, 0, "", 0, "", 0, "");
$myform->add("adm_all_category", "adm_all_category", 1, 0, 0, 0, "", 0, "");
$myform->add("adm_access_category", "adm_access_category", 0, 1, "", 0, "", 0, "");
$myform->add("adm_edit_all", "adm_edit_all", 1, 0, 0, 0, "", 0, "");
$myform->add("admin_id", "admin_id", 1, 1, 0, 0, "", 0, "");
$myform->addTable("admin_user");

if ($Action == 'insert') {
    if ($module_list == "") {
        $allow_insert = 0;
        $errorMsg .= "&bull; Bạn chưa lựa chọn Quyền truy cập.<br />";
    }

    //insert new user to database
    if ($allow_insert == 1) {

        //Call Class generate_form();
        $querystr = $myform->generate_insert_SQL();
        $errorMsg .= $myform->checkdata();
        $last_id = 0;
        if ($errorMsg == "") {
            $db_ex = new db_execute_return($querystr);
            $last_id = $db_ex->last_id;
            unset($db_ex);
            if ($last_id != 0) {
                //insert user right\
                if (isset($module_list[0])) {
                    for ($i = 0; $i < count($module_list); $i++) {
                        $query_str = "INSERT INTO admin_user_right VALUES(" . $last_id . "," . $module_list[$i] . ", " . getValue("adu_add" . $module_list[$i], "int", "POST") . ", " . getValue("adu_edit" . $module_list[$i], "int", "POST") . ", " . getValue("adu_delete" . $module_list[$i], "int", "POST") . ")";
                        $db_ex = new db_execute($query_str);
                        unset($db_ex);
                    }
                }
                if (isset($user_lang_id_list[0])) {
                    for ($i = 0; $i < count($user_lang_id_list); $i++) {
                        $query_str = "INSERT INTO admin_user_language VALUES(" . $last_id . "," . $user_lang_id_list[$i] . ")";
                        $db_ex = new db_execute($query_str);
                        unset($db_ex);
                    }
                }

                if (isset($user_city_id_list[0])) {
                    for ($i = 0; $i < count($user_city_id_list); $i++) {
                        $query_str = "INSERT INTO admin_user_city VALUES(" . $last_id . "," . $user_city_id_list[$i] . ")";
                        $db_ex = new db_execute($query_str);
                        unset($db_ex);
                    }
                }
                //category right

                redirect($ff_redirect_succ);
                exit();
            }
        }
    }
}
$myform->evaluate();

$db_getallmodule = new db_query("SELECT *
                               FROM modules
                               ORDER BY mod_id DESC");
// Không phải super admin thì chỉ hiển thị những module mà user hiện tại có quyền truy cập thôi, không cho chọn module quản trị admin
if ($is_admin != 1) {
    $db_getallmodule = new db_query("SELECT *
											   FROM admin_user, admin_user_right, modules
											   WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_id =" . $admin_id . " AND mod_id <> 14");
} // End if($is_admin != 1)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?= $load_header ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

<? /*------------------------------------------------------------------------------------------------*/ ?>
<div class="listing">
    <?= template_top(translate_text("Thêm mới Tài khoản Administrator")) ?>
    <div class="content">
        <? /*---------Body------------*/ ?>
        <form action="<?= $ff_action; ?>" method="POST" name="add_user" enctype="multipart/form-data">
            <table class="table table_border_none" align="left">
                <tr valign="baseline">
                    <td></td>
                    <td class="form_text">
                        <font color="#FF0000"><?= $errorMsg; ?></font>
                    </td>
                </tr>
                <tr <?= $fs_change_bg ?>>
                    <td align="right" valign="middle" nowrap class="form_name"><?= translate_text("Tên đăng nhập") ?>:</td>
                    <td class="form_text">
                        <input type="text" name="adm_loginname" id="adm_loginname" value="<?= $adm_loginname ?>"
                               size="50" class="form-control">
                    </td>
                </tr>
                <tr <?= $fs_change_bg ?>>
                    <td align="right" valign="middle" nowrap class="form_name"><?= translate_text("Họ và tên") ?> :</td>
                    <td class="form_text">
                        <input type="text" name="adm_name" id="adm_name" value="<?= $adm_name ?>" size="50"
                               class="form-control">
                    </td>
                </tr>
                <tr <?= $fs_change_bg ?>>
                    <td align="right" valign="middle" nowrap class="form_name"><?= translate_text("Số ĐT") ?> :</td>
                    <td class="form_text">
                        <input type="text" name="adm_phone" id="adm_phone" value="<?= $adm_phone ?>" size="50"
                               class="form-control">
                    </td>
                </tr>
                <tr <?= $fs_change_bg ?>>
                    <td align="right" valign="middle" nowrap class="form_name"><?= translate_text("Mật khẩu") ?> :</td>
                    <td class="form_text"><input type="password" name="adm_password" size="50" class="form-control"></td>
                </tr>
                <tr <?= $fs_change_bg ?>>
                    <td align="right" valign="middle" nowrap class="form_name"><?= translate_text("Xác nhận mật khẩu") ?>
                        :
                    </td>
                    <td  class="form_text"><input type="password" name="adm_password_con" size="50" class="form-control"></td>
                </tr>
                <tr <?= $fs_change_bg ?>>
                    <td align="right" valign="middle" nowrap class="form_name"><?= translate_text("Email") ?> :</td>
                    <td class="form_text">
                        <input type="text" name="adm_email" id="adm_email" value="<?= $adm_email ?>" size="50" class="form-control">
                    </td>
                </tr>
                <tr <?= $fs_change_bg ?>>
                    <td align="right" valign="middle" nowrap class="form_name"><?= translate_text("Quyền truy cập") ?>:</td>
                    <td class="form_text">
                        <table cellpadding="4" cellspacing="0" style="border-collapse:collapse; width: 336px" border="1" bordercolor="<?= $fs_border ?>">
                            <tr style="background: #002347; color: #FFF" height="30">
                                <td class="textBold"><?= translate_text("Chọn") ?></td>
                                <td class="textBold"><?= translate_text("Module") ?></td>
                                <td class="textBold"><?= translate_text("Thêm") ?></td>
                                <td class="textBold"><?= translate_text("Sửa") ?></td>
                                <td class="textBold"><?= translate_text("Xóa") ?></td>
                            </tr>
                            <?
                            while ($row = mysqli_fetch_assoc($db_getallmodule->result)) {
                                if (file_exists("../../modules/" . $row["mod_path"] . "/inc_security.php") === true) {
                                    ?>
                                    <tr>
                                        <td align="center">
                                            <input type="checkbox" name="mod_id[]" id="mod_id" value="<?= $row['mod_id']; ?>">
                                        </td>
                                        <td class="textBold"><?= translate_text($row['mod_name']); ?></td>
                                        <td align="center">
                                            <input type="checkbox" name="adu_add<?= $row['mod_id']; ?>" id="adu_add<?= $row['mod_id']; ?>" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="checkbox" name="adu_edit<?= $row['mod_id']; ?>" id="adu_edit<?= $row['mod_id']; ?>" value="1">
                                        </td>
                                        <td align="center">
                                            <input type="checkbox" name="adu_delete<?= $row['mod_id']; ?>" id="adu_delete<?= $row['mod_id']; ?>" value="1">
                                        </td>
                                    </tr>
                                <?
                                }
                            }
                            unset($db_getall_channel);
                            ?>
                        </table>
                    </td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right"></td>
                    <td>
                        <input type="button" class="btn btn-primary btn-sm" onClick="document.add_user.submit();" value="<?= translate_text("Thêm mới") ?>"/>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="Action" value="insert"/>
        </form>
        <? /*---------Body------------*/ ?>
    </div>
</div>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
<?
$db_getallmodule->close();
unset($db_getallmodule);
?>