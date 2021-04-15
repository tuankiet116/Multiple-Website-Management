<?
//Created by: Mr Toan
require_once("config_security.php");

//Khai bao Bien
$fs_table		= "admin_user";
$fs_redirect	= $_SERVER['REQUEST_URI'];


$myform = new generate_form();
$myform->removeHTML(0);
//Warning Error!
$errorMsgEmail = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "update_email"){
	$faq_question	= getValue("adm_email","str","POST","");
	//Insert to database
	$myform->add("adm_email","adm_email",2,0,"",1,translate_text("Please_enter_your_email"),0,"");
	//Add table
	$myform->addTable($fs_table);
	//Check Error!
	$errorMsgEmail .= $myform->checkdata();
	if($errorMsgEmail == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("adm_id", $admin_id));
		//echo $myform->generate_update_SQL("adm_id", $admin_id);
		echo "<script language='javascript'>alert('" . translate_text("information_was_updated_successfully") . "');</script>";
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("change_email");

//Change your password ---------------------------------------->
//Get $Errormessage
$Errormessage = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "update_password"){
	$adm_password_old	= getValue("adm_password_old","str","POST","",1);
	$adm_password 		= getValue("adm_password","str","POST","",1);
	//update to database
	$myform->add("adm_password","adm_password",4,0,"     ",1,translate_text("Please_enter_new_password"),0,"");
	//Add table
	$myform->addTable($fs_table);
	//Kiem tra do dai cua mat khau
	$allow_update = 1;
	//check current password
	if (md5($adm_password_old) != $_SESSION["password"]){
		$allow_update = 0;
		$Errormessage .= translate_text("Old_password_is_not_correct") . " <br>";
	}
	if (strlen($adm_password) < 6){
		$allow_update = 0;
		$Errormessage .= translate_text("Password_must_be_atleast_6_characters") . " <br>";
	}
	//Check Error!
	if($allow_update == 1){
		$db_ex = new db_execute($myform->generate_update_SQL("adm_id", $admin_id));
		//echo $myform->generate_update_SQL("adm_id", $admin_id);
		$_SESSION["password"] = md5($adm_password);
		echo "<script language='javascript'>alert('"  . translate_text("Your_new_password_has_been_updated")  . " !');</script>";
		redirect($fs_redirect);
		exit();
	}
}
//Select data
$db_data = new db_query("SELECT * FROM admin_user WHERE adm_id = " . $admin_id);
if (mysqli_num_rows($db_data->result) > 0)
{
	$row = mysqli_fetch_assoc($db_data->result);
	$db_data->close();
	unset($db_data);
}
else{
	echo "Cannot find data";
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?=$fs_stype_css?>" rel="stylesheet" type="text/css">
<link href="<?=$fs_template_css?>" rel="stylesheet" type="text/css">
<link href="../css/mycss.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.css"> 
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script language="javascript">
function check_form_change_password(){
	if (document.getElementById("adm_password_old").value==''){
		alert('<?=translate_text("Please_enter_Old_password")?>');
		return;
	}
	if (document.getElementById("adm_password").value==''){
		alert('<?=translate_text("Please_enter_New_password")?>');
		return;
	}
	if (document.getElementById("adm_password").value.length < 6 ){
		alert('<?=translate_text("New_password_must_be_at_least_6_characters")?>');
		return;
	}
	if (document.getElementById("adm_password_con").value==''){
		alert('<?=translate_text("Please_enter_confirm_password")?>');
		return;
	}
	if (document.getElementById("adm_password_con").value!=document.getElementById("adm_password").value){
		alert('<?=translate_text("New_password_and_confirm_password_is_not_correct")?> !');
		return;
	}
	document.change_password.submit();
}
</script>
<?
$myform->checkjavascript();
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

<!-- <?=template_top(translate_text("edit_the_information_management"))?> -->

<table cellpadding="5" cellspacing="0" align="center" class="profile-change" style="border-collapse:collapse; margin-top:70px;" border="1" bordercolor="<?=$fs_border?>">
	<tr bgcolor="<?=$fs_bgtitle?>">
		<td class="bold">
			<?=translate_text("Đổi Email")?>
		</td>
		<td class="bold">
			<?=translate_text("Đổi mật khẩu")?>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="3" cellspacing="2" class="profile-form" width="100%" height="200" align="center">
				<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="change_email" onsubmit="validateForm(); return false;">
					 <tr>
						  <td colspan="2" align="center" style="color:#FF0000">
								<?=$errorMsgEmail?>
						  </td>
					 </tr>
					 <tr>
						  <td class="textBold" nowrap="nowrap" align="right" width="20%" height="43"><?=translate_text("Tài khoản")?> :</td>
						  <td><?=$row["adm_loginname"]?></td>
					 </tr>
					 <tr>
						  <td class="textBold" nowrap="nowrap" align="right"><?=translate_text("Email")?> :</td>
						  <td><input type="text" name="adm_email" id="adm_email" value="<?=$row["adm_email"]?>" class="form"></td>
					 </tr>
					 <tr>
					 	  <td colspan="2" style="height: 43px"></td>
					 </tr>
					 <tr>
						  <td colspan="2" align="center">
								<input type="submit" class="form btn btn-sm btn-info" value="<?=translate_text("Đổi Email")?>" style="cursor:hand;">&nbsp;
								<input type="reset" class="form btn btn-sm btn-info" value="<?=translate_text("Làm mới")?>" style="cursor:hand;">
								<input type="hidden" name="action" value="update_email">
						  </td>
					 </tr>
				</form>
			</table>
		</td>
		<td>
			<table border="0" cellpadding="3" cellspacing="2" class="profile-form" width="100%" height="200" align="center">
			 <form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="change_password">
				  <tr>
						<td colspan="2" align="center" style="color:#FF0000; height: 20px">
							 <?=$Errormessage;?>
						</td>
				  </tr>
				  <tr>
						<td class="textBold" nowrap="nowrap" align="right" width="20%"><?=translate_text("Mật khẩu cũ")?> :</td>
						<td><input type="password" name="adm_password_old" id="adm_password_old" class="form" size="20"></td>
				  </tr>
				  <tr>
						<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("Mật khẩu mới")?> :</td>
						<td><input type="password" name="adm_password" id="adm_password" class="form" size="20"></td>
				  </tr>
				  <tr>
						<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("Xác nhận mật khẩu")?> :</td>
						<td><input type="password" name="adm_password_con" id="adm_password_con" class="form" size="20"></td>
				  </tr>
				  <tr>
						<td colspan="2" align="center">
							 <input type="button" class="form btn btn-sm btn-info" value="<?=translate_text("Đổi mật khẩu")?>" style="cursor:hand;" onClick="check_form_change_password();">&nbsp;
							 <input type="reset" class="form btn btn-sm btn-info" value="<?=translate_text("Làm mới")?>" style="cursor:hand;">
							 <input type="hidden" name="action" value="update_password">
						</td>
				  </tr>
			 </form>
			 </table>
		</td>
	</tr>
</table>
<?=template_bottom() ?>
</body>
</html>