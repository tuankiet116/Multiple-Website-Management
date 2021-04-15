<?
/**
 * Class upload_image
 */
class upload_image{

	/*
	Upload Function
	$upload_name		: Ten textbox upload vi du : new_picture
	$upload_path		: duong dan save file upload vi du : "../news_data/"
	$extension_list	: danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	$limt_size			: dung luong gioi han (tinh bang Kbyte) vi du : 200 (KB)
	$insert_logo		: có chèn thêm logo vào hay không
	*/
	var $common_error		= "";
	var $warning_error	= "";
	var $file_name			= "";
	var $foreground		= "../images/fs_logo.png";
	var $quantity			= 75;
	var $image_extension	= array("gif", "jpg", "jpe", "jpeg", "png");

	function upload($upload_name, $upload_path, $extension_list, $limit_size, $insert_logo=0, $name_prefix = ""){
		//Validate upload file
		if(@!is_uploaded_file($_FILES[$upload_name]['tmp_name'])){
			$this->common_error		= "&bull; Không tìm thấy file tmp_name, file upload tạm (Có thể do file upload lớn hơn 2MB hoặc sai tên control upload file khi submit).<br />";
			return;
		}
		//Check file_size
		if(filesize($_FILES[$upload_name]['tmp_name']) > $limit_size * 1024){
			$this->common_error		= "&bull; Yêu cầu dung lượng ảnh tải lên nhỏ hơn " . $limit_size . " KB.<br />";
			$this->warning_error		= $this->common_error;
			return;
		}
		//Check upload extension
		if($this->checkExtension($_FILES[$upload_name]['name'], $extension_list) != 1){
			$this->common_error		= "&bull; Phần mở rộng của file không đúng.<br />&bull; Bạn chỉ upload được những file có phần mở rộng là: " . strtoupper($extension_list) . "<br />";
			$this->warning_error		= $this->common_error;
			return;
		}
		//Generate new filename
		$new_filename					= $this->generate_name($_FILES[$upload_name]['name'], $name_prefix);
		$this->file_name				= $new_filename;
		//move upload file
		@move_uploaded_file($_FILES[$upload_name]['tmp_name'], $upload_path . $new_filename);
		//Check upload file path
		if($this->check_path($upload_path, $new_filename) != 1){
			$this->common_error		= "&bull; Sai đường dẫn khi upload file.<br />";
			$this->warning_error		= $this->common_error;
			return;
		}
		// Nếu file upload là ảnh thì kiểm tra xem có phải ảnh xịn không
		if(array_search($this->getExtension($new_filename), $this->image_extension)){
			if(!$this->create_image($upload_path, $new_filename)){
				$this->common_error	= "&bull; Ảnh upload có phần mở rộng không phù hợp (Ví dụ: Ảnh GIF nhưng có phần mở rộng JPG).<br />";
				$this->warning_error	= $this->common_error;
				return;
			}
			// Chèn ảnh overlap
			if($insert_logo == 1) $this->image_overlap($upload_path, $new_filename);
		}
	}

	/*
	Show error for coder
	*/
	function show_common_error(){
		return $this->common_error;
	}

	/*
	Show error for customer
	*/
	function show_warning_error(){
		return $this->warning_error;
	}

	/*
	Get extension of file
	*/
	function getExtension($filename){
		$sExtension = substr($filename, (strrpos($filename, ".") + 1));
		$sExtension = strtolower($sExtension);
		return $sExtension;
	}

	/*
	Check extension file
	*/
	function checkExtension($filename, $allowList){
		$sExtension = $this->getExtension($filename);
		$allowArray	= explode(",", $allowList);
		$allowPass	= 0;
		for($i=0; $i<count($allowArray); $i++){
			if($sExtension == $allowArray[$i]) $allowPass = 1;
		}
		return $allowPass;
	}

	/*
	Check upload file path
	*/
	function check_path($path, $filename){
		if(@filesize($path . $filename) == 0){
			@unlink($path . $filename);
			return 0;
		}
		else return 1;
	}

	/*
	Generate file name
	*/
	function generate_name($filename, $prefix = ""){
		$name = $prefix;
		for($i=0; $i<3; $i++){
			$name .= chr(rand(97,122));
		}
		$name.= time();
		$ext	= substr($filename, (strrpos($filename, ".") + 1));
		return $name . "." . $ext;
	}

