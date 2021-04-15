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
    $role_employee = new db_query("SELECT wor_idShift, wor_Name, wor_StartTime, wor_FinishTime FROM worshift 
                                WHERE wor_delete_flag = 0 AND role_id = ". $roleID . " ORDER BY wor_Name DESC");
    $dataRoleEmployee = convert_result_set_2_array($role_employee->result);
    $html .= '<select class="form-control" title="Chọn Khung Giờ Làm" id="wor_id" name="wor_id" style="width:250px" size="1">';
    $html .= '<option value="">- Chọn Khung Giờ Làm -</option>';
    foreach ($dataRoleEmployee as $key => $value) {
        $html .= '<option value="' . $value['wor_id'] . '"> ' . $value['wor_name'] . " -- Giờ Làm: ".$value['wor_StartTime'].
            " -- Giờ Kết Thúc: ".$value["wor_FinishTime"].' </option>';
    }
    $html .= '</select>';
}
echo $html;


ob_end_flush();
