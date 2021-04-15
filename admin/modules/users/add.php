<?php
include("inc_security.php");
checkAddEdit("add");

//Khai báo biến khi thêm mới
$after_save_data = getValue("after_save_data", "str", "POST", "listing.php");
$add = "add.php";
$listing = "listing.php";
$fs_title = "Thêm Mới Nhân Viên";
$fs_action = getURL();
$fs_redirect = base64_decode(getValue("url", "str", "GET", base64_encode($after_save_data)));
$fs_errorMsg = "";

$mem_account = 0;
$use_active = 0;
$use_gender = 1;
$use_birthdays = date('d-m-Y');
$use_created_time = time();
$use_updated_time = time();

$use_code = getValue("use_code", "str", "POST", "", 3);
$use_code_md5 = md5($use_code);
$use_idnumber = getValue("use_idnumber", "str", "POST", "", 3);
$use_idnumber_md5 = md5($use_idnumber);
$use_active = getValue("use_active", "int", "POST", $use_active);
$use_gender = getValue("use_gender", "int", "POST", $use_gender);
$use_birthdays = getValue("use_birthdays", "str", "POST", $use_birthdays);
$use_birthdays = strtotime(str_replace('/', '-', $use_birthdays));

$date = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh') );
$mem_name = getValue("mem_name", "str", "POST", "");
$mem_created_date = $date->format('Y-m-d H:i:s');
$mem_updated_date = $date->format('Y-m-d H:i:s');
$mem_id_role = getValue("mem_id_role", "int", "POST");
$mem_workshift = getValue("mem_workshift", "int", "POST");
$mem_account = getValue("mem_account", "int", "POST");

if($use_gender == 1){
    $avatar = "../data/default/avatar/male/male_default02.png";
}
elseif($use_gender == 2){
    $avatar = "../data/default/avatar/female/female_default01.png";
}
else{
    $avatar = "../data/default/avatar/none_gender/none01.png";
}
$notify_token = "";
$position = "";

if (empty($use_birthdays)) {
    $use_birthdays = time();
}
//Call form for members
$form_members = new generate_form();
$form_members->add("created_date", "mem_created_date", 0, 1, $mem_created_date);
$form_members->add("group_id", "group_id", 1, 1,1);
$form_members->add("name", "mem_name", 0,1,"");
$form_members->add("updated_date", "mem_updated_date", 0,1, $mem_updated_date);
$form_members->add("avatar", "avatar", 0, 1, $avatar);
$form_members->add("notify_token", "notify_token", 0,1,"");
$form_members->add("position", "position", 0,1,$position);
$form_members->add("active", "use_active", 1,1, 0);
$form_members->add("mem_id_role", "mem_id_role", 1,1,0,1,translate_text("Trường Chức Vụ Không Được Để Trống"));
$form_members->add("mem_workshift", "mem_workshift", 1,1,1, 1,translate_text("Trường Ca Làm Không Được Để Trống"));
$form_members->addTable($fs_table_members);

//Call Class generate_form() for form insert users_login, myform variable for form users_login
$form_users_login = new generate_form();
$form_users_login->add("use_birthdays", "use_birthdays", 0, 1, "", 1, translate("Bạn chưa nhập Ngày sinh"));
$form_users_login->add("use_gender", "use_gender", 1, 1, "");
$form_users_login->add("use_password", "use_password", 0, 1, '', 0, "", 0, "");
$form_users_login->add("use_salt", "use_salt", 0, 1, '', 0, "", 0, "");
$form_users_login->add("use_code", "use_code", 0, 1, "", 1, translate("Mã Nhân Viên không được để trống"), 0, "0");
$form_users_login->add("use_code_md5", "use_code_md5", 0, 1, "", 0, translate("Mã Nhân Viên không được để trống"), 1, "Mã Nhân Viên đã tồn tại trong hệ thống.");
$form_users_login->add("use_idnumber", "use_idnumber", 0, 1, "", 1, translate("Số CMND/Hộ chiếu không được để trống."), 0, "0");
$form_users_login->add("use_idnumber_md5", "use_idnumber_md5", 0, 1, "", 0, translate("Số CMND/Hộ chiếu không được để trống."), 1, "Số CMND/Hộ chiếu đã tồn tại trong hệ thống.");
$form_users_login->add("use_type", "use_type", 1, 1, 1, 0, "", 0, "");
$form_users_login->add("use_active", "use_active", 1, 1, 1, 0, "", 0, "");
$form_users_login->add("use_created_time", "use_created_time", 1, 1, 1, 0, "", 0, "");
$form_users_login->add("use_updated_time", "use_updated_time", 1, 1, 1, 0, "", 0, "");
$form_users_login->add("admin_id", "admin_id", 1, 1, 1, 0, "", 0, "");
$form_users_login->addTable($fs_table_users_login);

$use_salt = md5(rand(100000, 999999));
$use_password = md5('123456' . $use_salt);

$action = getValue("action", "str", "POST", "");

//Check $action for insert new data
if ($action == "execute") {
    //Check form data
    $fs_errorMsg .= $form_users_login->checkdata();
    $fs_errorMsg .= $form_members->checkdata();

    if ($fs_errorMsg == "") {
        //Insert to database
        $form_members->removeHTML(1);
        $db_insert_members = new db_execute_return($form_members->generate_insert_SQL());
        $id_members = $db_insert_members->last_id;
        unset($db_insert_members);

        if($mem_account == 1){
            $form_users_login->removeHTML(1);
            $db_insert_userslogin = new db_execute("INSERT INTO users_login(use_password, use_salt, use_birthdays, use_code, use_code_md5, use_idnumber, 
                use_idnumber_md5, use_type, use_created_time, use_updated_time, admin_id, use_active, use_memid) 
                VALUES ('$use_password', '$use_salt', '$use_birthdays', '$use_code', '$use_code_md5', '$use_idnumber', '$use_idnumber_md5', 1, '$use_created_time',
                '$use_updated_time', 1, '$use_active',  '$id_members')");
            unset($db_insert_userslogin);
        }
        //Redirect after insert complate
        //redirect($fs_redirect);
    }
    //End if($fs_errorMsg == "")
}//End if($action == "insert")

