<?php
require_once("../Token/checkToken.php");
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


// prepare post_type object
$post_type = new PostType($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($data->post_type_id) && isset($data->post_type_active)){
    $post_type->post_type_id = intVal($data->post_type_id);
    $post_type->post_type_active = intVal($data->post_type_active);
    $count = $post_type->getPostTypeByID(false);
    if($count > 0){
        if($post_type->ActiveInactivePostType()===true){
            http_response_code(200);
            echo json_encode(array("message" => "Update Status Success ", "code" => 200));
        }
        else{
            http_response_code(200);
            echo json_encode(array("message" => "Having Trouble While Active/Inactive", 
            "code" => 500));
        }
    }
    else{
        http_response_code(200);
        echo json_encode(array("message" => "Post Type Does Not Exist.", 
        "code" => 500));
    }
}
else{
    http_response_code(200);
    echo json_encode(array("message" => "Cannot Get Data Response Or Data Response Is Missing",
         "code" => 500));
}

unset($post_type);
unset($database);
?>