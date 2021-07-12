<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../objects/payment.php';
include_once '../config/database.php';
include_once '../config/function.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$payment = new Payment($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to read
$payment->payment_id = intVal($data->payment_id);
$payment->getPaymentByID();

if (isset($payment->payment_method)) {
    //language array
    $payment_array = array(
        'payment_id'           => $payment->payment_id,
        'payment_partner_code' => $payment->payment_partner_code,
        'payment_access_key'   => $payment->payment_access_key,
        'payment_secret_key'   => $payment->payment_secret_key,
        'payment_method'       => $payment->payment_method,
        'web_id'               => $payment->web_id,
        'payment_active'       => $payment->payment_active,
        'web_name'             => $payment->web_name,
        'payment_name'         => payment_method_named($payment->payment_method),
        'code'                 => 200
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($payment_array);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Payment not found."));
}
