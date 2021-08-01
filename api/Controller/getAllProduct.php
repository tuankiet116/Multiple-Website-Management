<?php
require_once("../Token/checkToken.php");
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

// set Term property of record to read
$product->term   = htmlspecialchars(trim($data->term)); 
if($data->web_id != null && $data->web_id != ""){
    $product->web_id = intVal($data->web_id);
}

if($data->product_active !== null && $data->product_active !== ""){
    $product->product_active = intVal($data->product_active);
}

$stmt_search = $product->getAll();
$num = $stmt_search->rowCount();

if($num>0){
    //website array
    $product_arr = array();
    
    while ($row = $stmt_search->fetch(PDO::FETCH_ASSOC)){
        
        $product_array = array(
            "product_id"          => $row['product_id'],
            "product_name"        => $row['product_name'],
            "product_description" => $row['product_description'],
            "product_image_path"  => $row['product_image_path'],
            "product_price"       => $row['product_price'],    
            "product_currency"    => $row['product_currency'],
            "web_id"              => $row['web_id'],  
            "product_active"      => $row['product_active'],
            "web_name"            => $row['web_name'],
            "product_term"        => $data->term,
            "product_gr_name"     => $row['product_gr_name'],
            "product_gr_active"   => $row['product_gr_active']
        );
        array_push($product_arr, $product_array);   
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(200);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product Not Found.",
                            "code"   => "404",
/*"test"   => $stmt_search->debugDumpParams()*/));
}
?>