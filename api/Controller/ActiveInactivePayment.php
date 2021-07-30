<?php
require_once("../Token/checkToken.php");
require_once("../config/helper.php");
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

// prepare post object
$payment = new Payment($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($data->payment_id) && isset($data->payment_active)){
    $payment->payment_id     = intVal($data->payment_id);
    $payment->payment_active = intVal($data->payment_active);
    $count = $payment->getPaymentByID(false);
    if($count > 0){
        if($payment->ActiveInactivePayment()===true){
            http_response_code(200);
            echo json_encode(array("message" => "Update Status Success ", "code" => 200));
        }
        else{
            http_response_code(200);
            echo json_encode(array("message" => "Having Trouble While Active/Inactive", 
            "code" => 500));
        }
    }
    else{
        http_response_code(200);
        echo json_encode(array("message" => "Payment Does Not Exist.", 
        "code" => 500));
    }
}
else{
    http_response_code(200);
    echo json_encode(array("message" => "Cannot Gets Data Response Or Data Response Is Missing",
         "code" => 500));
}

unset($post);
unset($database);
?>