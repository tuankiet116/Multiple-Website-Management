<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/product_group.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$product_group = new Product_group($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($data) 
   && ($data->web_id != null            || $data->web_id !='') 
   && ($data->product_gr_active != null || $data->product_gr_active !='')
   && ($data->product_gr_id != null     || $data->product_gr_id !=''))
{
    $product_group->web_id            = intval($data->web_id);
    $product_group->product_gr_active = intval($data->product_gr_active);
    $product_group->product_gr_id     = intval($data->product_gr_id);

    $message = $product_group->activeProductGroup();
    if($message === true){
        http_response_code(200);
        echo json_encode([
            "message" => "Update Status Success!!",
            "code"    => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message" => $message,
            "code"    => 500
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message" => "Data Invalid",
        "code"    => 400
    ]);
}
?>