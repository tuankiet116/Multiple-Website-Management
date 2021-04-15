<?
////////////////////////////////////////////////
// Ban khong thay doi cac dong sau:
function send_mailer($to,$title,$content,$header="",$id_error=""){
	global $con_gmail_name;
	global $con_gmail_pass;

	if(file_exists("../classes/mailer/class.phpmailer.php")){
		require_once("../classes/mailer/class.phpmailer.php");
	}else{
		if(file_exists("../classes/mailer/class.phpmailer.php")){
			require_once("../../classes/mailer/class.phpmailer.php");
		}
	}

//	$mail_server 	= "hl-lw02.hosting.viettelidc.com.vn";
//	$user_name		= "no-reply@gotrip.vn";
//	$password		= "2@*bwoAV3u";

	$mail_server 	= "smtp.gmail.com";
	$user_name		= $con_gmail_name;
	$password		= $con_gmail_pass;

	//bắt đầu thực hiện gửi mail
	$mail 				= new PHPMailer();
	$mail->IsSMTP();
	$mail->Host     	= $mail_server;
	$mail->SMTPSecure	= "ssl";
	$mail->SMTPAuth 	= true;
	$mail->CharSet 		= "UTF-8";
	$mail->ContentType	= "text/html";


	////////////////////////////////////////////////
	// Ban hay sua cac thong tin sau cho phu hop
	$mail->Username = $user_name;				// SMTP username
	$mail->Password = $password; 				// SMTP password

	$mail->From     = $user_name;				// Email duoc gui tu???
	$mail->FromName = "Bluetour.vn";			// Ten hom email duoc gui

	$to_array = explode(",",$to);
	for ($i=0; $i<count($to_array); $i++){
		$mail->AddAddress($to_array[$i],$to_array[$i]);	 	// Dia chi email va ten nhan
		//$mail->AddCC($to_array[$i],$to_array[$i]);
	}
	//$mail->AddReplyTo("abc@abc.com","Information");		// Dia chi email va ten gui lai

	//Nếu là google mail
	if ($mail->Host == "smtp.gmail.com"){
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Port       = 465;                   // set the SMTP port
	}

	$mail->IsHTML(true);						// Gui theo dang HTML

	$mail->Subject = "=?UTF-8?B?".base64_encode($title)."?=";// Chu de email
	$mail->Body     =  $content;			// Noi dung html

	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}

	return 0;
}

function generate_content($content,$array = array()){
	foreach($array as $key=>$value){
		$content = str_replace("{#" . $key . "#}",$value,$content);
	}
	return $content;
}
?>