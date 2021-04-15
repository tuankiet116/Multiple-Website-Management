<?

/**
 * Chuyển đổi URL truyền vào => Trả về domain trương ứng
 * url2domain()
 *
 * @param mixed $url
 *
 * @return
 */
function url2domain($url)
{
	$domain  = "";
	$url     = trim($url);
	$url     = str_replace("http://", "", $url);
	$url     = str_replace("https://", "", $url);
	$arrTemp = explode("/", $url);
	if (isset($arrTemp[0])) $domain = $arrTemp[0];
	$domain = str_replace("wwww.", "", $domain);
	$domain = str_replace("www.", "", $domain);
	
	return $domain;
}

/**
 * Thay thế ký tự quote => Tránh lỗi SQL Injection
 * removeQuote()
 *
 * @param mixed $string
 *
 * @return
 */
function removeQuote($string)
{
	$string = trim($string);
	$string = str_replace("\'", "'", $string);
	$string = str_replace("'", "''", $string);
	return $string;
}

/**
 * callback()
 *
 * @param mixed $buffer
 *
 * @return
 */
function callback($buffer)
{
    return $buffer;
	$arrStr = array(chr(9), chr(10), chr(13) . chr(13) . chr(13), chr(13) . chr(13));
	$arrRep = array("", "", chr(13), chr(13));
	$buffer = str_replace($arrStr, $arrRep, $buffer);
	return trim($buffer);
}

/**
 * Kiểm tra email => Nếu đúng định dạng email thì trả về true
 * check_email_address()
 *
 * @param mixed $email
 *
 * @return
 */
function check_email_address($email)
{
	//First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		//Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	//Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return false;
		}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
		//Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

/**
 * Kiểm tra chuỗi session security
 * check_session_security()
 *
 * @param mixed $security_code
 *
 * @return
 */
function check_session_security($security_code)
{
	$return = 1;
	if (!isset($_SESSION["securitycode"])) $_SESSION["securitycode"] = generate_security_code();
	if ($security_code != $_SESSION["securitycode"]) {
		$return = 0;
	}
	// Reset lại session security code
	$_SESSION["securitycode"] = generate_security_code();
	return $return;
}

/**
 * cut_string()
 *
 * @param mixed $str
 * @param mixed $length
 * @param string $char
 *
 * @return
 */
function cut_string($str, $length, $char = " ...")
{
	//Nếu chuỗi cần cắt nhỏ hơn $length thì return luôn
	$strlen = mb_strlen($str, "UTF-8");
	if ($strlen <= $length) return $str;
	
	//Cắt chiều dài chuỗi $str tới đoạn cần lấy
	$substr = mb_substr($str, 0, $length, "UTF-8");
	if (mb_substr($str, $length, 1, "UTF-8") == " ") return $substr . $char;
	
	//Xác định dấu " " cuối cùng trong chuỗi $substr vừa cắt
	$strPoint = mb_strrpos($substr, " ", "UTF-8");
	
	//Return string
	if ($strPoint < $length - 20) return $substr . $char;
	else return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
}

/**
 * format_number()
 *
 * @param mixed $number
 * @param integer $num_decimal
 * @param integer $edit
 *
 * @return
 */
function format_number($number, $num_decimal = 2, $edit = 0)
{
	
	$sep    = ($edit == 0 ? array(",", ".") : array(".", ""));
	$stt    = -1;
	$return = number_format($number, $num_decimal, $sep[0], $sep[1]);
	for ($i = $num_decimal; $i > 0; $i--) {
		$stt++;
		if (intval(substr($return, -$i, $i)) == 0) {
			$return = number_format($number, $stt, $sep[0], $sep[1]);
			break;
		}
	}
	return $return;
	
}

/**
 * generate_security_code()
 *
 * @return
 */
function generate_security_code()
{
	$code = rand(1000, 9999);
	return $code;
}

/**
 * generate_sort()
 *
 * @param mixed $type
 * @param mixed $sort
 * @param mixed $current_sort
 * @param mixed $image_path
 *
 * @return
 */
function generate_sort($type, $sort, $current_sort, $image_path)
{
	if ($type == "asc") {
		$title = "Tang_dan";
		if ($sort != $current_sort) $image_sort = "sortasc.gif";
		else $image_sort = "sortasc_selected.gif";
	} else {
		$title = "Giam_dan";
		if ($sort != $current_sort) $image_sort = "sortdesc.gif";
		else $image_sort = "sortdesc_selected.gif";
	}
	return '<a title="' . $title . '" href="' . getURL(0, 0, 1, 1, "sort") . '&sort=' . $sort . '"><img border="0" src="' . $image_path . $image_sort . '" style="margin-top:3px" /></a>';
}

