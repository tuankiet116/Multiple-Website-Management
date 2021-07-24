<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../../config/database.php');
require_once('../../objects/payment.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$payment = new Payment($db);
$data = json_decode(file_get_contents("php://input"));
$origin = $_SERVER['HTTP_ORIGIN'];
if ($payment->setWebID($origin) === true) {
    $result = $payment->checkPaymentByWebID();
    http_response_code(200);
    echo json_encode($result);
} else {
    $message = array('code' => 500, 'message' => "This origin does not allow. If you're trying do something bad STOP now. We know about you. :)");
    http_response_code(500);
    echo json_encode($message);
}
?>