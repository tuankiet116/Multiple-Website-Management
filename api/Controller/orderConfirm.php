<?php 
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

if(isset($data)){
    if($data->order_id !== null && $data->order_id !==""){
        $order->order_id = $data->order_id;
    }
    $message = $order->confirm();
    if($message === true){
        http_response_code(200);
        echo json_encode([
            "message" => "confirmed!!",
            "code"    => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message"  => "Some Thing Has Wrong!!",
            "code"     => 500
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "Data Invalid!!",
        "code"     => 403
    ]);
}
?>