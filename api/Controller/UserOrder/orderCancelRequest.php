<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once('../../objects/userToken.php');
require_once('../../config/database.php');
require_once('../../objects/orderUser.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$order = new OrderUser($db);
$data = json_decode(file_get_contents("php://input"));
$origin = $_SERVER['HTTP_ORIGIN'];
if ($order->setWebID($origin) === true) {
    http_response_code(200);
    echo json_encode([
        "message" => "Failure",
        "code"    => 403
    ]);
    return;
    $order->user_token = $data->userToken;
    $order->order_id = $data->orderId;
    $result = $order->createRequestCancel();
    http_response_code(200);
    echo json_encode($result);
} else {
    $message = array('code' => 500, 'message' => "This origin does not allow. If you're trying do something bad STOP now. We know about you. :)");
    http_response_code(403);
    echo json_encode($message);
}
?>