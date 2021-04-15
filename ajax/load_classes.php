<?
define("DO_NOT_INIT_SESSION", 1);
require_once("lang.php");
ob_start("callback");

$arrReturn = array(
    'success' => 0,
    'message' => ""
);

$facultyID = getValue("facultyID","int","GET", 0);
$html   = '';
if($facultyID > 0){
    $classes = new db_query("SELECT cls_id, cls_name FROM classes WHERE cls_active = 1 AND cls_faculty_id = ". $facultyID . " ORDER BY cls_id DESC");
    $dataClasses = convert_result_set_2_array($classes->result);
    $html .= '<select class="form-control" title="Chọn Lớp" id="class_id" name="class_id" style="width:250px" size="1">';
    $html .= '<option value="">- Chọn Lớp -</option>';
    foreach ($dataClasses as $key => $value) {
        $html .= '<option value="' . $value['cls_id'] . '"> ' . $value['cls_name'] . ' </option>';
    }
    $html .= '</select>';
}
echo $html;


ob_end_flush();