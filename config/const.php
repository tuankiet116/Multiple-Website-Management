<?
$includes_dir = dirname(__FILE__);
$classes_dir  = str_replace("config", "classes", $includes_dir);
$root_dir     = str_replace("config", "", $includes_dir);

define("ROOT_DIR", $root_dir);
define("ROOT_PATH", "/");
define("PICTURE_PATH", "/data/");
define("LOGIN_URL", "/login");
define("LOGOUT_URL", "/logout");
define("ACC_URL", "/account");
define("CALENDER", "/diemdanh");
define('USING_MEMCACHE', true); // Phút
define('MEMCACHE_EXPIRED', 60); // Phút
?>
