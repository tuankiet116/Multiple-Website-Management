<?
require_once("lang.php");
$type   = getValue("type", "str", "GET", "");

switch($type){
    case "FaceLib.ini":
        include("../includes_api/inc_config_facelib.php");
        break;
    case "FaceIDs.txt":
        include("../includes_api/inc_config_faceid.php");
        break;
    case "FaceEmbs.csv":
        include("../includes_api/inc_config_faceemb.php");
        break;
    default:
        include("../includes_api/inc_list_group.php");
        break;
}
?>
