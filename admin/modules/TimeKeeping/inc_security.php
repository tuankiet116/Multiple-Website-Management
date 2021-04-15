<?php
    
    require_once("../../resource/security/security.php");
    $module_id = 12;
    //Check user login...
    checkLogged();
    //Check access module...
    //if (checkAccessModule($module_id) != 1) {redirect($fs_denypath);}
    $list_memCheckin = new db_query("SELECT * FROM member_checkin");
?>