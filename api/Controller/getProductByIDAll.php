<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/product.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data)){
    // set Term property of record to read
    $product->product_id = intVal($data->product_id); 

    if($product->getByIDAll()===true && isset($product->product_id)){
    //language array
        $product_array = array(
            "product_id"          => $product->product_id,
            "product_name"        => $product->product_name,
            "product_description" => $product->product_description,
            "product_image_path"  => $product->product_image_path,
            "product_price"       => $product->product_price,
            "product_currency"    => $product->product_currency,
            "web_id"              => $product->web_id,
            "product_gr_id"       => $product->product_gr_id,
            "product_gr_name"     => $product->product_gr_name
        );
    
        // set response code - 200 OK
        http_response_code(200);
    
        // make it json format
        echo json_encode($product_array);
    }
    else{
        // set response code - 404 Not found
        http_response_code(404);
    
        // tell the user product does not exist
        echo json_encode(array("message" => "Product not found."));
    }
}
else{
    http_response_code(500);
    
    // tell the user product does not exist
    echo json_encode(array("message" => "Data Invalid."));
}

?>