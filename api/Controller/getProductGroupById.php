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

if(isset($data) && ($data->product_gr_id !="" || $data->product_gr_id != null)){
    $product_group->product_gr_id = intval($data->product_gr_id);
    $res = $product_group->getProductGroupById();

    if($res->rowCount() > 0){
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $result =[
            "product_gr_name"           => $row['product_gr_name'],
            "product_gr_description"    => $row['product_gr_description']
        ];

        http_response_code(200);
        echo json_encode([
            "result" => $result,
            "code"   => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message" => "Lỗi khi lấy dữ liệu!!",
            "code"    => 404
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message" => "Data Invalid ",
        "code"    => 403
    ]);
}
?>