<?php
require_once("../Token/checkToken.php");
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../objects/payment.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$payment = new Payment($db);
$data = json_decode(file_get_contents("php://input"));

// set Term property of record to create
$payment->payment_partner_code  = htmlspecialchars(trim($data->payment_partner_code)); 
$payment->payment_access_key    = htmlspecialchars(trim($data->payment_access_key));
$payment->payment_secret_key    = htmlspecialchars(trim($data->payment_secret_key));
$payment->payment_method        = intval($data->payment_method);
$payment->web_id                = intVal($data->web_id);

if($data->payment_method == null || $data->payment_method == "" || $data->web_id == "" || $data->web_id == null){
    http_response_code(200);
    echo json_encode(array("message" => "Data Invalid", "code" => 500));
}
else{
    $message = $payment->create();
    if($message === true){
        http_response_code(200);
        echo json_encode(array("message" => "Create Success", "code" => 200));
    }
    else{
        http_response_code(200);
        echo json_encode(array('message' => $message, 'code' => 500));
    }
}
unset($db);
unset($payment);

?>