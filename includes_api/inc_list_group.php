<?
$arrData   = array(); //G001<Phong ban 1>;G002<Phong ban 2>;G003<Phong ban 3>;G004<Phong ban 4>
$db_group = new db_query("SELECT * FROM classes WHERE cls_active = 1");
while($row = mysqli_fetch_assoc($db_group->result)){
    $arrData[] = $row["cls_id"] . "<" . $row["cls_name"] . ">";
}
$db_group->close();
unset($db_group);

echo implode(";", $arrData);
?>