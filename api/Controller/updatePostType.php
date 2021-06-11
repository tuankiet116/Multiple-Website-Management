<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../objects/post_type.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare post object
$post_type = new PostType($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to update

$post_type->post_type_id               = intVal($data->post_type_id);
$post_type->post_type_title            = htmlspecialchars(trim($data->post_type_title));
$post_type->post_type_description      = htmlspecialchars(trim($data->post_type_description));
$post_type->post_type_show             = htmlspecialchars(trim($data->post_type_show));

$count = $post_type -> getPostTypeByID(false);

if($count>0){
    if(isset($post_type->post_type_id) && $data->post_type_id != null && $data->post_type_id != ""){
        $stmt = $post_type -> update();
        if($stmt === true){
            http_response_code(200);
            echo json_encode(array("message" => "Update Success ", "code" => 200));
        }
        else{
            http_response_code(200);
            echo json_encode(array('message' => "Something has wrong while updating", 
                                    'code'    => 500,
        /*'query'   => $stmt->debugDumpParams()*/ ));
        }
    }
    else{
        http_response_code(200);
        echo json_encode(array("message" => "Post Type Doesn't Exist Or Something Has Broken, Contact To Admin",
                                "code"    => 500));
    }
}
else{
    
    http_response_code(200);
    echo json_encode(array("message" => "Post Type Doesn't Exists",
                            "code"    => 500));
}

