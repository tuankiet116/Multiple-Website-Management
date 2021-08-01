<?php
require_once("../Token/checkToken.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../config/function.php');
require_once('../objects/payment.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$payment = new Payment($db);
$data = json_decode(file_get_contents("php://input"));

if($data !== null){
    $payment->web_id         = $data->web_id;
    $payment->payment_method = $data->payment_method;
    $payment->payment_active = $data->payment_active;
}

// excute searching and get data information
$result = $payment->getAll();
if ($result->rowCount() > 0) {
    $payment_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $payment_access_key = $row['payment_access_key'] != null && $row['payment_access_key'] != "" ? "*****" : null;
        $payment_secret_key = $row['payment_secret_key'] != null && $row['payment_secret_key'] != "" ? "*****" : null;
        $payment_partner_code = $row['payment_partner_code'] != null && $row['payment_partner_code'] != "" ? "*****" : null;

        $arr_push = array(
            "payment_id"           => $row['payment_id'],
            "payment_partner_code" => $payment_partner_code,
            "payment_access_key"   => $payment_access_key,
            "payment_secret_key"   => $payment_secret_key,
            "payment_method"       => payment_method_named($row['payment_method']),
            "payment_active"       => $row['payment_active'],
            "web_name"             => $row['web_name'],
            "web_id"               => $row['web_id']
        );
        array_push($payment_arr, $arr_push);
    }
    http_response_code(200);
    echo json_encode($payment_arr);
} else {
    http_response_code(200);
    echo json_encode(array(
        "message" => "NOT FOUND",
        "code"    => 404
    ));
}
