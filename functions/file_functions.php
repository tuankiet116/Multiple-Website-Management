<?
function check_extension($file_name, $allowList){
	$sExtension = get_extension($file_name);
	$allowArray	= explode(",", $allowList);
	$allowPass	= false;
	for($i=0; $i<count($allowArray); $i++){
		if($sExtension == trim($allowArray[$i])) $allowPass = true;
	}
	return $allowPass;
}

function generate_file_name($file_name, $nData=""){
	$name = time() . "-" . rand(100, 999);
	if($nData != "") $name	.= "-" . replace_rewrite_url($nData);
	$ext	= get_extension($file_name);
	return mb_strtolower($name . "." . $ext, "UTF-8");
}

function get_extension($file_name){
	$sExtension = mb_substr($file_name, (mb_strrpos($file_name, ".", 0, "UTF-8") + 1), 10, "UTF-8");
	$sExtension = mb_strtolower($sExtension, "UTF-8");
	return $sExtension;
}
?>