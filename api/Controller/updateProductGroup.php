<?php 
require_once("../Token/checkToken.php");
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
   && ($data->product_gr_name !="" || $data->product_gr_name != null) 
   && ($data->product_gr_id !=""   || $data->product_gr_id != null))
{
    $product_group->product_gr_name        = $data->product_gr_name;
    $product_group->product_gr_id          = intval($data->product_gr_id);
    $product_group->product_gr_description = $data->product_gr_description;
    $product_group->web_id                 = $data->web_id;
    
    $message = $product_group->updateProductGroup();

    if($message===true){
        http_response_code(200);
        echo json_encode([
            "message" => "Update product Group Success!!",
            "code"    => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message" => $message,
            "code"    => 403
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "Data Invalid!",
        "code"     => 403
    ]);
}
?>