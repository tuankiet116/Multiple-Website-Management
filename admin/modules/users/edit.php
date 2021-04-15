<?php
include("inc_security.php");
checkAddEdit("edit");

//Khai báo biến khi thêm mới
$after_save_data = getValue("after_save_data", "str", "POST", "listing.php");
$add = "add.php";
$listing = "listing.php";
$fs_title = "Chỉnh sửa thông tin Sinh Viên";
$fs_action = getURL();
$fs_redirect = base64_decode(getValue("url", "str", "GET", base64_encode($after_save_data)));
$fs_errorMsg = "";
$record_id = getValue("record_id");

$use_name = "";
$use_code = '';
$use_idnumber = '';
$use_active = 0;
$use_gender = 1;
$use_birthdays = date('d-m-Y');
$use_created_time = time();
$use_updated_time = time();

if ($record_id > 0) {
    //lay du lieu cua record can sua doi
    $db_data = new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
    if ($row = mysqli_fetch_assoc($db_data->result)) {
        foreach ($row as $key => $value) {
            if ($key != 'admin_id') {
                $$key = $value;
            }
            if ($key == 'use_birthdays') {
                $$key = date('d-m-Y', $value);
            }
        }
    } else {
        exit("Cannot find data");
    }
    $db_data->close();
    unset($db_data);
}
$old_use_code_md5 = $use_code_md5;
$old_use_idnumber_md5 = $use_idnumber_md5;

$school_id = getValue("school_id", "int", "POST", $use_school_id);
$faculty_id = getValue("faculty_id", "int", "POST", $use_faculty_id);
$class_id = getValue("class_id", "int", "POST", $use_class_id);
$use_name = getValue("use_name", "str", "POST", $use_name, 3);
$use_code = getValue("use_code", "str", "POST", $use_code, 3);
$use_code_md5 = md5($use_code);
$use_idnumber = getValue("use_idnumber", "str", "POST", $use_idnumber, 3);
$use_idnumber_md5 = md5($use_idnumber);
$use_active = getValue("use_active", "int", "POST", $use_active);
$use_gender = getValue("use_gender", "int", "POST", $use_gender);
$use_birthdays = getValue("use_birthdays", "str", "POST", $use_birthdays);
$use_birthdays = strtotime(str_replace('/', '-', $use_birthdays));
if (empty($use_birthdays)) {
    $use_birthdays = time();
}
$use_updated_time = time();

//Call Class generate_form();
$myform = new generate_form();
$myform->add("use_school_id", "school_id", 1, 1, 0, 1, "Bạn chưa chọn Trường.", 0, "");
$myform->add("use_faculty_id", "faculty_id", 1, 1, 0, 1, "Bạn chưa chọn Khoa.", 0, "");
$myform->add("use_class_id", "class_id", 1, 1, 0, 1, "Bạn chưa chọn Lớp.", 0, "");
$myform->add("use_name", "use_name", 0, 1, "", 1, translate("Họ và Tên không được để trống."), 0, "");
$myform->add("use_birthdays", "use_birthdays", 0, 1, "", 1, translate("Bạn chưa nhập Ngày sinh"));
$myform->add("use_gender", "use_gender", 1, 1, "");
$myform->add("use_code", "use_code", 0, 1, "", 1, translate("Mã Sinh Viên không được để trống"), 0, "0");
if($use_code_md5 != $old_use_code_md5) $myform->add("use_code_md5", "use_code_md5", 0, 1, "", 0, translate("Mã Sinh Viên không được để trống"), 1, "Mã Sinh Viên đã tồn tại trong hệ thống.");
$myform->add("use_idnumber", "use_idnumber", 0, 1, "", 1, translate("Số CMND/Hộ chiếu không được để trống."), 0, "0");
if($use_idnumber_md5 != $old_use_idnumber_md5)  $myform->add("use_idnumber_md5", "use_idnumber_md5", 0, 1, "", 0, translate("Số CMND/Hộ chiếu không được để trống."), 1, "Số CMND/Hộ chiếu đã tồn tại trong hệ thống.");
$myform->add("use_active", "use_active", 1, 1, 1, 0, "", 0, "");
$myform->add("use_updated_time", "use_updated_time", 1, 1, 1, 0, "", 0, "");
$myform->add("admin_id", "admin_id", 1, 1, 1, 0, "", 0, "");
$myform->addTable($fs_table);

