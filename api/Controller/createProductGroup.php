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

if(isset($data)){
    $product_group->product_gr_name         = $data->product_gr_name;
    $product_group->product_gr_description  = $data->product_gr_description;
    $product_group->web_id                  = $data->web_id;

    if($data->product_gr_name == null || $data->product_gr_name == "" || $data->web_id == null || $data->web_id =""){
        http_response_code(200);
        echo json_encode([
            "message" =>"Product group name not empty!!!",
            "code"    =>500
        ]);
    }
    else{
        $message = $product_group->createProductGroup();
        if($message === true){
            http_response_code(200);
            echo json_encode(array(
                "message" => "Create Product group Success.",
                "code"    => 200
            ));
        }
        else{
            http_response_code(200);
            echo json_encode(array(
                "message" => $message,
                "code"    => 500
            ));
        }
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "data not received",
        "code"     => 402
    ]);
}
?>