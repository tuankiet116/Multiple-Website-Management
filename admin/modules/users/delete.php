<?
include("inc_security.php");
//check quyền them sua xoa
checkAddEdit("delete");
$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","str","POST","0");
//Delete data with ID
$db_del = new db_execute("DELETE FROM ". $fs_table ." WHERE " . $id_field . " IN(" . $record_id . ")", 1);
if($db_del->row_affect>0){
	$msg = "Có " . $db_del->row_affect . " bản ghi đã được xóa !";
	echo json_encode(array("msg"=>$msg,"status"=>"1"));
}else{
	echo json_encode(array("msg"=>"Lệnh xóa không thành công","status"=>"0"));
}
unset($db_del);
?>