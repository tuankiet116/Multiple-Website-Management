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
if(isset($data) && $data->web_id != null && $data->web_id != ""){
    $order->web_id = trim($data->web_id);
    $order->term = trim($data->term);
    $order->order_status = intval($data->order_status);

    $res = $order->getOrder(true);

    if($res->rowCount() > 0){
        $result = [];
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($result, [
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
                "product_id"           => $row['product_id'],
                "product_name"         => $row['product_name'],
                "web_name"             => $row['web_name'],
                "order_reason"         => $row['order_reason'],
                "order_detail_quantity"   => $row['order_detail_quantity'],
                "order_detail_unit_price" => $row['order_detail_unit_price'],
                "order_detail_amount"     => $row['order_detail_amount'],
                "order_description"       => $row['order_description']
            ]);
        }

        http_response_code(200);
        echo json_encode([
            "result"  => $result,
            "code"    => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message"  => "Order Not Found!!",
            "code"     => 500
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "Data InValid!",
        "code"     => 500
    ]);
}
?>