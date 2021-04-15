<?
require_once("lang.php");

$array_return 	= array("code" => 0, "msg" => "Có lỗi xảy ra khi thực hiện. Vui lòng thử lại sau !");
$user_dir   = str_pad($myuser->u_id, 2, '0', STR_PAD_LEFT);
$upload_path        = "../data/users/" . $user_dir . "/";

$name = getValue("name", "str", "POST", "");
$file = getValue("file", "str", "POST", "");
if($name != "" && $file != "") {
	// Decode base64 data
	list($type, $data) = explode(';', $file);
	list(, $data) = explode(',', $data);
	$file_data = base64_decode($data);
	
	// Get file mime type
	$finfo          = finfo_open();
	$file_mime_type = finfo_buffer($finfo, $file_data, FILEINFO_MIME_TYPE);
	
	// File extension from mime type
	if ($file_mime_type == 'image/jpeg' || $file_mime_type == 'image/jpg')
		$file_type = 'jpeg';
	else if ($file_mime_type == 'image/png')
		$file_type = 'png';
	else if ($file_mime_type == 'image/gif')
		$file_type = 'gif';
	else
		$file_type = 'other';

	// Validate type of file
	if (in_array($file_type, array('jpeg', 'png', 'gif'))) {
		// Set a unique name to the file and save
		$f_name = "";
		for($i=0; $i<3; $i++){
			$f_name .= chr(rand(97,122));
		}
		$f_name.= time();
		$file_name = $f_name . '.' . $file_type;
		
		file_put_contents($upload_path . $file_name, $file_data);
		
		// Update value
        $up_user_id = $myuser->u_id;
        $up_question_id = intval( str_replace("img_", "", $name) );
        $up_picture = $file_name;
        $up_created_time    = time();
        $up_updated_time    = time();

        $myform = new generate_form();
        $myform->add("up_user_id", "up_user_id", 1, 1, 0, 1, "user_id is required", 0, "");
        $myform->add("up_question_id", "up_question_id", 1, 1, 0, 1, "question_id is required", 0, "");
        $myform->add("up_picture", "up_picture", 0, 1, 0, 0, "", 0, "");
        $myform->add("up_created_time", "up_created_time", 1, 1, "");
        $myform->add("up_updated_time", "up_updated_time", 1, 1, "");
        $myform->addTable("users_photos");

        //Check form data
        $fs_errorMsg = $myform->checkdata();

        if ($fs_errorMsg == "") {
            //Insert to database
            $myform->removeHTML(1);
            $db_insert = new db_execute(str_replace("INSERT INTO", "REPLACE INTO", $myform->generate_insert_SQL()));
            unset($db_insert);

            $array_return = array("code" => 1, "msg" => "success");
        }else{

            $array_return["msg"] = $fs_errorMsg;

        }


	} else {
		$array_return["msg"] = 'Lỗi : Bạn chỉ được upload ảnh định dạng JPEG, PNG và GIF.';
	}
}

die(json_encode($array_return));
?>
