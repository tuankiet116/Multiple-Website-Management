<?php
require_once("lang.php");
$q = getValue("q", "str", "GET", "");
$students = array();
$result = new db_query("SELECT use_name,use_id,use_code FROM users WHERE use_name LIKE '%{$q}%' LIMIT 0,5");
while($row = mysqli_fetch_assoc($result->result)){
    $students[] = $row;
}

echo json_encode($students);
