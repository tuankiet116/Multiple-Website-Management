<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../objects/product.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();


// prepare product object
$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($data->product_id) && isset($data->product_active)){
    $product->product_id = $data->product_id;
    $product->product_active = $data->product_active;
    $count = $product->getByIDAll(false);
    if($count > 0){
        if($product->ActiveInactiveProduct()===true){
            http_response_code(200);
            echo json_encode(array("message" => "Update Success ", "code" => 200));
        }
        else{
            http_response_code(200);
            echo json_encode(array("message" => "Having Trouble While Active/Inactive", 
            "code" => 500));
        }
    }
    else{
        http_response_code(200);
        echo json_encode(array("message" => "Product Does Not Exist.", 
        "code" => 500));
    }
}
else{
    http_response_code(200);
    echo json_encode(array("message" => "Cannot Get Data Response Or Data Response Is Missing",
         "code" => 500));
}

unset($product);
unset($database);
?>