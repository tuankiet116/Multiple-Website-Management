<?
@session_start();
if (!isset($_SESSION["alive"])){
	@session_regenerate_id(true);
	$_SESSION["alive"] = 1;
}
?>