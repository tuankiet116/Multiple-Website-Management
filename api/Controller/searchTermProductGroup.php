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

$product_group->term = htmlspecialchars(trim($data->term));
$product_group->web_id = intval($data->web_id);
$stmt_search =  $product_group->searchTerm();
$num = $stmt_search->rowCount();

if($num > 0){
    $product_gr_arr =[];
    while($row = $stmt_search->fetch(PDO::FETCH_ASSOC)){
        array_push($product_gr_arr, [
            "product_gr_id"         =>$row['product_gr_id'],
            "product_gr_name"       =>$row['product_gr_name'],
            "product_gr_description"=>$row['product_gr_description'],
            "product_gr_active"     =>$row['product_gr_active'],
            "web_id"                =>$row['web_id']
        ]);
    }
    http_response_code(200);
    echo json_encode($product_gr_arr);
    echo json_encode($stmt_search->debugDumpParams());
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "Product Group Not Found!!",
        "code"     => "404"
   ]);
}

?>