<?
include("const.php");

// Check agent nếu là bot thì exit luôn
if (strpos(@$_SERVER['HTTP_USER_AGENT'],"Microsoft URL Control")!==false) exit();

// Biến cấu hình version file static
$con_file_version	= "?v=" . time();


// require class database trước
if (file_exists("../classes/database.php")) require_once("../classes/database.php");

// Nếu không định nghĩa DO_NOT_LOAD_CONFIGURATION thì mới query config tránh thừa
if (!defined("DO_NOT_LOAD_CONFIGURATION")){

	$arrayConfigTranslate = array('con_site_title', 'con_meta_description', 'con_meta_keywords');
	// Lấy các biến cấu hình trong db
	$db_query = new db_query("SELECT *
									FROM configuration",
									__FILE__);
	if($row = mysqli_fetch_assoc($db_query->result)){
		foreach($row as $data_field => $data_value) {
			if (!is_int($data_field)){
				//tao ra cac bien config
				if(in_array($data_field, $arrayConfigTranslate) && $data_value != ''){
					$$data_field = translate($data_value);
				}else{
					$$data_field = $data_value;
				}
			}
		}
	}
	$db_query->close();
	unset($db_query);

} // End if (!defined("DO_NOT_LOAD_CONFIGURATION"))

// Nếu không đĩnh nghĩa DO_NOT_INIT_SESSION thì mới khởi tạo session
if (!defined("DO_NOT_INIT_SESSION")) require_once("inc_initsession.php");
?>