/**
 * getURL()
 *
 * @param integer $serverName
 * @param integer $scriptName
 * @param integer $fileName
 * @param integer $queryString
 * @param string $varDenied
 *
 * @return
 */
function getURL($serverName = 0, $scriptName = 0, $fileName = 1, $queryString = 1, $varDenied = '')
{
	$url   = '';
	$slash = '/';
	if ($scriptName != 0) $slash = "";
	if ($serverName != 0) {
		if (isset($_SERVER['SERVER_NAME'])) {
			$url .= 'http://' . $_SERVER['SERVER_NAME'];
			if (isset($_SERVER['SERVER_PORT'])) $url .= ":" . $_SERVER['SERVER_PORT'];
			$url .= $slash;
		}
	}
	if ($scriptName != 0) {
		if (isset($_SERVER['SCRIPT_NAME'])) $url .= substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if ($fileName != 0) {
		if (isset($_SERVER['SCRIPT_NAME'])) $url .= substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if ($queryString != 0) {
		$url .= '?';
		reset($_GET);
		$i = 0;
		if ($varDenied != '') {
			$arrVarDenied = explode('|', $varDenied);
			foreach ($_GET as $k => $v) {
				if (array_search($k, $arrVarDenied) === false) {
					$i++;
					if ($i > 1) $url .= '&' . $k . '=' . @urlencode($v);
					else $url .= $k . '=' . @urlencode($v);
				}
			}
		} else {
			foreach ($_GET as $k => $v) {
				$i++;
				if ($i > 1) $url .= '&' . $k . '=' . @urlencode($v);
				else $url .= $k . '=' . @urlencode($v);
			}
		}
	}
	$url = str_replace('"', '&quot;', strval($url));
	return $url;
}

/**
 * Lấy URL hiện tại
 * curPageURL()
 *
 * @return
 */
function curPageURL()
{
	$pageURL = 'http';
	if (@$_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/**
 * [getValue description]
 *
 * @param  [type]  $value_name    [description]
 * @param  string $data_type      [description]
 * @param  string $method         [description]
 * @param  integer $default_value [description]
 * @param  integer $advance       [description]
 *
 * @return [type]                 [description]
 */
function getValue($value_name, $data_type = "int", $method = "GET", $default_value = 0, $advance = 0)
{
	$value = $default_value;
	switch ($method) {
		case "GET":
			if (isset($_GET[$value_name])) $value = $_GET[$value_name];
			break;
		case "POST":
			if (isset($_POST[$value_name])) $value = $_POST[$value_name];
			break;
		case "COOKIE":
			if (isset($_COOKIE[$value_name])) $value = $_COOKIE[$value_name];
			break;
		case "SESSION":
			if (isset($_SESSION[$value_name])) $value = $_SESSION[$value_name];
			break;
		default:
			if (isset($_GET[$value_name])) $value = $_GET[$value_name];
			break;
	}
	
	switch ($data_type) {
		case 'int':
			$returnValue = intval($value);
			break;
		case 'str':
			$returnValue = trim(strval($value));
			break;
		case 'flo':
			$returnValue = floatval($value);
			break;
		case 'dbl':
			$returnValue = doubleval($value);
			break;
		case 'arr':
			$returnValue = $value;
			break;
	}
	
	if (isset($returnValue)) {
		if ($advance != 0) {
			switch ($advance) {
				case 1:
					$returnValue = replaceMQ($returnValue);
					break;
				case 2:
					$returnValue = htmlspecialbo($returnValue);
					break;
			}
		}
		
		//Do số quá lớn nên phải kiểm tra trước khi trả về giá trị
		if ($data_type != "arr" && (strval($returnValue) == "INF") && ($data_type != "str")) return 0;
		return $returnValue;
	}
	
	return (intval($value));
}

/**
 * htmlspecialbo()
 *
 * @param mixed $str
 *
 * @return
 */
function htmlspecialbo($str)
{
	$arrDenied  = array('<', '>', '\"', '"');
	$arrReplace = array('&lt;', '&gt;', '&quot;', '&quot;');
	$str        = str_replace($arrDenied, $arrReplace, $str);
	return $str;
}

/**
 * javascript_writer()
 *
 * @param mixed $str
 *
 * @return
 */
function javascript_writer($str)
{
	$mytextencode = "";
	for ($i = 0; $i < strlen($str); $i++) {
		$mytextencode .= ord(substr($str, $i, 1)) . ",";
	}
	if ($mytextencode != "") $mytextencode .= "32";
	return "<script language='javascript'>document.write(String.fromCharCode(" . $mytextencode . "));</script>";
}

/**
 * lang_path()
 *
 * @return
 */
function lang_path()
{
	global $lang_id;
	global $array_lang;
	global $con_root_path;
	$default_lang = 1;
	$path         = ($lang_id == $default_lang) ? $con_root_path : $con_root_path . $array_lang[$lang_id][0] . "/";
	return $path;
}

/**
 * microtime_float()
 *
 * @return
 */
function microtime_float()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}

/**
 * random()
 *
 * @return
 */
function random()
{
	$rand_value = "";
	$rand_value .= rand(1000, 9999);
	$rand_value .= chr(rand(65, 90));
	$rand_value .= rand(1000, 9999);
	$rand_value .= chr(rand(97, 122));
	$rand_value .= rand(1000, 9999);
	$rand_value .= chr(rand(97, 122));
	$rand_value .= rand(1000, 9999);
	return $rand_value;
}

/**
 * redirect()
 *
 * @param mixed $url
 *
 * @return void
 */
function redirect($url)
{
	$url = htmlspecialbo($url);
	echo '<script type="text/javascript">window.location.href = "' . $url . '";</script>';
	exit();
}

/**
 * [redirectHeader description]
 *
 * @param  [type]  $url  [description]
 * @param  integer $http [description]
 *
 * @return [type]        [description]
 */
function redirectHeader($url, $http = 0)
{
	if ($http == 0) $url = str_replace("://", "", $url);
	Header("HTTP/1.1 301 Moved Permanently");
	Header("Location: " . $url);
	exit();
}

/**
 * removeAccent()
 *
 * @param mixed $mystring
 *
 * @return
 */
function removeAccent($mystring)
{
	$marTViet = array(
		// Chữ thường
		"à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
		"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
		"ì", "í", "ị", "ỉ", "ĩ",
		"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
		"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
		"ỳ", "ý", "ỵ", "ỷ", "ỹ",
		"đ", "Đ", "'",
		// Chữ hoa
		"À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
		"È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
		"Ì", "Í", "Ị", "Ỉ", "Ĩ",
		"Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
		"Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
		"Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
		"Đ", "Đ", "'"
	);
	$marKoDau = array(
		/// Chữ thường
		"a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
		"e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
		"i", "i", "i", "i", "i",
		"o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
		"u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
		"y", "y", "y", "y", "y",
		"d", "D", "",
		//Chữ hoa
		"A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
		"E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
		"I", "I", "I", "I", "I",
		"O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
		"U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
		"Y", "Y", "Y", "Y", "Y",
		"D", "D", "",
	);
	return str_replace($marTViet, $marKoDau, $mystring);
}

/**
 * removeHTML()
 *
 * @param mixed $string
 *
 * @return
 */
function removeHTML($string)
{
	$string = preg_replace('/<script.*?\>.*?<\/script>/si', ' ', $string);
	$string = preg_replace('/<style.*?\>.*?<\/style>/si', ' ', $string);
	$string = preg_replace('/<.*?\>/si', ' ', $string);
	$string = str_replace('&nbsp;', ' ', $string);
	return $string;
}

/**
 * removeLink()
 *
 * @param mixed $string
 *
 * @return
 */
function removeLink($string)
{
	$string = preg_replace('/<a.*?\>/si', '', $string);
	$string = preg_replace('/<\/a>/si', '', $string);
	return $string;
}

/**
 * replaceFCK()
 *
 * @param mixed $string
 * @param integer $type
 *
 * @return
 */
function replaceFCK($string, $type = 0)
{
	$array_fck  = array(
		"&Agrave;", "&Aacute;", "&Acirc;", "&Atilde;", "&Egrave;", "&Eacute;", "&Ecirc;", "&Igrave;", "&Iacute;", "&Icirc;",
		"&Iuml;", "&ETH;", "&Ograve;", "&Oacute;", "&Ocirc;", "&Otilde;", "&Ugrave;", "&Uacute;", "&Yacute;", "&agrave;",
		"&aacute;", "&acirc;", "&atilde;", "&egrave;", "&eacute;", "&ecirc;", "&igrave;", "&iacute;", "&ograve;", "&oacute;",
		"&ocirc;", "&otilde;", "&ugrave;", "&uacute;", "&ucirc;", "&yacute;",
	);
	$array_text = array(
		"À", "Á", "Â", "Ã", "È", "É", "Ê", "Ì", "Í", "Î",
		"Ï", "Ð", "Ò", "Ó", "Ô", "Õ", "Ù", "Ú", "Ý", "à",
		"á", "â", "ã", "è", "é", "ê", "ì", "í", "ò", "ó",
		"ô", "õ", "ù", "ú", "û", "ý",
	);
	if ($type == 1) $string = str_replace($array_fck, $array_text, $string);
	else $string = str_replace($array_text, $array_fck, $string);
	return $string;
}

/**
 * replaceJS()
 *
 * @param mixed $text
 *
 * @return
 */
function replaceJS($text)
{
	$arr_str = array("\'", "'", '"', "&#39", "&#39;", chr(10), chr(13), "\n");
	$arr_rep = array(" ", " ", '&quot;', " ", " ", " ", " ");
	$text    = str_replace($arr_str, $arr_rep, $text);
	$text    = str_replace("    ", " ", $text);
	$text    = str_replace("   ", " ", $text);
	$text    = str_replace("  ", " ", $text);
	return $text;
}

/**
 * replace_keyword_search()
 *
 * @param mixed $keyword
 * @param integer $lower
 *
 * @return
 */
function replace_keyword_search($keyword, $lower = 1)
{
	if ($lower == 1) $keyword = mb_strtolower($keyword, "UTF-8");
	$keyword = replaceMQ($keyword);
	$arrRep  = array("'", '"', "-", "+", "=", "*", "?", "/", "!", "~", "#", "@", "%", "$", "^", "&", "(", ")", ";", ":", "\\", ".", ",", "[", "]", "{", "}", "‘", "’", '“', '”');
	$keyword = str_replace($arrRep, " ", $keyword);
	$keyword = str_replace("  ", " ", $keyword);
	$keyword = str_replace("  ", " ", $keyword);
	return $keyword;
}

/**
 * replaceMQ()
 *
 * @param mixed $text
 *
 * @return
 */
function replaceMQ($text)
{
	$text = str_replace("\'", "'", $text);
	$text = str_replace("'", "''", $text);
	$text = str_replace("\\", "", $text);
	return $text;
}

/**
 * remove_magic_quote()
 *
 * @param mixed $str
 *
 * @return
 */
function remove_magic_quote($str)
{
	$str = str_replace("\'", "'", $str);
	$str = str_replace("\&quot;", "&quot;", $str);
	$str = str_replace("\\\\", "\\", $str);
	return $str;
}

/**
 * Đổi resultset ra dạng list
 * convert_result_set_2_list()
 *
 * @param mixed $result_set
 * @param mixed $id_field
 * @param string $start_value
 * @param integer $type
 *
 * @return
 */
function convert_result_set_2_list($result_set, $id_field, $start_value = "0", $type = 0)
{
	$str_return = $start_value;
	
	//Move first resultset
	if (mysqli_num_rows($result_set) > 0) mysqli_data_seek($result_set, 0);
	while ($row_t = mysqli_fetch_assoc($result_set)) {
		switch ($type) {
			case 1 :
				if ($row_t[$id_field] > 0) $str_return .= "," . $row_t[$id_field];
				break;
			default:
				$str_return .= "," . $row_t[$id_field];
				break;
		}
	}
	
	//Sau khi loop move first lại từ đầu
	if (mysqli_num_rows($result_set) > 0) mysqli_data_seek($result_set, 0);
	return $str_return;
}

//Đổi resultset ra array
function convert_result_set_2_array($result_set, $id_field = "")
{
	$array_return = array();
	
	//Move first resultset
	if (mysqli_num_rows($result_set) > 0) mysqli_data_seek($result_set, 0);
	while ($row_t = mysqli_fetch_assoc($result_set)) {
		if ($id_field == "") $array_return[] = $row_t;
		else $array_return[$row_t[$id_field]] = $row_t;
	}
	
	//Sau khi loop move first lại từ đầu
	if (mysqli_num_rows($result_set) > 0) mysqli_data_seek($result_set, 0);

	echo $array_return;
	return $array_return;
}

/**
 * convert_string_to_array()
 *
 * @param mixed $string
 *
 * @return
 */
function convert_string_to_array($string)
{
	$arrReturn = array();
	preg_match_all('/\[(.*?)\]/is', $string, $matches);
	if (isset($matches[1])) {
		for ($i = 0; $i < count($matches[1]); $i++) {
			$arrReturn[] = $matches[1][$i];
		}
	}
	return $arrReturn;
}

/**
 * convert_string_to_list_id()
 *
 * @param mixed $string
 *
 * @return
 */
function convert_string_to_list_id($string)
{
	$list_id = 0;
	preg_match_all('/\[(.*?)\]/is', $string, $matches);
	if (isset($matches[1])) {
		for ($i = 0; $i < count($matches[1]); $i++) {
			$list_id .= "," . $matches[1][$i];
		}
	}
	return $list_id;
}

/**
 * convert_list_to_list_id()
 *
 * @param mixed $string
 *
 * @return
 */
function convert_list_to_list_id($string)
{
	// Bẻ $string để intval lại
	$arrTemp = explode(",", $string);
	$list_id = "";
	foreach ($arrTemp as $key => $value) $list_id .= "," . intval($value);
	// Remove dấu , đầu tiên
	if (strlen($list_id) > 0) $list_id = substr($list_id, 1);
	else $list_id = 0;
	return $list_id;
}

/**
 * convert_list_to_array()
 *
 * @param mixed $string
 * @param bool $return_null_array
 * @param integer $df_null_value
 *
 * @return
 */
function convert_list_to_array($string, $return_null_array = false, $df_null_value = 0)
{
	// Bẻ $string để intval lại
	$arrTemp  = explode(",", $string);
	$array_id = array();
	foreach ($arrTemp as $key => $value) $array_id[] = intval($value);
	
	//Nếu ra array rỗng và !$return_null_array không cho trả lại array rỗng thì gán cho giá trị trả về 1 phần tử df
	if (count($array_id) == 0 && !$return_null_array) $array_id = array($df_null_value);
	return $array_id;
}

/**
 * convert_array_to_list()
 *
 * @param mixed $array_input
 *
 * @return
 */
function convert_array_to_list($array_input)
{
	$string_return = "";
	if (!is_array($array_input) || count($array_input) <= 0) return $string_return;
	
	$arrTemp = array();
	foreach ($array_input as $value) {
		$arrTemp[] = trim($value);
	}
	
	//Loại bỏ phần tử trùng
	$arrTemp = array_unique($arrTemp);
	
	if (count($arrTemp) > 0) $string_return = implode(",", $arrTemp);
	
	return $string_return;
}

/**
 * removeExcessSpace()
 *
 * @param mixed $data
 *
 * @return
 */
function removeExcessSpace($data)
{
	$data = preg_replace('/(\n|\r)+/', '', $data); // Xóa ký tự xuống dòng
	$data = trim(preg_replace("/[ \s]+/", ' ', $data)); // Xóa ký tự trắng thừa
	
	return $data;
}

/**
 * decode_FCK_htmlentities()
 *
 * @param mixed $data
 *
 * @return
 */
function decode_FCK_htmlentities($data)
{
	$data = html_entity_decode($data, ENT_QUOTES, "utf-8");
	return $data;
}

/**
 * Convert Unicode -> Unicode Composite => Dùng cho mobile
 * convert_unicode_to_unicode_composite()
 *
 * @param mixed $input_str
 *
 * @return
 */
function convert_unicode_to_unicode_composite($input_str)
{
	
	$array_unicode = array(
		"à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
		"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
		"ì", "í", "ị", "ỉ", "ĩ",
		"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
		"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
		"ỳ", "ý", "ỵ", "ỷ", "ỹ",
		"đ",
		"À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
		"È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
		"Ì", "Í", "Ị", "Ỉ", "Ĩ",
		"Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
		"Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
		"Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
		"Đ"
	);
	
	$array_unicode_composite = array(
		"à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
		"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
		"ì", "í", "ị", "ỉ", "ĩ",
		"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
		"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
		"ỳ", "ý", "ỵ", "ỷ", "ỹ",
		"đ",
		"À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
		"È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
		"Ì", "Í", "Ị", "Ỉ", "Ĩ",
		"Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
		"Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
		"Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
		"Đ"
	);
	
	return str_replace($array_unicode, $array_unicode_composite, $input_str);
}

/**
 * Kiểm tra số điện thoại
 * valid_phone()
 *
 * @param mixed $phone_number
 *
 * @return
 */
function valid_phone($phone_number)
{
	
	$valid_phone  = '';
	$phone_number = strval($phone_number);
	$first        = substr($phone_number, 0, 1);
	if ($first == '0') {
		$first       = '84';
		$valid_phone = $first . substr($phone_number, 1);
	} elseif ($first != "+") {
		$valid_phone = $phone_number;
	} else {
		$valid_phone = substr($phone_number, 1);
	}
	
	// Chỉ lấy ký tự số
	$pattern     = '(\D)';
	$valid_phone = preg_replace($pattern, '', $valid_phone);
	
	return $valid_phone;
}

/**
 * Hàm chuyển đổi số tiền dạng phân cách 3 chữ số
 * formatCurrency()
 *
 * @param mixed $iPrice
 *
 * @return
 */
function formatCurrency($iPrice)
{
	return number_format($iPrice, 0, "", ".");
}

/**
 * valid_login_name()
 *
 * @param mixed $login
 *
 * @return
 */
function valid_login_name($login)
{
	return preg_match('/^[a-zA-Z0-9_.@]{3,}$/', $login);
}

/**
 * Hàm ẩn email, tranh bị bot scan
 * hide_email()
 *
 * @param mixed $email
 *
 * @return
 */
function hide_email($email)
{
	$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
	$key           = str_shuffle($character_set);
	$cipher_text   = '';
	$id            = 'e' . rand(1, 999999999);
	
	for ($i = 0; $i < strlen($email); $i++) $cipher_text .= $key[strpos($character_set, $email[$i])];
	
	$script = 'var a="' . $key . '";var b=a.split("").sort().join("");var c="' . $cipher_text . '";var d="";';
	$script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
	$script .= 'document.getElementById("' . $id . '").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';
	$script = "eval(\"" . str_replace(array("\\", '"'), array("\\\\", '\"'), $script) . "\")";
	$script = '<script type="text/javascript">/*<![CDATA[*/' . $script . '/*]]>*/</script>';
	
	return '<span id="' . $id . '">[javascript protected email address]</span>' . $script;
}

/**
 * base64_url_encode()
 *
 * @param mixed $input
 *
 * @return
 */
function base64_url_encode($input)
{
	return strtr(base64_encode($input), '+/=', '_,-');
}

/**
 * base64_url_decode()
 *
 * @param mixed $input
 *
 * @return
 */
function base64_url_decode($input)
{
	return base64_decode(strtr($input, '_,-', '+/='));
}

/**
 * dump_log()
 *
 * @param mixed $log_data  : Chuoi du lieu can log
 * @param string $log_type : Loai log de lua chon file log tuong ung
 *
 * @return void
 */
function dump_log($log_data, $log_type = "SQL_LOG")
{
	//Lấy thư mục ipstore
	$log_dir      = str_replace("functions", "ipstore", dirname(__FILE__));
	$current_date = date("Ymd");
	
	switch ($log_type) {
		case "NOTIFY":
			$log_file = $log_dir . "/" . $current_date . "_dump_notify_log.cfn";
			break;
		case "LOGIN":
			$log_file = $log_dir . "/" . $current_date . "_dump_login_log.cfn";
			break;
		default:
			$log_file = $log_dir . "/" . $current_date . "_dump_log.cfn";
			break;
	}
	
	$handle = @fopen($log_file, "a");
	//Nếu handle chưa có mở thêm ../
	if ($handle) {
		@fwrite($handle, date("d/m/Y h:i:s A") . " \n" . $log_data . " \n ---------------------- \n");
		@fclose($handle);
	}
}


/**
 * Sắp xếp mảng nhiều chiều theo key
 *
 * @param  [type] $arr [description]
 *
 * @return [type]      [description]
 */
function deep_ksort(&$arr)
{
	ksort($arr);
	foreach ($arr as &$a) {
		if (is_array($a) && !empty($a)) {
			deep_ksort($a);
		}
	}
}

/**
 * Sắp xếp mảng nhiều chiều theo value
 *
 * @param  [type] $arr [Mảng dữ liệu đầu vào]
 *
 * @return [type]      [Trả về giá trị sau khi sắp xếp]
 */
function deep_sort_by_value(&$arr)
{
	asort($arr);
	foreach ($arr as &$a) {
		if (is_array($a) && !empty($a)) {
			deep_sort_by_value($a);
		}
	}
}

/**
 * Hàm so sánh 2 số theo kiểu giảm dần dùng trong các hàm sử dụng uasort
 *
 * @param  Integer $a [Số thứ nhất]
 * @param  Integer $b [Số thứ 2]
 *
 * @return Integer    [Trả về 0 nếu 2 số bằng nhau, bằng 1 nếu $a < $b, bằng -1 nếu $a > $b]
 */
function sort_desc($a, $b)
{
	if ($a == $b) return 0;
	return ($a > $b) ? -1 : 1;
}

/**
 * Hàm so sánh 2 số theo kiểu tăng dần dùng trong các hàm sử dụng uasort
 *
 * @param  Integer $a [Số thứ nhất]
 * @param  Integer $b [Số thứ 2]
 *
 * @return Integer    [Trả về 0 nếu 2 số bằng nhau, bằng 1 nếu $a > $b, bằng -1 nếu $a < $b]
 */
function sort_asc(Integer $a, Integer $b)
{
	if ($a == $b) return 0;
	return ($a < $b) ? -1 : 1;
}

/**
 * Covert vietnames LOCAL CP 1258 -> Unicode
 *
 * @param  [type] $input_str [description]
 *
 * @return [type]            [description]
 */
function convert_cp1258_to_unicode($input_str)
{
	
	$array_1258 = array(
		"à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
		"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
		"ì", "í", "ị", "ỉ", "ĩ",
		"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
		"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
		"ỳ", "ý", "ỵ", "ỷ", "ỹ",
		"đ"
	);
	
	$array_unicode = array(
		"à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
		"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
		"ì", "í", "ị", "ỉ", "ĩ",
		"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
		"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
		"ỳ", "ý", "ỵ", "ỷ", "ỹ",
		"đ"
	);
	
	return str_replace($array_1258, $array_unicode, $input_str);
}

/**
 * show array sang dang XML
 *
 * @param  [type] $array [description]
 *
 * @return [type]        [description]
 */
function show_ArraytoXML($array)
{
	$xml_echo = "";
	$mid_arr  = "";
	foreach ($array as $key => $value) {
		$xml_echo .= '<' . $key . '>';
		if (is_array($value) && !empty($value)) {
			$mid_arr  = show_ArraytoXML($value);
			$xml_echo .= "\n" . $mid_arr . '</' . $key . '>' . "\n";
		} else {
			$xml_echo .= $value . '</' . $key . '>' . "\n";
		}
	}
	return $xml_echo;
}

function getAllParent_v2($table_name, $id_field, $parent_id_field, $list_field, $id)
{
	global $config_memcache;
	if (!isset($config_memcache)) $config_memcache = 0;
	
	$array_return = array();
	
	$id = intval($id);
	if ($array_return) {
		return $array_return;
	}
	
	$finish     = false;
	$current_id = $id;
	while (!$finish) {
		$db_getparent = new db_query ("SELECT " . $parent_id_field . ", " . $list_field . " " .
			"FROM " . $table_name . " " .
			"WHERE " . $id_field . "=" . $current_id,
			"File:" . __FILE__ . ", LINE : " . __LINE__, "USE_SLAVE");
		if ($row = mysqli_fetch_assoc($db_getparent->result)) {
			$array_return[$current_id] = $row;
			$current_id                = $row[$parent_id_field];
		} else {
			$finish = true;
		}
		unset($db_getparent);
	}
	
	return $array_return;
}

function resetAllChild($table, $id_field, $field_parent, $field_has_child, $field_all_child, $sqlWhere, $order_clause)
{
	$class_menu      = new menu;
	$arrayHeaderMenu = $class_menu->getAllChild($table, $id_field, $field_parent, 0, $sqlWhere, "" . $id_field . "," . $field_has_child . "", $order_clause, 0, 1, 0);
	
	// Lặp từ trên xuống dưới để lấy các cat con( dựa vào level)
	for ($i = 0; $i < count($arrayHeaderMenu); $i++) {
		$listid = $arrayHeaderMenu[$i][$id_field]; // Lấy id của chính nó
		// Lặp các danh mục tiếp theo nếu level của danh mục tiếp theo lớn hơn thì đấy chính là cấp con
		$cat_has_child = 0;
		for ($j = $i + 1; $j < count($arrayHeaderMenu); $j++) {
			if ($arrayHeaderMenu[$j]['level'] > $arrayHeaderMenu[$i]['level']) {
				$listid        .= ", " . $arrayHeaderMenu[$j][$id_field];
				$cat_has_child = 1;
			} else {
				// Đã hết cấp con
				break;
			}
		}
		$listid = convert_list_to_list_id($listid);
		// Cập nhật database
		$db_update = new db_execute("UPDATE " . $table . " SET " . $field_has_child . " = " . $cat_has_child . ", " . $field_all_child . " = '" . $listid . "' WHERE " . $id_field . " = " . intval($arrayHeaderMenu[$i][$id_field]));
		unset($db_update);
	}
}

function showListQueryOnePage()
{
	global $arrayListQueryOnPage;
	
	$htmlReturn = "";
	if (is_array($arrayListQueryOnPage) && $arrayListQueryOnPage) {
		//$htmlReturn .= '<div align="center"><span style="background:#121212; font-size:12px; color:#FFFFFF">Generate time : ' . number_format($fs_time,10,".",",") . " s. Memory usage = " . number_format(memory_get_usage() / 1024) . ' KB</span></div>';
		// Lấy param debug, nếu debug = showquery thì mới show -> Tránh các máy bên cửa hàng cho khách xem SP nhìn thấy
		$debug = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
		$debug = explode("debug=", $debug);
		if (isset($debug[1])) {
			$debug = substr($debug[1], 0, 9);
		} else {
			$debug = "";
		}
		
		if ($debug == "showquery") {
			$htmlReturn .= '<table bgcolor="#FFFFFF" cellspacing="0" cellpadding="8" width="100%" align="center">';
			$htmlReturn .= '<tr>
									<td style="padding: 8px;">STT</td>
									<td style="padding: 8px;">TYPE</td>
									<td style="padding: 8px;">TIME</td>
									<td style="padding: 8px;">FILE NAME</td>
									<td style="padding: 8px;">QUERY</td>
								</tr>';
			foreach ($arrayListQueryOnPage as $key => $value) {
				$bgcolor = "#FFFFFF";
				if ($key % 2 == 0) $bgcolor = "#EEEEEE";
				if ($value['time'] >= 0.5) $bgcolor = "red";
				$value['query'] = str_replace("'", "\"", $value['query']);
				$value['query'] = str_replace(",", ", ", $value['query']);
				$value['query'] = htmlspecialbo($value['query']);
				$htmlReturn     .= '<tr bgcolor="' . $bgcolor . '">
										<td style="padding: 8px;" valign="top">' . ($key + 1) . '</td>
										<td style="padding: 8px;" valign="top">' . $value['type'] . '</td>
										<td style="padding: 8px;" valign="top">' . $value['time'] . '</td>
										<td style="padding: 8px;" valign="top">' . $value['file'] . '</td>
										<td style="padding: 8px;">' . $value['query'] . '</td>
									</tr>';
			}
			$htmlReturn .= '</table>';
		}
	}
	
	return $htmlReturn;
}

function currentURL()
{
	$url     = '';
	$qString = $_SERVER['REQUEST_URI'];
	if (strpos($qString, '?') == FALSE) return $qString;
	$qString = explode('?', $qString);
	$url     .= $qString[0];
	$get     = explode('&', $qString[1]);
	$pre     = '';
	foreach ($get as $value) {
		$val = explode('=', $value);
		if ($val[1] != '') {
			if ($pre == '') {
				$pre = '?';
			} else {
				$pre = '&';
			}
			$url .= $pre . $val[0] . '=' . $val[1];
		}
	}
	return $url;
}

// Hàm đảo ngược chuỗi
function mb_strrev($str, $encoding = "utf-8")
{
	$ret = "";
	for ($i = mb_strlen($str, $encoding) - 1; $i >= 0; $i--) {
		$ret .= mb_substr($str, $i, 1, $encoding);
	}
	return $ret;
}

// get content curl
function getContentCURL($link)
{
	$time_start = microtime_float();
	
	$url  = $link;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	$data = curl_exec($curl);
	curl_close($curl);
	
	$time_end = microtime_float();
	$time     = $time_end - $time_start;
	
	@file_put_contents("../ipstore/api.cfn", $link . " | " . $time . PHP_EOL, FILE_APPEND);
	
	return json_decode($data, 1);
}

function postContentCURL($link, $arrData){
	$time_start  = microtime_float();
	$curl        = curl_init();
	$url         = $link;
	$data_string = http_build_query($arrData);

	curl_setopt_array($curl, array(
		CURLOPT_URL            => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING       => "",
		CURLOPT_MAXREDIRS      => 10,
		CURLOPT_TIMEOUT        => 30,
		CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST  => "POST",
		CURLOPT_POSTFIELDS     => $data_string,
	  	CURLOPT_HTTPHEADER => array(
	    	"cache-control: no-cache",
	    	"content-type: application/x-www-form-urlencoded"
	  	),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$time_end = microtime_float();
	$time     = $time_end - $time_start;
	
	@file_put_contents("../ipstore/api.cfn", $link . " | " . $time . PHP_EOL, FILE_APPEND);
	return json_decode($response, 1);
}
?>