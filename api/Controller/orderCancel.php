<?php
require_once("../Token/checkToken.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../config/database.php');
require_once('../objects/order.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));

if (($data->order_id     != "" && $data->order_id != null) ||
    ($data->order_reason != "" && $data->order_reason != null)
) {
    $order->order_id     = trim($data->order_id);
    $order->order_reason = intval($data->order_reason);
    $result = $order->cancelAndRefund();
    http_response_code(200);
    echo json_encode($result);
} else {
    http_response_code(200);
    echo json_encode([
        "message"  => "Data Invalid!!",
        "code"     => 403
    ]);
}
