<?
require_once("lang.php");

$record_id  = getValue("GroupID", "int", "GET", 0);
$calender_id = 25;
$array_return = array("code" => 0, "msg" => "");

dump_log("SELECT * FROM user_calender WHERE ucl_user_id = " . $record_id . " AND ucl_calender_id = " . $calender_id);
$db_check = new db_query("SELECT * FROM user_calender WHERE ucl_user_id = " . $record_id . " AND ucl_calender_id = " . $calender_id);
if($rowCheck = mysqli_fetch_assoc($db_check->result)){
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
    dump_log($fs_errorMsg);
    if ($fs_errorMsg == "") {
        //Insert to database
        $myform->removeHTML(1);
        dump_log(str_replace("INSERT INTO", "REPLACE INTO", $myform->generate_insert_SQL()));
        $db_insert = new db_execute(str_replace("INSERT INTO", "REPLACE INTO", $myform->generate_insert_SQL()));
        unset($db_insert);

        $array_return = array("code" => 1, "msg" => "success");
    }else{

        $array_return["msg"] = $fs_errorMsg;

    }
}
$db_check->close();
unset($db_check);

die(json_encode($array_return));
?>
