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
    // $order->order_status = intval($data->order_status);
    $res = $order->getOrderByUser(true);
    
    if($res->rowCount() > 0){
        $arr_order = [];
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $arr_detail =[];
            $order->order_id = $row['order_id'];
            $order_detail = $order->getOrderDetail();
            while($row1 = $order_detail->fetch(PDO::FETCH_ASSOC)){
                array_push($arr_detail, [
                    "order_detail_id"         => $row1['order_detail_id'],
                    "product_id"              => $row1['product_id'],
                    "order_detail_quantity"   => $row1['order_detail_quantity'],
                    "order_detail_unit_price" => $row1['order_detail_unit_price'],
                    "order_detail_amount"     => $row1['order_detail_amount'],
                    "product_name"            => $row1['product_name'],
                    "product_currency"        => $row1['product_currency'],
                    "product_image_path"      => $row1['product_image_path']
                ]);
            }
            array_push($arr_order, [
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
                "order_reason"         => $row['order_reason'],
                "order_description"    => $row['order_description'],
                "order_detail"         => $arr_detail
            ]);
        }
        http_response_code(200);
        echo json_encode([
            'result' => $arr_order,
            'code'   => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message"  => "Order Empty!",
            "code"     => 404
        ]);
    }  
}
?>