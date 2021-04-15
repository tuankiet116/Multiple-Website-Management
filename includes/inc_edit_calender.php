<?
$errors = "";
$weekdays = array(
    array("label" => "Thứ 2", "value" => 2),
    array("label" => "Thứ 3", "value" => 3),
    array("label" => "Thứ 4", "value" => 4),
    array("label" => "Thứ 5", "value" => 5),
    array("label" => "Thứ 6", "value" => 6),
    array("label" => "Thứ 7", "value" => 7),
    array("label" => "Chủ nhật", "value" => 8),
);
$record_id = getValue("record_id");
$db_check = new db_query("SELECT * FROM calender WHERE cal_id=" . $record_id . " AND cal_user_id=" . $myuser->u_id . " LIMIT 1");
if(mysqli_num_rows($db_check->result) > 0){
    $rowCal = mysqli_fetch_assoc($db_check->result);
}else{
    redirect("/listcalender");
    exit();
}
unset($db_check);

$arrUser = array();
$db_user = new db_query("SELECT ucl_user_id FROM user_calender WHERE ucl_calender_id = " . $record_id);
while($rowUse = mysqli_fetch_assoc($db_user->result)){
    $arrUser[] = $rowUse["ucl_user_id"];
}
unset($db_user);

$action = getValue("action", "str", "POST", "");
$name = getValue("name", "str", "POST", $rowCal["cal_name"]);
$code = getValue("code", "str", "POST", $rowCal["cal_code"]);
$arr_weekday = getValue("weekday", "arr", "POST", explode(",", $rowCal["cal_weekday"]));
$weekday = convert_array_to_list($arr_weekday);
$arr_object = getValue("object", "arr", "POST", $arrUser);
$object     = convert_array_to_list($arr_object);
$checkinTime = getValue("checkinTime", "str", "POST", $rowCal["cal_checkin_time"]);

$payload = array(
    "name" => $name,
    "code" => $code,
    "weekday" => $weekday,
    "object" => $arr_object,
    "checkinTime" => $checkinTime,
    "time" => time()
);
$payload["code_md5"] = md5($payload["code"]);

if ($action === 'update') {
    $arr_weekday = getValue("weekday", "arr", "POST", array());
    $weekday = implode(',', $arr_weekday);

    $cal_code = trim($payload["code"]);
    $cal_code_md5 = md5($cal_code);
    $cal_name = trim($payload["name"]);
    $cal_weekday = trim($weekday);
    $cal_checkin_time = intval(date("H", strtotime($checkinTime)));

    $myform = new generate_form();
    if($cal_code != $rowCal["cal_code"]){
        $myform->add("cal_code", "cal_code", 0, 1, " ", 1, "Vui lòng nhập Mã Lịch.", 0, "");
        $myform->add("cal_code_md5", "cal_code_md5", 0, 1, " ", 1, "Vui lòng nhập Mã Lịch.", 1, "Mã Lịch đã tồn tại trong hệ thống. Vui lòng thử bằng Mã khác.");
    }
    $myform->add("cal_name", "cal_name", 0, 1, 0, 1, "Vui lòng nhập Tên Lịch.", 0, "");
    $myform->add("cal_weekday", "cal_weekday", 0, 1, " ", 1, "Vui lòng chọn Thời gian hoạt động.", 0, "");
    $myform->add("cal_checkin_time", "cal_checkin_time", 1, 1, 1, 1, "Vui lòng chọn Thời gian điểm danh.", 0, "");
    $myform->addTable("calender");

    //Check form data
    $errors = $myform->checkdata();

    if ($errors == "") {
        //Insert to database
        $myform->removeHTML(1);
        $db_update = new db_execute($myform->generate_update_SQL("cal_id", $record_id));
        unset($db_update);

        // Cập nhật lại danh sách người dùng
        if (is_array($payload["object"]) && count($payload["object"]) > 0) {
            $db_execute = new db_execute("DELETE FROM user_calender WHERE ucl_calender_id=" . $record_id);
            unset($db_execute);

            foreach ($payload["object"] as $value) {
                $db_execute = new db_execute("INSERT INTO user_calender (ucl_calender_id, ucl_user_id, ucl_date,ucl_active) VALUES ({$record_id}, {$value}, {$payload["time"]}, 1)");
                unset($db_execute);
            }
        }

        redirect('/listcalender');

    }

}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa Lịch Daily</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ACC_URL ?>">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý Lịch Daily</li>
                        <li class="breadcrumb-item active">Chỉnh sửa Lịch Daily</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="add-calendar-form" method="POST" class="form-horizontal needs-validation" novalidate
                  onsubmit="addCalendar(); return false">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin Lịch Daily</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="calendarCode">Mã Lịch (<span class="text-danger">*</span>):</label>
                                    <input autocomplete="off" type="text" class="form-control"
                                           value="<?=$code?>" name="code"
                                           placeholder="Nhập Mã Lịch" required/>

                                    <div class="invalid-feedback">Vui lòng nhập Mã Lịch.</div>
                                </div>
                                <div class="form-group">
                                    <label for="calendarName">Tên Lịch (<span class="text-danger">*</span>):</label>
                                    <input autocomplete="off" type="text" class="form-control"
                                           value="<?=$name?>" name="name"
                                           placeholder="Nhập Tên Lịch" required/>

                                    <div class="invalid-feedback">Vui lòng nhập Tên Lịch.</div>
                                </div>
                                <div class="form-group">
                                    <label for="calendarName">Thời gian hoạt động:</label>
                                    <select name="weekday[]" id="weekdays" class="form-control" style="width: 100%;" multiple="multiple">
                                        <?php
                                        foreach ($weekdays as $item){
                                            $selected = in_array($item["value"], $arr_weekday) ? " selected" : "";
                                        ?>
                                            <option value="<?= $item["value"] ?>"<?=$selected?>><?= $item["label"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian điểm danh:</label>
                                    <input id="checkinTime" name="checkinTime" type="text" class="form-control" value="<?=$checkinTime?>" required>
                                    <div class="invalid-feedback">Vui lòng Chọn giờ điểm danh.</div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="action" value="update"/>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">
                        <!-- general form elements disabled -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thêm Người dùng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                            Nhập tên người dùng để tìm kiếm</label>
                                        <select id="object" class="form-control" style="width: 100%;"></select>
                                    </div>
                                </form>
                                <div id="show-object">
                                    <?
                                    if(count($arr_object) > 0){
                                        $result = new db_query("SELECT use_name,use_id,use_code FROM users WHERE use_id IN(" . $object . ")");
                                        while($row = mysqli_fetch_assoc($result->result)){
                                            echo '<div class="item"> <i class="fa fa-trash" style="color: red;margin-right: 10px;font-size: 12px;"></i><i>' . $row["use_name"] . '</i><input type="hidden" name="object[]" value="' . $row["use_id"] . '" /></div>';
                                        }
                                        unset($result);
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
            </form>
        </div>
    </section>
</div>

