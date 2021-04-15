<?php
require_once("../../resource/security/security.php");

$module_id = 5;
//Check user login...
checkLogged();
//Check access module...
if (checkAccessModule($module_id) != 1) redirect($fs_denypath);
?>
