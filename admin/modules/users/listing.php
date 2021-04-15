<?php
require_once("inc_security.php");

$list = new fsDataGird($id_field,$name_field,translate_text("Danh sách Nhân Viên"));
$list->page_size = 50;
$list->add("use_picture", translate_text("Ảnh"), "picture", 1, 0);
$list->add($name_field,"Họ và Tên","string",1,1,"");
$list->add("use_code","Mã Nhân Viên","text", 0, 1, "");
$list->add("use_idnumber","Số CMND/Hộ chiếu","text", 0, 1, "");
$list->add("use_created_time", "Ngày tạo", "date_all", 1, 0);
$list->add("use_active","Duyệt","checkbox",1,0);
$list->add("resetpass","Reset Password","resetpass",0,0);
$list->add("",translate_text("Sửa"),"edit");
$list->add("", translate_text("Xóa"), "delete");
$list->ajaxedit($fs_table);


$list->addHTML('
    <div style="padding: 0px 0px 5px 5px">
        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#form_export"><i class="fa fa-file-excel-o"></i> Xuất Excel Danh sách Sinh viên</button>
        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#form_import"><i class="fa fa-file-excel-o"></i> Nhập Danh sách Sinh viên từ Excel</button>
        <a class="btn btn-xs btn-link" href="/data/excels/import_users_from_excel_example.xlsx"><i class="fa fa-download" aria-hidden="true"></i> Tải về file Excel mẫu</a>
    </div>
');

$total    = 0;
$db_count = new db_query("SELECT count(*) AS count
                         FROM " . $fs_table . "
                         WHERE use_type = " . $use_type . $list->sqlSearch());
if ($row_count = mysqli_fetch_assoc($db_count->result)) {
    $total = $row_count['count'];
}
unset($db_count);
$db_listing = new db_query("SELECT *
                             FROM " . $fs_table . "
                             WHERE use_type = " . $use_type . $list->sqlSearch() . "
                             ORDER BY " . $list->sqlSort() . $id_field . " DESC
                             " . $list->limit($total));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<?= $load_header ?>
	<?= $list->headerScript() ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<div id="listing" class="listing">
	<?= $list->showTable($db_listing, $total) ?>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>