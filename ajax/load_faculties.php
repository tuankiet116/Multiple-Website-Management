<?php
define("DO_NOT_INIT_SESSION", 1);
require_once("lang.php");
ob_start("callback");

$frmID = getValue("frmID","str","GET", "");
$schoolID = getValue("schoolID","int","GET", 0, 1);
$html   = '';
if($schoolID > 0){
	$faculties = new db_query("SELECT fac_id, fac_name FROM faculties WHERE fac_active = 1 AND fac_school_id = ". $schoolID . " ORDER BY fac_id DESC");
	$dataFaculties = convert_result_set_2_array($faculties->result);
		$html .= '<select class="form-control" title="Chọn Khoa" id="faculty_id" name="faculty_id" style="width:250px" size="1" onchange="loadClasses(\'' . $frmID . '\');">';
		$html .= '<option value="">- Chọn Khoa -</option>';
		foreach ($dataFaculties as $key => $value) {
			$html .= '<option value="' . $value['fac_id'] . '"> ' . $value['fac_name'] . ' </option>';
		}
		$html .= '</select>';
}
echo $html;

ob_end_flush();