<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../../config/database.php');
include_once('../../objects/userToken.php');
require_once('../../objects/orderUser.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$order = new OrderUser($db);
$data = json_decode(file_get_contents("php://input"));
$web_url = $_SERVER['HTTP_ORIGIN'];
if($order->setWebID($web_url) === true && $data->user_token != "" && $data->user_token != null){
    $order->user_token = trim($data->user_token);
    $order->order_id   = trim($data->order_id);
    $message = $order->cancelOrderUser();
    if($message === true){
        http_response_code(200);
        echo json_encode([
            "message" => "Successful!!",
            "code"    => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message" => "Failure",
            "code"    => 403
        ]);
    }
}

?>