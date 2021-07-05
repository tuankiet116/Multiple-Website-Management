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

if(isset($data) && $data->web_id != null && $data->web_id != ""){
    $product_group->web_id = intval($data->web_id);
    $res = $product_group->getProductGroupById();

    if($res->rowCount() > 0){
        $result = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($result, [
                "product_gr_id"          => $row['product_gr_id'],
                "product_gr_name"        => $row['product_gr_name'],
                "product_gr_description" => $row['product_gr_description'],
                "product_gr_active"      => $row['product_gr_active']
            ]);
        }
        http_response_code(200);
        echo json_encode($result);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message" => "chưa có nhóm sản phảm",
            "code"    => 404
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message" => "Data Invalid",
        "code"    => 402
    ]);
}
?>