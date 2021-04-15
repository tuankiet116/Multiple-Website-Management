<?
function translate_text($variable){
	return $variable;
	global $langAdmin;
	global $lang_id;
	if (isset($langAdmin[md5(trim($variable))])){
		if($langAdmin[md5(trim($variable))] !=''){
			return $langAdmin[md5(trim($variable))];
		}else{
			return "";
		}
	}
	else{
		$db_ex = new db_query("REPLACE INTO admin_translate(tra_keyword,tra_text,tra_source, lang_id) VALUES('" . md5(trim($variable)) . "','" . $variable . "','" . $variable . "', " . $lang_id . ")");
		unset($db_ex);
		return "-{" . $variable . "}-";
	}
}
function translate($variable){
	$variable = trim($variable);
	$variable = replaceMQ($variable);

	global $lang_display;
	global $lang_id;
	if($lang_id <= 0) return $variable;

	if (isset($lang_display[md5(trim($variable))])){
		if($lang_display[md5(trim($variable))] !=''){
			return $lang_display[md5(trim($variable))];
		}else{
			return $variable;
		}
	}
	else{
		$db_ex	= new db_query("	INSERT IGNORE INTO user_translate(ust_keyword, ust_text, ust_source, lang_id, ust_date)
											VALUES('".	md5($variable)	."', '".	$variable	."', '".	$variable	."', ". $lang_id ." ,". time() .")");
		unset($db_ex);
		return $variable;
	}
}

?>