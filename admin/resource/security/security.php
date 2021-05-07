<?
require_once("../../session.php");

require_once("../../../classes/database.php");
require_once("../../../classes/form.php");
// require_once("../../../classes/mailer/class.phpmailer.php");
require_once("../../../functions/functions.php");
require_once("../../../functions/function_website.php");
require_once("../../../functions/rewrite_functions.php");
require_once("../../../functions/file_functions.php");
require_once("../../../functions/sql_function.php");
require_once("../../../functions/date_functions.php");
require_once("../../../functions/resize_image.php");
require_once("../../../functions/translate.php");
require_once("../../../functions/pagebreak.php");
require_once("../../../classes/generate_form.php");
require_once("../../../classes/form.php");
require_once("../../../classes/upload.php");
require_once("../../../classes/menu.php");
require_once("../../../classes/grid.php");
require_once("../../../classes/memcached_store.php");

$admin_id = getValue("user_id", "int", "SESSION");
$lang_id = getValue("lang_id", "int", "SESSION");

require_once("../../../config/const.php");

// Chuyen sang dung ckeditor
$wys_path = "../../resource/ckeditor/";
require_once($wys_path . "ckeditor.php");

require_once("functions.php");
require_once("template.php");


//phan khai bao bien dung trong admin
$fs_stype_css = "../css/css.css";
$fs_template_css = "../css/template.css";
$fs_border = "#f9f9f9";
$fs_bgtitle = "#DBE3F8";
$fs_imagepath = "../../resource/images/grid/";
$fs_scriptpath = "../../resource/js/";
$fs_denypath = "../../error.php";
$wys_cssadd = array();
$wys_cssadd = "/css/all.css";
//$fs_category = checkAccessCategory();
//phan include file css

//$load_header 			= '<link href="../../resource/css/css.css" rel="stylesheet" type="text/css">' . "\n";
//$load_header 			= '<link rel="stylesheet" type="text/css" href="../../resource/css/layout.css" />' . "\n";
$load_header = '<link href="../../resource/css/calendar.css" rel="stylesheet" type="text/css">' . "\n";
$load_header .= '<link href="../../resource/js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css">' . "\n";
$load_header .= '<link href="../../resource/ckeditor/contents.css" rel="stylesheet" type="text/css">' . "\n";
$load_header .= '<link href="../../resource/css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">' . "\n";
$load_header .= '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">' . "\n";
$load_header .= '<link href="../../resource/css/style.css" rel="stylesheet" type="text/css">' . "\n";

//phan include file script
$load_header .= '<script language="javascript" src="../../resource/js/jquery-1.3.2.min.js"></script>' . "\n";
$load_header .= '<script language="javascript" src="../../resource/js/library.js"></script>' . "\n";
$load_header .= '<script language="javascript" src="../../resource/js/calendar.js"></script>' . "\n";
//$load_header 			.= '<script language="javascript" src="../../resource/js/tooltip.jquery.js"></script>' . "\n";
$load_header .= '<script language="javascript" src="../../resource/js/jquery.jeditable.js"></script>' . "\n";
$load_header .= '<script language="javascript" src="../../resource/js/swfObject.js"></script>' . "\n";
$load_header .= '<script language="javascript" src="../../resource/js/jwysiwyg/jquery.wysiwyg.js"></script>' . "\n";
$load_header .= '<script language="javascript" src="../../resource/ckeditor/ckeditor.js"></script>' . "\n";
$load_header .= '<script language="javascript" src="../../resource/css/bootstrap/js/bootstrap.min.js"></script>' . "\n";

$load_header .= '<link href="../../resource/js/windowPrompt/windowPrompt.css" rel="stylesheet" type="text/css">' . "\n";
$load_header .= '<script language="javascript" src="../../resource/js/windowPrompt/windowPrompt.js"></script>' . "\n";


$fs_change_bg = 'onMouseOver="this.style.background=\'#f7f7f9\'" onMouseOut="this.style.background=\'#FFFFFF\'"';

// Get config from database -----> Not necessary in this project! Maybe this code get data config from configuration data table will be necessary on another project!
//$db_con = new db_query("SELECT * from configuration");
//if ($row = mysqli_fetch_assoc($db_con->result)) {
//    foreach ($row as $data_field => $data_value) {
//        if (!is_int($data_field)) {
//            //tao ra cac bien config
//            $$data_field = $data_value;
//        }
//    }
//}
//$db_con->close();
//unset($db_con);

$lang_id = getValue("lang_id", "int", "SESSION", 1);
$userlogin = getValue("userlogin", "str", "SESSION", "", 1);
$password = getValue("password", "str", "SESSION", "", 1);

$admin_id = 0; // Lưu lại ID của user admin hiện tại
$is_admin = 0; // Là Supper Admin hay không (=1 là super admin)
$adminFullName = "";
// Check tài khoản Admin có hợp lệ ko
$db_admin_user = new db_query("SELECT *
                                FROM admin_user
                                WHERE adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0");
if ($row = mysqli_fetch_assoc($db_admin_user->result)) {
    $admin_id = $row["adm_id"];
    $is_admin = $row["adm_isadmin"];
    $adminFullName = $row['adm_name'];
}
unset($db_admin_user);

if ($admin_id <= 0) { // Không hợp lệ thì ra trang thông báo lỗi
    redirect($fs_denypath);
}
?>
