<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once('../../objects/userToken.php');
require_once('../../objects/cart.php');
require_once('../../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$cart = new Cart($db);
$data = json_decode(file_get_contents("php://input"));
if (
    $data->user_token != "" && $data->user_token != NULL
    && $cart->setWebID($_SERVER['HTTP_ORIGIN']) === true
    && intVal($data->product_id) !== 0
) {
    $cart->user_token = $data->user_token;
    $cart->product_id = $data->product_id;
    $result = $cart->removeCart(true);
    http_response_code(200);
    echo json_encode($result);
} else {
    $message = array('code' => 403, 'message' => "You need to login!");
    http_response_code(200);
    echo json_encode($message);
}
