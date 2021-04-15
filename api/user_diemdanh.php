<?
require_once("lang.php");

$record_id = getValue("userID", "int", "GET", 0);
$calender_id = 48;
$returnMsg = "";

// Nếu đã điểm danh rồi thì báo luôn
$uch_time = time();
$uch_year = date("Y", $uch_time);
$uch_month = date("m", $uch_time);
$uch_day = date("d", $uch_time);
$db_check = new db_query("SELECT uch_id
                          FROM user_calender_history
                          WHERE uch_user_id = " . $record_id . "
                                AND uch_calender_id = " . $calender_id . "
                                AND uch_year=" . $uch_year . "
                                AND uch_month=" . $uch_month . "
                                AND uch_day=" . $uch_day . "
                          LIMIT 1");
if($rowAttended = mysqli_fetch_assoc($db_check->result)){
    $returnMsg = "FOUND=2;null;Người dùng đã điểm danh trong ngày.";
    die($returnMsg);

}
$db_check->close();
unset($db_check);

$db_check = new db_query("SELECT * FROM users, user_calender WHERE use_id = ucl_user_id AND ucl_user_id = " . $record_id . " AND ucl_calender_id = " . $calender_id);
if ($rowCheck = mysqli_fetch_assoc($db_check->result)) {
    $uch_calender_id = $calender_id;
    $uch_user_id = $record_id;
    $uch_time = time();
    $uch_year = date("Y", $uch_time);
    $uch_month = date("m", $uch_time);
    $uch_day = date("d", $uch_time);

    $myform = new generate_form();
    $myform->add("uch_calender_id", "uch_calender_id", 1, 1, 0, 1, "calender_id is required", 0, "");
    $myform->add("uch_user_id", "uch_user_id", 1, 1, 0, 1, "user_id is required", 0, "");
    $myform->add("uch_year", "uch_year", 0, 1, 0, 0, "", 0, "");
    $myform->add("uch_month", "uch_month", 1, 1, "");
    $myform->add("uch_day", "uch_day", 1, 1, "");
    $myform->add("uch_time", "uch_time", 1, 1, "");
    $myform->addTable("user_calender_history");

    //Check form data
    $fs_errorMsg = $myform->checkdata();
    if ($fs_errorMsg == "") {
        //Insert to database
        $myform->removeHTML(1);
        $db_insert = new db_execute(str_replace("INSERT INTO", "REPLACE INTO", $myform->generate_insert_SQL()));
        unset($db_insert);

        // C001#S003#SUCCESSS#URL_PICTURE;MA_SV;NAME_SV
        $userPicture = "http://epu.nhanhoassh.com/images/photo.png";
        if($rowCheck["use_picture"] != "") $userPicture = "http://epu.nhanhoassh.com/data/users/thumb/" . $rowCheck["use_picture"];
        $arrReturn = array(
            $rowCheck["use_name"],
            $userPicture
//            $rowCheck["use_code"],
        );
        $returnMsg = "FOUND=1;" . implode(";", $arrReturn);

    }else{
        $returnMsg = "FOUND=0;null;Có lỗi xảy ra khi thực hiện.";
    }
}else{
    $returnMsg = "FOUND=0;null;Không có trong lịch điểm danh.";
}
$db_check->close();
unset($db_check);

die($returnMsg);
?>
