<?
define("DO_NOT_INIT_SESSION", 1);
require_once("lang.php");
ob_start("callback");

$arrReturn = array(
    'success' => 0,
    'message' => ""
);

$roleID = getValue("roleID","int","GET", 0);
$html   = '';
if($roleID > 0){
    $role_employee = new db_query("SELECT rol_id, rol_name FROM role_employee WHERE rol_deleteflag = 0 ORDER BY rol_name DESC");
    $dataEmployee= convert_result_set_2_array($role_employee->result);
    $html .= '<select class="form-control" title="Chọn Chức Vụ" id="rol_id" name="rol_id" style="width:250px" size="1">';
    $html .= '<option value="">- Chọn Chức Vụ -</option>';
    foreach ($dataEmployee as $key => $value) {
        $html .= '<option value="' . $value['rol_id'] . '"> ' . $value['rol_name'] . ' </option>';
    }
    $html .= '</select>';
}
echo $html;


ob_end_flush();
