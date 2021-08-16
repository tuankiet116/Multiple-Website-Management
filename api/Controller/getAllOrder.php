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

$order->term = trim($data->term);
if($data->order_status != null || $data->order_status != ""){
    $order->order_status = $data->order_status;
}
$res = $order->getOrder();
if($res->rowCount() > 0){
    $order_arr =[];
    while($row = $res->fetch(PDO::FETCH_ASSOC)){
        array_push($order_arr, [
            "order_id"             => $row['order_id'],
            "user_id"              => $row['user_id'],
            "order_payment_status" => $row['order_payment_status'],
            "order_payment"        => $row['order_payment'],
            "web_id"               => $row['web_id'],
            "order_request_id"     => $row['order_request_id'],
            "order_trans_id"       => $row['order_trans_id'],
            "order_sum_price"      => $row['order_sum_price'],
            "order_paytype"        => $row['order_paytype'],
            "order_datetime"       => $row['order_datetime'],
            "order_status"         => $row['order_status'],
            "user_name"            => $row['user_name'],
            "user_number_phone"    => $row['user_number_phone'],
            "user_email"           => $row['user_email'],
            "web_name"             => $row['web_name'],
            "order_reason"         => $row['order_reason'],
            "order_description"    => $row['order_description'],
            "order_suspicious"     => $row['order_suspicious'],
            "order_refund_code"    => $row['order_refund_code'],
            "order_refund_message" => $row['order_refund_message']
        ]);
    }
    http_response_code(200);
    echo json_encode([
        "result" => $order_arr,
        "code"   => 200
    ]);
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "Order Not Found!!",
        "code"     => 500
    ]);
}
?>