	function generate_path($upload_path){
		$path_return 		= $upload_path . date("Y/m/", time());
		if(!file_exists($path_return)){
			$oldUmask	= umask(0);
			@mkdir($path_return, 0777, true);
			umask($oldUmask);
		}

		return $path_return;
	}
	/*
	Check image file type
	*/
	function create_image($path, $filename){
		$sExtension = $this->getExtension($filename);
		//Check image file type extensiton
		$image = false;
		switch($sExtension){
			case "gif":
				$image = @imagecreatefromgif($path . $filename);
				break;
			case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
				$image = @imagecreatefromjpeg($path . $filename);
				break;
			case "png":
				$image = @imagecreatefrompng($path . $filename);
				break;
		}
		if(!$image){
			$this->delete_file($path, $filename);
		}
		return $image;
	}

	/*
	Function output_image
	*/
	function output_image($image_source, $path, $filename){
		$sExtension = $this->getExtension($filename);
		switch($sExtension){
			case "gif":
				imagegif($image_source, $path . $filename);
				break;
			case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
				imagejpeg($image_source, $path . $filename, $this->quantity);
				break;
			case "png":
				imagepng($image_source, $path . $filename);
				break;
		}
	}

	/*
	Resize image
	*/
	function resize_image($path, $filename, $maxwidth, $maxheight, $type = "small_",$new_path = "", $quality = 80){
		$sExtension = $this->getExtension($filename);
		//Load library extensiton in php.ini
		if(!extension_loaded("gd")){
			if(strtoupper(substr(PHP_OS, 0, 3) == "WIN")) dl("php_gd2.dll");
			else dl("gd2.so");
		}
		//Get new dimensions
		list($width, $height) = getimagesize($path . $filename);
		if($width != 0 && $height !=0){
			if($maxwidth / $width > $maxheight / $height) $percent = $maxheight / $height;
			else $percent = $maxwidth / $width;
		}
		$new_width	= $width * $percent;
		$new_height	= $height * $percent;
		//Resample
		$image_p = imagecreatetruecolor($new_width, $new_height);
		//Check extension file for create new image

		switch($sExtension){
			case "gif":
				$image = imagecreatefromgif($path . $filename);
				break;
			case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
				$image = imagecreatefromjpeg($path . $filename);
				break;
			case "png":
				$image = imagecreatefrompng($path . $filename);
				break;
		}
		//Copy and resize part of an image with resampling
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		// Output
		// check new_path, nếu new_path tồn tại sẽ save ra đó, thay path = new_path
		if ($new_path != "") $path = $new_path;

		switch($sExtension){
			case "gif":
				imagegif($image_p, $path . $type . $filename);
				break;
			case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
				imagejpeg($image_p, $path . $type . $filename, $quality);
				break;
			case "png":
				imagepng($image_p, $path . $type . $filename);
				break;
		}
		imagedestroy($image_p);
	}

	/*
	Function tạo ảnh logo cty trên ảnh sản phẩm
	*/
	function image_overlap($path, $filename){

		// Nếu tồn tại foreground thì mới overlap
		if(file_exists($this->foreground)){

			$background		= $this->create_image($path, $filename);
			if(!$background) return;

			// Chèn ảnh overlap vào
			$foreground		= imagecreatefrompng($this->foreground);
			$insertWidth	= imagesx($foreground);
			$insertHeight	= imagesy($foreground);
			$imageWidth		= imagesx($background);
			$imageHeight	= imagesy($background);
			$overlapX		= 5;
			$overlapY		= $imageHeight - $insertHeight - 5;

			imagecolortransparent($foreground, imagecolorat($foreground, 0, 0));
			imagecopy($background, $foreground, $overlapX, $overlapY, 0, 0, $insertWidth, $insertHeight);

			$this->output_image($background, $path, $filename);

			// Hủy biến để giải phóng bộ nhớ
			unset($background);
			unset($foreground);

		}
	}

	/*
	Delete file
	*/
	function delete_file($path, $filename){
		if($filename == "") return;
		$array_file	= array("small_", "normal_", "larger_", "");
		for($i=0; $i<count($array_file); $i++){
			if(file_exists($path . $array_file[$i] . $filename)) @unlink($path . $array_file[$i] . $filename);
		}
	}

	function check_image_file_size($path, $filename, $maxSize){
		$filesize = @filesize($path . $filename);
		if($filesize > $maxSize * 1024) return 0;
		else return 1;
	}

	function check_image_size($path, $filename, $widthCheck, $heightCheck, $type=0){
		//Get new dimensions
		list($width, $height) = @getimagesize($path . $filename);
		if($type == 0){
			if($width <= $widthCheck && $height <= $heightCheck) return 1;
		}
		else{
			if($width >= $widthCheck && $height >= $heightCheck) return 1;
		}
		return 0;
	}
}
?>