$action = getValue("action", "str", "POST", "");

//Check $action for insert new data
if ($action == "execute") {
    //Check form data
    $fs_errorMsg .= $myform->checkdata();

    //Get $filename and upload
    $filename	= "";
    if($fs_errorMsg == ""){
        $upload			= new upload_image();
        $upload->upload($fs_fieldupload, $fs_filepath, $fs_extension, $fs_filesize, 0);
        $filename		= $upload->file_name;
        $fs_errorMsg	.= $upload->warning_error;
    }

    if ($fs_errorMsg == "") {
        if($filename != ""){
            $$fs_fieldupload = $filename;
            $myform->add($fs_fieldupload, $fs_fieldupload, 0, 1, "", 0, "", 0, "");
        }//End if($filename != "")

        if ($record_id > 0) {
            $db_ex = new db_execute($myform->generate_update_SQL($id_field, $record_id));
            unset($db_ex);
            redirect($fs_redirect);
        } else {
            //Insert to database
            $myform->removeHTML(0);
            $db_insert = new db_execute($myform->generate_insert_SQL());
            unset($db_insert);
            //Redirect after insert complate
            redirect($fs_redirect);
        }
    }
    //End if($fs_errorMsg == "")
}//End if($action == "insert")

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?= $load_header ?>
    <?php
    //add form for javacheck
    $myform->addFormname("add");
    $myform->checkjavascript();
    //chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
    $myform->evaluate();
    $fs_errorMsg .= $myform->strErrorField;
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
    <?= $form->select_db("Chọn Trường", "school_id", "school_id", $list_schools, "sch_id", "sch_name", $school_id, "Chọn Trường", 1, "250", 1, 0, 'onchange="loadFaculties();"', "") ?>
    <?= $form->text("Họ và Tên", "use_name", "use_name", $use_name, "Họ và Tên", 1, 250, "", 255, "", "", "") ?>
    <?= $form->text("Mã Sinh Viên", "use_code", "use_code", $use_code, "Mã Sinh Viên", 1, 250, "", 50, "", "", "") ?>
    <tr>
        <td class="form_name" style="vertical-align: top; padding-top: 6px;">Ảnh đại diện: </td>
        <td colspan="form_text">
            <input type="file" id="use_picture" name="use_picture" />
            <div style="font-size: 11px; font-style: italic;">(Dung lượng tối đa <font color="#FF0000"><?=$fs_filesize?> Kb</font>)</div>
            <div id="result_upload_icon">
                <div class="img" style="padding: 4px 0px;">
                    <?
                    if($use_picture != ''){
                        ?>
                        <img src="<?=$imgViewURL . $use_picture?>" width="50" alt="" />
                    <?
                    }
                    ?>
                </div>
            </div>
        </td>
    </tr>
    <?= $form->text("Số CMND/Hộ chiếu", "use_idnumber", "use_idnumber", $use_idnumber, "Số CMND/Hộ chiếu", 1, 250, "", 50, "", "", "") ?>
    <?= $form->radio("Giới tính", "nam" . $form->ec . "nu", "use_gender", "1" . $form->ec . "2", $use_gender, "Nam" . $form->ec . "Nữ", 0, $form->ec, ""); ?>
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

    <?= $form->checkbox("Kích hoạt", "use_active", "use_active", 1, $use_active, "Kích hoạt", 0, "", "") ?>
    <?= $form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, ""); ?>
    <?= $form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", '' . $form->ec . '', ""); ?>
    <?= $form->hidden("action", "action", "execute", ""); ?>

    <?php
    $form->close_table();
    $form->close_form();
    unset($form);
    ?>
</p>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?= template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