$list_role_employee = new db_query("SELECT * FROM role_employee WHERE rol_deleteflag = 0");
$list_workshift     = new db_query("SELECT * FROM workshift WHERE wor_delete_flag = 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?= $load_header ?>
    <?php
    //add form for javacheck
    $form_members->addFormname("add");
    $form_users_login->addFormname("add");

    $form_members->checkjavascript();
    //chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
    $form_members->evaluate();
    $form_users_login->evaluate();
    $fs_errorMsg .= $form_members->strErrorField;
    $fs_errorMsg .= $form_users_login->strErrorField;
    ?>
</head>

<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?= template_top($fs_title) ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<p align="center" style="padding-left:10px;">
    <?php
    $form = new form();
    $form->create_form("add", $fs_action, "post", "multipart/form-data", 'onsubmit="validateForm(); return false;"');
    $form->create_table();
    ?>
    <?= $form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.') ?>
    <?= $form->errorMsg($fs_errorMsg) ?>
    <?= $form->text("Họ Và Tên", "mem_name", "mem_name", $mem_name, "Họ Và Tên", 1, 250, "", 50, "", "", "") ?>
    <?= $form->text("Mã NHân Viên", "use_code", "use_code", $use_code, "Mã Nhân Viên", 1, 250, "", 50, "", "", "") ?>
    <?= $form->text("Số CMND/Hộ chiếu", "use_idnumber", "use_idnumber", $use_idnumber, "Số CMND/Hộ chiếu", 1, 250, "", 50, "", "", "") ?>
    <?= $form->radio("Giới tính", "nam" . $form->ec . "nu", "use_gender", "1" . $form->ec . "2", 1, "Nam" . $form->ec . "Nữ", 0, $form->ec, ""); ?>
    <tr>
        <td class="form_name">Ngày sinh :</td>
        <td class="form_text">
            <input type="text" class="form-control date" name="use_birthdays" id="use_birthdays"
                   onkeypress="displayDatePicker('use_birthdays', this);"
                   onclick="displayDatePicker('use_birthdays', this);"
                   onfocus="if(this.value=='Enter Ngày tạo') this.value=''"
                   onblur="if(this.value=='') this.value='Enter Ngày tạo'"
                   value="<?= date('d/m/Y', $use_birthdays) ?>">
        </td>
    </tr>

    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Chọn Chức Vụ :</td>
        <td class="form_text" id="listRoleEmployee">
            <select class="form-control" title="Chọn Chức Vụ" id="mem_id_role" name="mem_id_role" style="width:250px" size="1">
                <option value="">- Chọn Chức Vụ -</option>
                <?
                $arrRoleEmployee = convert_result_set_2_array($list_role_employee->result, "rol_id");
                foreach($arrRoleEmployee as $key => $value){
                    $selected = ($value["rol_id"] == $rol_id ? " selected" : "");
                    ?>
                    <option value="<?=$value["rol_id"]?>"<?=$selected?>><?=$value["rol_name"]?></option>
                    <?
                }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <td class="form_name"><font class="form_asterisk">* </font>Thời Gian Làm Việc :</td>
        <td class="form_text" id="listWorkShift">
            <select class="form-control" title="Thời Gian Làm Việc " id="mem_workshift" name="mem_workshift" style="width:250px" size="1">
                <option value="">- Thời Gian Làm Việc -</option>
                <?
                    while($row = mysqli_fetch_assoc($list_workshift->result)){
                        $selected = ($row["wor_idShift"] == $wor_id ? "selected" : "");
                        ?>
                        <option value="<? echo $row['wor_idShift']; ?>"> <? echo $row['wor_Name']; ?>
                            -- Giờ Làm: <?echo $row['wor_StartTime'];?>
                            -- Giờ Kết Thúc: <? echo $row["wor_FinishTime"];?> </option>
                        <?
                    }

                ?>
            </select>
        </td>
    </tr>
    <?= $form->checkbox("Tạo tài khoản", "mem_account", "mem_account", 1, $mem_account, "Tạo tài khoản", 1, "", "") ?>
    <?= $form->checkbox("Kích hoạt", "use_active", "use_active", 1, $use_active, "Kích hoạt", 1, "", "") ?>
    <?= $form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, ""); ?>
    <?= $form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", '' . $form->ec . '', ""); ?>
    <?= $form->hidden("action", "action", "execute", ""); ?>

    <?php
    $form->close_table();
    $form->close_form();
    unset($form);
    ?>
    <script type="text/javascript">
        // function ajax load workshift into select-option
        function loadWorkShift(){
            var workshiftID = $("#workshift_id").val();
            $( "#list" ).html("<img src='/images/loading_process.gif' height='34px' />");

            setTimeout(function(){
                $( "#listWorkShift" ).load("/ajax/load_workshift.php?workshiftID=" + workshiftID);
            }, 500);
        }

        //funtion ajax load role of employee into select-option
        function loadRoleEmployee(){
            var roleID = $("#role_id").val();
            $( "#listRoleEmployee" ).html("<img src='/images/loading_process.gif' height='34px' />");

            setTimeout(function(){
                $( "#listRoleEmployee" ).load("/ajax/load_role_employee.php?roleID=" + roleID);
            }, 500);
        }
    </script>
</p>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?= template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
