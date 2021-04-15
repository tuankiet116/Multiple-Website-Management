<?php
require_once("inc_security.php");

$wor_id = getValue("wor_idShift", "int", "GET", 0);


$list = new fsDataGird($id_field, $name_field, translate_text("Danh sách Ca làm việc"));
$list->page_size = 50;
/*
1: Ten truong trong bang
2: Tieu de header
3: kieu du lieu
4: co sap xep hay khong, co thi de la 1, khong thi de la 0
5: co tim kiem hay khong, co thi de la 1, khong thi de la 0
*/

$list->add("wor_idShift", translate_text("ID"), "text", 0, 1, "");
$list->add($name_field, "Tên ca", "string", 1, 1, "");
$list->add("wor_StartTime", "Bắt đầu", "text", 0, 1, "");
$list->add("wor_FinishTime", "Kết thúc", "text", 0, 1, "");
$list->add("", translate_text("Sửa"), "edit");
$list->ajaxedit($fs_table);

$total    = 0;
$db_count = new db_query("SELECT count(*) AS count
                         FROM " . $fs_table . "
                         WHERE 1" . $list->sqlSearch());
if ($row_count = mysqli_fetch_assoc($db_count->result)) {
    $total = $row_count['count'];
}
unset($db_count);
$db_listing = new db_query("SELECT *
                             FROM " . $fs_table . "
                             WHERE 1 " . $list->sqlSearch() . " AND wor_delete_flag = 0
                             ORDER BY " . $list->sqlSort() . $id_field . " DESC
                             " . $list->limit($total));

$db_detail = "SELECT lat_id, lat_idShift, lat_time_start, lat_time_finish, lat_idpunish, lat_punisher 
        	  FROM late, workshift
              WHERE wor_idShift = lat_idShift";

$db_delete = "UPDATE workshift SET wor_delete_flag = 1 WHERE wor_idShift";

$f_key = "wor_idShift";

$link_css = "../../resource/css/grid-css.css";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="../../resource/css/mycss.css">
    <?= $load_header ?>
    <?= $list->headerScript() ?>
</head>

<body class="bg" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
    <? /*---------Body------------*/ ?>
    <div id="listing" class="listing table-color2" style="padding-right: 7px">
        <?= $list->showTableDetail($db_listing, $db_detail, $db_delete, $f_key, $total) ?>
    </div>

    <? /*---------Body------------*/ ?>

</body>

</html>


