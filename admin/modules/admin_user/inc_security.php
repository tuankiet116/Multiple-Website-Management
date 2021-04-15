<?
$module_id	= 14;
require_once("../../resource/security/security.php");
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table 			= "admin_user";
$user_id 			= getValue("user_id","int","SESSION");
?>