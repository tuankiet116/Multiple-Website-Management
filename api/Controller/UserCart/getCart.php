<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../../config/database.php');
include_once('../../objects/userToken.php');
require_once('../../objects/cart.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$cart = new Cart($db);
$data = json_decode(file_get_contents("php://input"));
$origin = $_SERVER['HTTP_ORIGIN'];
if ($data->user_token != "" && $data->user_token != NULL && $cart->setWebID($origin) === true) {
    $cart->user_token = $data->user_token;
    $result = $cart->getCart();
    http_response_code(200);
    echo json_encode($result);
} else {
    $message = array('code' => 403, 'message' => "You need to login!");
    http_response_code(200);
    echo json_encode($message);
}
?>