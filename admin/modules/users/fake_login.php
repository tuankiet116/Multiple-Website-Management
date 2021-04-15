<?
include("inc_security.php");
require_once("../../../classes/user.php");
checkAddEdit("edit");

$record_id = getValue("record_id");
if ($record_id > 0) {
    //lay du lieu cua record can sua doi
    $db_data = new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
    if ($row = mysqli_fetch_assoc($db_data->result)) {

        $_COOKIE["login_name"] = $row["use_idnumber"];
        $_COOKIE["PHPSESS11D"] = $row["use_password"];

        $user = new user();
        if ($user->logged == 1) {
            $user->savecookie();
        } else {
            die("Login failed.");
        }

        $pageURL = '/account';
        echo '<meta http-equiv="refresh" content="0; URL=' . $pageURL . '" />';
    } else {
        exit("Cannot find data");
    }
    $db_data->close();
    unset($db_data);
}