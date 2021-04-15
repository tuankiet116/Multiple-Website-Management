<?
function checkLogin($username, $password){
	$username	= replaceMQ($username);
	$password	= replaceMQ($password);
	$adm_id		= 0;
	$db_check	= new db_query("SELECT adm_id
										 FROM admin_user
										 WHERE adm_loginname = '" . $username . "' AND adm_password = '" . md5($password) . "' AND adm_active = 1 AND adm_delete = 0");
	if(mysqli_num_rows($db_check->result) > 0){
		$check	= mysqli_fetch_assoc($db_check->result);
		$adm_id	= $check["adm_id"];
		$db_check->close();
		unset($db_check);
		return $adm_id;
	}
	else{
		$db_check->close();
		unset($db_check);
		return 0;
	}
}
function checklogged(){
	$denypath="../../login.php";
	if (!isset($_SESSION["logged"])){
		redirect($denypath);
		exit();
	}
	else{
		if ($_SESSION["logged"] != 1){
			redirect($denypath);
			exit();
		}
	}
}
function get_curent_language(){
	$db_current_language = new db_query("SELECT lang_id
										 FROM admin_user
										 WHERE adm_loginname='" . $_SESSION["userlogin"] . "' AND adm_password='" . $_SESSION["password"] . "' AND adm_active=1 AND adm_delete = 0");
	if ($row=mysqli_fetch_assoc($db_current_language->result)){
		$db_current_language->close();
		unset($db_current_language);
		return $row["lang_id"];
	}
	else{
		return "";
	}
}
function get_curent_path(){
	$db_current_path = new db_query("SELECT lang_path
										 FROM languages
										 WHERE lang_id=" . intval(get_curent_language()) . "");
	if ($row=mysqli_fetch_assoc($db_current_path->result)){
		$db_current_path->close();
		unset($db_current_path);
		return $row["lang_path"];
	}
	else{
		return "";
	}
}
function checkAccessModule($module_id){

	$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
	$password	= getValue("password", "str", "SESSION", "", 1);
	$lang_id		= getValue("lang_id", "int", "SESSION", 1);
	$db_getright = new db_query("SELECT *
								 FROM admin_user
								 WHERE adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0");
	//Check xem user co ton tai hay khong
	if ($row = mysqli_fetch_assoc($db_getright->result)){
		//Neu column adm_isadmin = 1 thi cho access
		if ($row['adm_isadmin'] == 1 || $row['adm_all_category'] == 1) {
			$db_getright->close();
			unset($db_getright);
			return 1;
		}
	}
	//Ko co thi` fail luon
	else{
		$db_getright->close();
		unset($db_getright);
		return 0;
	}
	$db_getright->close();
	unset($db_getright);

	//check user
	$db_getright = new db_query("SELECT *
								 FROM admin_user, admin_user_right, modules
								 WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND
								 adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0
								 AND mod_id = " . $module_id);

	if ($row=mysqli_fetch_assoc($db_getright->result)){
		$db_getright->close();
		unset($db_getright);
		return 1;
	}
	else{
		$db_getright->close();
		unset($db_getright);
		return 0;
	}
}
function checkAddEdit($right="add"){

	$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
	$password	= getValue("password", "str", "SESSION", "", 1);
	$lang_id		= getValue("lang_id", "int", "SESSION", 1);
	global $module_id;
	$db_getright = new db_query("SELECT *
								 FROM admin_user, admin_user_right, modules
								 WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_isadmin = 0 AND
								 adm_loginname='" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active=1 AND adm_delete = 0
								 AND mod_id = " . $module_id);

	if ($row=mysqli_fetch_assoc($db_getright->result)){
		$denypath="../../error.php";
		switch($right){
			case "add":
				if($row["adu_add"] == 0){
					header("location: " . $denypath);
					exit();
				}
			break;
			case "edit":
				if($row["adu_edit"] == 0){

					header("location: " . $denypath);
					exit();
				}
			break;
			case "delete":
				if($row["adu_delete"] == 0){
					echo json_encode(array("msg"=>"Bạn không có quyền thực thi!","status"=>"0"));
					exit();
				}
			break;
		}
		$db_getright->close();
		unset($db_getright);
	}
	return 1;
}
function checkRowUser($table,$field_id,$record_id,$returnurl){
	$strreturn ='';
	$db_useradmin = new db_query("SELECT adm_id,adm_isadmin,adm_edit_all FROM admin_user WHERE adm_id=" . $_SESSION["user_id"]);
	if($adm = mysqli_fetch_assoc($db_useradmin->result)){
		if($adm["adm_isadmin"]==1){
			$strreturn ='';
		}else{
			$db_record = new db_query("SELECT admin_id FROM " . $table . " WHERE " . $field_id . " = " . $record_id);
			$row=mysqli_fetch_assoc($db_record->result);
			if($row["admin_id"] == $_SESSION["user_id"] || $row["admin_id"] == 0 || $adm["adm_edit_all"]==1){
				$strreturn = '';
				unset($db_record);
			}else{
				$db_user = new db_query("SELECT adm_loginname FROM admin_user WHERE adm_id= " . intval($row["admin_id"]));
				if($use=mysqli_fetch_assoc($db_user->result)){
					$strreturn = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script language="javascript">alert("Bản ghi này thuộc quyền sửa xóa của user: ' . $use["adm_loginname"] . '")</script>';
				}else{
					$strreturn = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script language="javascript">alert("Bản ghi không thuộc quyền sửa xóa của bạn !")</script>';
				}
				unset($db_user);
			}
		}
	}else{
		$denypath="../../login.php";
		redirect($denypath);
	}
	if($strreturn!=''){
		echo $strreturn;
		redirect($returnurl);
		exit();
	}else{
		echo $strreturn;
	}
}
function checkAccessCategory(){

	$userlogin	= getValue("userlogin", "str", "SESSION", "", 1);
	$password	= getValue("password", "str", "SESSION", "", 1);
	$lang_id		= getValue("lang_id", "int", "SESSION", 1);

	// Danh sách category đc phép truy cập
	$list_id		= "";
	$db_category= new db_query("SELECT adm_id, adm_isadmin, adm_access_category
										 FROM admin_user
										 WHERE adm_loginname = '" . $userlogin . "' AND adm_password='" . $password . "' AND adm_active = 1");

	//Check xem user co ton tai hay khong
	if($row = mysqli_fetch_assoc($db_category->result)){

		//Neu column adm_isadmin = 1 thi get all category
		if($row["adm_isadmin"] == 1) {
			$db_getall = new db_query("SELECT cat_id FROM categories_multi");
			while($getall = mysqli_fetch_assoc($db_getall->result)){
				$list_id .= $getall["cat_id"] . ",";
			}
			unset($db_getall);
		}
		else{
			preg_match_all('/\[(.*?)\]/is', $row["adm_access_category"], $matches);
			for($i=0; $i<count($matches[1]); $i++){
				$list_id	.= intval($matches[1][$i]) . ",";
			}
		}

	}

	$db_category->close();
	unset($db_category);

	$list_id .= 0;

	return $list_id;

}
?>
<?
function checkDeleteCategory($record_id){
	$return = 1;
	$array_module	= array ("download"	=> array("downloads_multi", "dow_category_id"),
									"gallery"	=> array("galleries_multi", "gal_category_id"),
									"news"		=> array("news_multi", "new_category_id"),
									"product"	=> array("products_multi", "pro_category_id"),
									"static"		=> array("statics_multi", "sta_category_id"),
									);
	$db_module = new db_query("SELECT cat_type FROM categories_multi WHERE cat_id = " . $record_id);
	if($module = mysqli_fetch_assoc($db_module->result)){
		if(isset($array_module[$module["cat_type"]])){
			$arrTemp	= $array_module[$module["cat_type"]];
			$db_check= new db_query("SELECT COUNT(*) AS count FROM " . $arrTemp[0] . " WHERE " . $arrTemp[1] . " = " . $record_id);
			$check	= mysqli_fetch_assoc($db_check->result);
			if($check["count"] > 0) $return = 0;
			unset($db_check);
		}
	}
	unset($db_module);
	return $return;
}
?>