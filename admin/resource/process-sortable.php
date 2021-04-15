<?
require_once("../session.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
$user_id 	= getValue("user_id","int","SESSION");

if(isset($_POST["listItem"])){
	if(is_array($_POST["listItem"])){
		foreach($_POST["listItem"] as $key=>$value){
			$db_del = new db_execute("REPLACE INTO admin_menu_order(amo_order,amo_module,amo_admin) VALUES(" . intval($key) . "," .intval($value) . "," . $user_id . ")");
			unset($db_del);
		}
	}
}
?>