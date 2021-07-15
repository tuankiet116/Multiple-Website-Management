<?
session_start();

require_once("../functions/translate.php");
require_once("../functions/functions.php");
require_once("../classes/database.php");
//phpinfo();
$loginpath	= "login.php";
if (!isset($_SESSION["logged"])){
	redirect($loginpath);
}
else{
	if ($_SESSION["logged"] != 1){
		redirect($loginpath);
	}
}
$lang_id	= 1;
if (isset($_GET["lang_id"])) $lang_id = $_GET["lang_id"];

$lang_id			= intval($lang_id);
$db_language	= new db_query("SELECT * FROM languages WHERE lang_id = " . $lang_id);
if($row	= mysqli_fetch_assoc($db_language->result)){
	$_SESSION["lang_id"] 	= $lang_id;
}

$isAdmin	= isset($_SESSION["isAdmin"]) ? intval($_SESSION["isAdmin"]) : 0;
$loginName	= isset($_SESSION["userlogin"]) ? $_SESSION["userlogin"] : "";

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Administrator Website</title>
	<link rel="stylesheet" type="text/css" href="resource/css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="resource/css/layout.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="resource/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="resource/js/slimScroll.min.js"></script>
	<script type="text/javascript" src="resource/js/jquery.layout.js"></script>
	<script type="text/javascript" src="resource/js/jquery-ui.custom.js"></script>

	<script language="JavaScript">
		var hei = $(window).height();

		function calcHeight(id) {
			var divHeight = hei - 90;
			$("#" + id).height(divHeight);
		}

		jQuery(document).ready(function() {

			$("#test-list").sortable({
				handle: '.handle',
				axis: 'y',
				update: function() {
					var order = $('#test-list').sortable('serialize');
					$.ajax({
						url: "resource/process-sortable.php",
						type: "post",
						data: order,
						error: function() {
							alert("Lỗi load dữ liệu");
						}
					});
				}
			});

			/*----------------------------------------*/

			/* Fix lại vị trí của các panel (trai, phải, top) */
			$('body').find('#LeftPane').css('height', (hei - 45) + 'px');
			$('#LeftPaneContent').slimScroll({
				height: (hei - 70) + 'px'
			});
			//$('body').find('#RightPane').css({'top':'40px', 'left':'210px'});
			//calcHeight("LeftPane");
		});
	</script>
</head>

<body style="font-size: 11px;">
	<div class="ui-layout-north">
		<? include("resource/php/inc_header.php");?>
	</div>

	<!-- LeftPane -->
	<div id="LeftPane" class="ui-layout-west ui-widget ui-widget-content">
		<div id="LeftPaneContent">
			<? include('resource/php/inc_left.php');?>
			<span id="abc"></span>
		</div>
	</div>
	<!-- #LeftPane -->

	<!-- RightPane -->
	<div id="RightPane" class="ui-layout-center ui-helper-reset ui-widget-content" style="overflow: hidden;">
		<!-- Tabs pane -->
		<div id="tabs" class="jqgtabs">
			<ul id="title_tabs">
				<li class="active" id="tab_menu_homepage"><span class="glyphicon glyphicon-refresh" aria-hidden="true" onclick="reload_iframe('idframe_homepage');" title="Reload Tab"></span>&nbsp;<a ndata="homepage" href="javascript:;" onclick="selectTabReload('homepage');" style="font-family:'Roboto';">Trang chủ</a></li>
			</ul>
			<div id="content_tabs">
				<div class="tab_frame" id="tab_homepage" style="font-size:12px; display: block;">
					<iframe id="idframe_homepage" src="resource/intro.php" frameborder="0" width="100%" height="500"></iframe>
				</div>
			</div>
		</div>
	</div>
	<!-- #RightPane -->


	<script type="text/javascript">
		function reload_iframe(id) {
			document.getElementById(id).src = document.getElementById(id).src;
		}

		function selectTab(frame_id) {
			$("#title_tabs li").removeClass("active");
			$('#tab_menu_' + frame_id).addClass('active');
			$(".tab_frame").hide();
			$("#tab_" + frame_id).show();
		}

		function selectTabReload(frame_id) {
			selectTab(frame_id);
			reload_iframe('idframe_' + frame_id);
		}

		$(".tab").click(function() {
			var obj = $(this);
			var frame_id = obj.attr("id");
			var idtab = "tab_" + frame_id;
			var frame_reload = 'idframe_' + frame_id;
			var title = '<span class="glyphicon glyphicon-refresh" aria-hidden="true" onclick="reload_iframe(\'' + frame_reload + '\')" title="Reload Tab"></span>&nbsp;<a nData="' + frame_id + '" href="javascript:;" onclick="selectTab(\'' + frame_id + '\');">' + obj.attr("rel") + '</a>&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true" onclick="removeTab(\'' + frame_id + '\');"></span>';
			var source = obj.attr("href");

			if ($("#tab_menu_" + frame_id).html() != null) {
				selectTab(frame_id);
				reload_iframe('idframe_' + frame_id);
			} else {
				$("#title_tabs").append("<li id='tab_menu_" + frame_id + "'>" + title + "</li>");
				$("#content_tabs").append("<div class='tab_frame' id='" + idtab + "'><iframe id='idframe_" + frame_id + "' src='" + source + "' frameborder='0' width='100%' onLoad=\"calcHeight('idframe_" + frame_id + "');\"></iframe></div>");
				selectTab(frame_id);
			}

			return false;
		});

		function removeTab(frame_id) {
			var frame_id_open = "";
			// Nếu không có tab nào đang mở thì tìm tab kế tiếp
			if ($("#title_tabs li.active a").attr("nData") == frame_id) {
				if ($("#tab_menu_" + frame_id).next().length > 0) {
					frame_id_open = $("#tab_menu_" + frame_id).next().find('a').attr("nData");
				} else {
					// Tìm tab cận trước
					if ($("#tab_menu_" + frame_id).prev().length > 0) {
						frame_id_open = $("#tab_menu_" + frame_id).prev().find('a').attr("nData");
					}
				}
			}
			$("#tab_menu_" + frame_id).remove();
			$("#tab_" + frame_id).remove();
			if (frame_id_open != "") {
				selectTab(frame_id_open);
			}
		}

		$(document).ready(function() {
			var swap = 0;
			$('.dropdown').click(function() {
				if (swap == 0) {
					$('.sub-container').fadeIn('fast');
					$('.sub-close').fadeIn('fast');
					swap++;
				} else {
					$('.sub-container').fadeOut('fast');
					swap--;
				}
			});

			$('.sub-close').click(function() {
				$('.sub-container').fadeOut('fast');
				$('.sub-close').fadeOut('fast');
				swap--;
			});
		});

		var nav = 0;

		function hideNav() {
			var leftContainer = document.getElementById("LeftPane");
			var rightContainer = document.getElementById("RightPane");
			if (nav == 0) {
				leftContainer.setAttribute('style', 'left:-200px');
				rightContainer.setAttribute('style', 'margin-left:6px');
				nav++;
			} else {
				leftContainer.setAttribute('style', 'left:0');
				rightContainer.setAttribute('style', 'margin-left:205px');
				nav--;
			}
		}
	</script>
</body>

</html>