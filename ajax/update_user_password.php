<?
require_once("lang.php");

$array_return 	= array("code" => 0, "msg" => "Có lỗi xảy ra khi thực hiện. Vui lòng thử lại sau !");

$inputOldPassword = getValue("inputOldPassword", "str", "POST", "");
$inputNewPassword = getValue("inputNewPassword", "str", "POST", "");

if($inputNewPassword != "" AND $inputNewPassword != ""){
    //Check old password
    $db_check = new db_query("SELECT use_id, use_password, use_salt FROM users WHERE use_id = " . $myuser->u_id . " LIMIT 1");
    if($row = mysqli_fetch_assoc($db_check->result)){
        if($row["use_password"] == md5($inputOldPassword . $row["use_salt"])){
            $db_update = new db_execute("UPDATE users SET use_password = '" . md5($inputNewPassword . $row["use_salt"]) . "' WHERE use_id=" . $myuser->u_id);
            unset($db_update);

            $array_return 	= array("code" => 1, "msg" => "");
        }else{
            $array_return["msg"] = "Mật khẩu cũ bạn nhập không chính xác.";
        }
    }
    $db_check->close();
    unset($db_check);
}

die(json_encode($array_return));
?>