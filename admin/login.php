<?
require_once("session.php");

$lang_id	= 1;
require_once("../functions/translate.php");
require_once("../functions/functions.php");
require_once("../classes/database.php");
require_once("resource/security/functions.php");

$username	= getValue("username", "str", "POST", "", 1);
$password	= getValue("password", "str", "POST", "", 1);
$action		= getValue("action", "str", "POST", "");

//Kiem tra xem ip nay co duoc phep vao admin hay khong
$ip					= $_SERVER['REMOTE_ADDR'];
$check_ip_exists	= 1;
if(file_exists("ipstore/" . ip2long($ip) . ".cfn")){
	$check_ip_exists	= 1;
}

if($action == "login" && $check_ip_exists == 1){
	$user_id	= 0;
	$user_id = checkLogin($username, $password);
	if($user_id != 0){
		$isAdmin		= 0;
		$db_isadmin	= new db_query("SELECT adm_isadmin, lang_id FROM admin_user WHERE adm_id = " . $user_id);
		$row			= mysqli_fetch_assoc($db_isadmin->result);
		if($row["adm_isadmin"] != 0) $isAdmin = 1;
		//Set SESSION
		$_SESSION["Logged"]			= 1;
		$_SESSION["logged"]			= 1;
		$_SESSION["user_id"]			= $user_id;
		$_SESSION["userlogin"]		= $username;
		$_SESSION["password"]		= md5($password);
		$_SESSION["isAdmin"]			= $isAdmin;
		$_SESSION["lang_id"]			= $row["lang_id"];
		unset($db_isadmin);
	}
}

//Check logged
$logged = getValue("logged", "int", "SESSION", 0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
if($logged == 1){
?>
	<script language="javascript">
   	window.parent.location.href="index.php";
   </script>
<?
}
?>
<title><?=translate_text("Management website")?></title>
<style type="text/css">
	html { height: 100%; }

body{
	min-height: 100%;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 22px;
	position: relative;
	background: url("resource/images/body.jpg") left top repeat;
	display: block;
}
.forumlogin *{
	font:Verdana, Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#333333;
}
.forumlogin input{ border:solid 1px #CCCCCC}

.header a{ color:#FFFFFF; text-decoration:none; font-weight:normal}
	/**
	 *	Basic Layout Theme
	 */
	.ui-layout-pane { /* all 'panes' */
		border: 1px solid #99BBE8;
	}
	.ui-layout-pane-center { /* IFRAME pane */
		padding: 0;
		margin:  0;
	}
	.ui-layout-pane-west { /* west pane */
		padding: 0px;
		background-color: #f9f9f9 !important;
		overflow: auto;
	}

	.ui-layout-resizer { /* all 'resizer-bars' */
		background: #DDD;
		}
		.ui-layout-resizer-open:hover { /* mouse-over */
			background: #9D9;
		}

	.ui-layout-toggler { /* all 'toggler-buttons' */
		background: #FF0000;
		}
		.ui-layout-toggler-closed { /* closed toggler-button */
			background: #CCC;
			border-bottom: 1px solid #BBB;
		}
		.ui-layout-toggler .content { /* toggler-text */
			font: 14px bold Verdana, Verdana, Arial, Helvetica, sans-serif;
		}
		.ui-layout-toggler:hover { /* mouse-over */
			background: #DFE8F6;
			}
			.ui-layout-toggler:hover .content { /* mouse-over */
				color: #009;
				}

	/* class to make the 'iframe mask' visible */
	.ui-layout-mask {
		opacity: 0.2 !important;
		filter:	 alpha(opacity=20) !important;
		background-color: #666 !important;
	}


	body .ui-layout-center *{
		background-color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
	}
	body .ui-layout-north *{
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
	}

.loginBox {
	width: 340px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-top: -133px;
	margin-left: -150px;
	background: #F9F9F9;
	border: 1px solid #CCC;
	border-radius: 3px;
	box-shadow: 0px 1px 6px rgba(67, 101, 139, 0.35);
}
.loginBox .loginHead {
	background: url("resource/images/header.jpg") left top repeat-x;
	padding: 9px 10px 10px;
	margin-bottom: 10px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	color: #FFFFFF;
	font-weight: bold;
}
.loginBox .loginContent{
	padding: 10px;
}
</style>
<link rel="stylesheet" type="text/css" href="resource/css/bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="loginBox">
     <div class="loginHead" style="text-transform: uppercase;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Administrator</div>
     <div class="loginContent">
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="post" role="form">
				<input name="action" type="hidden" value="login">
				<div class="form-group">
				<label for="exampleInputEmail1">User name</label>
				<input type="text" class="form-control input-sm" id="username" name="username" placeholder="Enter username">
				</div>
				<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control input-sm" id="password" name="password" placeholder="Password">
				</div>
				<div class="form-actions">
				<button type="submit" class="btn btn-primary btn-block active" style="background-image: linear-gradient(to bottom, #5B7EA4, #486B91);">Sign in</button>
				</div>
			</form>
      </div>
   </div>
</body>
</html>
