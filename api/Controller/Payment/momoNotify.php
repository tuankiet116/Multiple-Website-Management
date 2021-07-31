<?php
header("content-type: application/json; charset=UTF-8");
http_response_code(200); //200 - Everything will be 200 Oke

require_once('../../config/database.php');
require_once('../../objects/momoPayment.php');
$database = new ConfigAPI();
$db = $database->getConnection();

$momo = new momoCheck($db);
$result = $momo->updateAndCheckOrder($_POST);
echo json_encode($result);
?>
