<?php
// Require class
require_once("../classes/database.php");

require_once("../classes/user.php");
require_once("../classes/menu.php");
require_once("../classes/denyconnect.php");
require_once("../classes/generate_form.php");
require_once("../classes/memcached_store.php");

// Require function
require_once("../functions/functions.php");
require_once("../functions/function_website.php");
require_once("../functions/translate.php");
require_once("../functions/date_functions.php");
require_once("../functions/pagebreak.php");
require_once("../functions/rewrite_functions.php");

$lang_id 			= getValue("lang", "int", "COOKIE", 0);

// Config variable
require_once("../config/inc_config.php");

$myuser         = new user();

$gender_list = array(
    1=> 'Nam',
    2=> 'Nữ'
);
?>
