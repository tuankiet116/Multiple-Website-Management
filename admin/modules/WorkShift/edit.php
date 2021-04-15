<?php
include("inc_security.php");
checkAddEdit("edit");

//Khai báo biến khi thêm mới
$after_save_data = getValue("after_save_data", "str", "POST", "listing.php");
$add = "add.php";
$listing = "listing.php";
$fs_title = "Chỉnh sửa thông tin Checkin";
$fs_action = getURL();
$fs_redirect = base64_decode(getValue("url", "str", "GET", base64_encode($after_save_data)));
$fs_errorMsg = "";
$record_id = getValue("record_id");

// $use_name = "";
// $use_code = '';
// $use_idnumber = '';
// $use_active = 0;
// $use_gender = 1;
// $use_birthdays = date('d-m-Y');
// $use_created_time = time();
// $use_updated_time = time();

if ($record_id > 0) {
    //lay du lieu cua record can sua doi
    $db_data = new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
    if ($row = mysqli_fetch_assoc($db_data->result)) {
        foreach ($row as $key => $value) {
            if ($key != 'admin_id') {
                $$key = $value;
            }
        }
    } else {
        exit("Cannot find data");
    }
    $db_data->close();
    unset($db_data);
}


$wor_idShift = getValue("wor_idShift", "int", "POST", $wor_idShift, 3);
$wor_Name = getValue("wor_Name", "str", "POST", $wor_Name, 3);
$wor_StartTime = getValue("wor_StartTime", "str", "POST", $wor_StartTime, 3);
// $wor_StartTime = strtotime(str_replace('/', '-', $wor_StartTime));
// if (empty($wor_StartTime)) {
//     $wor_StartTime = time();
// }
$wor_FinishTime = getValue("wor_FinishTime", "str", "POST", $wor_FinishTime, 3);
// $wor_FinishTime = strtotime(str_replace('/', '-', $wor_FinishTime));
// if (empty($wor_FinishTime)) {
//     $wor_FinishTime = time();
// }
// $rol_id = getValue("rol_id", "int", "POST", $rol_id, 3);

// $db_select = new db_query("SELECT * FROM workshift WHERE ")


//Call Class generate_form();
$myform = new generate_form();
$myform->add("wor_Name", "wor_Name", 0, 1, "", 1, "Tên ca làm việc không được để trống.", 0, "");
$myform->add("wor_StartTime", "wor_StartTime", 0, 1, "", 1, "Bạn chưa chọn thời gian bắt đầu.", 0, "");
$myform->add("wor_FinishTime", "wor_FinishTime", 0, 1, "", 1, "Bạn chưa chọn thời gian kết thúc.", 0, "");
$myform->addTable($fs_table);

$action = getValue("action", "str", "POST", "");

//Check $action for insert new data
if ($action == "execute") {
    //Check form data
    $fs_errorMsg .= $myform->checkdata();

    if ($fs_errorMsg == "") {
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
} //End if($action == "insert")

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


        <?= $form->text("Tên ca làm việc", "wor_Name", "wor_Name", $wor_Name, "Tên ca làm việc", 1, 250, "", 255, "", "", "") ?>
        <?= $form->text("Thời gian bắt đầu", "wor_StartTime", "wor_StartTime", $wor_StartTime, "Thời gian bắt đầu", 1, 250, "", 50, "", "", "") ?>
        <!-- <tr>
            <td class="form_name">Thời gian bắt đầu:</td>
            <td class="form_text">
                <input type="time" class="form-control" name="wor_StartTime" id="wor_StartTime" value="<?php echo $wor_StartTime ?> ">
            </td>
        </tr> -->
        <?= $form->text("Thời gian kết thúc", "wor_FinishTime", "wor_FinishTime", $wor_FinishTime, "Thời gian kết thúc", 1, 250, "", 50, "", "", "") ?>
        <!-- <tr>
            <td class="form_name">Thời gian kết thúc:</td>
            <td class="form_text">
                <input type="text" class="form-control date" name="wor_FinishTime" id="wor_FinishTime"
                    onkeypress="displayDatePicker('wor_FinishTime', this);"
                    onclick="displayDatePicker('wor_FinishTime', this);"
                    onfocus="if(this.value=='Enter Ngày tạo') this.value=''"
                    onblur="if(this.value=='') this.value='Enter Ngày tạo'"
                    value="<?= date('d/m/Y', $wor_FinishTime) ?>">
            </td>
        </tr> -->
        <!-- <?= $form->select_db("Quyền hạn", "rol_id", "rol_id", $rol_id, "Quyền hạn", 1, 250, "", 50, "", "", "") ?> -->
      
        <?= $form->radio("Sau khi lưu dữ liệu", "add_new" . $form->ec . "return_listing", "after_save_data", $add . $form->ec . $listing, $after_save_data, "Thêm mới" . $form->ec . "Quay về danh sách", 0, $form->ec, ""); ?>
        <?= $form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", '' . $form->ec . '', ""); ?>
        <?= $form->hidden("action", "action", "execute", ""); ?>

        <?php
        $form->close_table();
        $form->close_form();
        unset($form);
        ?>
        <script type="text/javascript">
            /**
             * ajax load danh sách Khoa
             */
            function loadFaculties() {
                var schoolID = $("#school_id").val();
                $("#listFaculties").html("<img src='/images/loading_process.gif' height='34px' />");

                setTimeout(function() {
                    $("#listFaculties").load("/ajax/load_faculties.php?schoolID=" + schoolID);
                }, 500);


            }

            /**
             * ajax load danh sách Lớp
             */
            function loadClasses() {
                var facultyID = $("#faculty_id").val();
                $("#listClasses").html("<img src='/images/loading_process.gif' height='34px' />");

                setTimeout(function() {
                    $("#listClasses").load("/ajax/load_classes.php?facultyID=" + facultyID);
                }, 500);


            }
        </script>
    </p>
    <? /*------------------------------------------------------------------------------------------------*/ ?>
    <?= template_bottom() ?>
    <? /*------------------------------------------------------------------------------------------------*/ ?>
</body>

</html>