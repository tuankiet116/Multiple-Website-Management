<?
/*
Function update cơ sở dữ liệu

$update_field 	= trường dữ liệu cần update
$update_value 	= giá trị trường cần update
$type_field		= kiểu dữ liệu trường cần update ( 0 = str, 1 = int ))
*/
function update_sql($tbl_name, $update_field, $update_value, $type_field = 0, $id, $id_value, $where_extend = "") {

	$sql				= "";
	$set_clause 	= " SET ";
	$where_clause	= " WHERE ";

	//SET
	if($type_field == 0) {
		$set_clause	.= $update_field . " = '" . $update_value . "'";
	} elseif($type_field == 1) {
		$set_clause	.= $update_field . " = " . $update_value;
	}

	//WHERE
	$where_clause		.= $id . " = " . $id_value;
	if($where_extend 	!= "") {
		$where_clause	.= " AND " . $where_extend;
	}

	//SQL
	$sql	.= " UPDATE " . $tbl_name . $set_clause . $where_clause;
	return $sql;
}
?>