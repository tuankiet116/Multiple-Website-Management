<?
$groupId    = getValue("groupID", "int", "GET", "");
echo @file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "FaceEmbs_" . $groupId . ".csv");
