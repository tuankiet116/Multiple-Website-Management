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

// prepare post object
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product_image_path = array(htmlspecialchars(trim($data->product_image_path)));

//upload image
$UploadBase64 = new upload_image();

//Save product image
$url_save = '../../data/image/product';
$image_product = saveBase64($UploadBase64, $product_image_path, $url_save, 'jpg, png, jpeg', 5000, 'Product', '');


// set Term property of record to update

$product->product_name        = htmlspecialchars(trim($data->product_name)); 
$product->product_description = htmlspecialchars(trim($data->product_description));
$product->product_image_path  = $image_product;
$product->product_price       = floatval($data->product_price);
$product->product_currency    = htmlspecialchars(trim($data->product_currency));
$product->web_id              = intVal($data->web_id);
$product->product_gr_id       = intVal($data->product_gr_id);


if($image_product === false){
    http_response_code(200);
    echo json_encode(array("message" => $UploadBase64->common_error,
                            "code"    => 500));
}
else{
    if($data->product_name == "" || $data->product_name == null || $data->web_id == "" || $data->web_id == null || $data->product_gr_id == null || $data->product_gr_id == ""){
        http_response_code(200);
            echo json_encode(array("message" => "Data Invalid", "code" => 500));
    }
    else{
        $stmt = $product -> create();
        if($stmt === true){
            http_response_code(200);
            echo json_encode(array("message" => "Create Success ", "code" => 200));
        }
        else{
            http_response_code(200);
            echo json_encode(array('message' => $stmt, 
                                    'code'    => 500,
        /*'query'   => $stmt->debugDumpParams()*/ ));
        }
    }
}

function saveBase64($UploadBase64 ,$data, $url_save, $extension_list, $limit_size, $filename = "" ,$name_prefix = ""){
    $image_url = array();

    $count = count($data);
    $stt   = 1;
    foreach($data as $value){
        if($value != '' && $value != '#' && $value != null){
            if($count > 1){
                $new_filename = $filename."_".$stt; 
                $stt++;
            }
            else{
                $new_filename = $filename;
            }
            $name = $UploadBase64->upload_base64($value, $url_save, $extension_list, $limit_size, $new_filename, $name_prefix);
            if($name === false){
                return $name;
            }
            array_push($image_url,$name);
        }
    }
    $result = implode(",", $image_url);
    return $result;
}
?>