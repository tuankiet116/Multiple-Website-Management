<?php
require_once("config.php");
if ($myuser->u_id <= 0) {
    redirect(LOGIN_URL);
}else{
    redirect(ACC_URL);
}
?>