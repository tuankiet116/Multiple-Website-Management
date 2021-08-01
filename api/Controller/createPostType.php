<?php
require_once("../Token/checkToken.php");
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST TYPE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../objects/post_type.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$post_type = new PostType($db);

$data = json_decode(file_get_contents("php://input"));

if($data->post_type_title == "" || $data->post_type_title == null || $data->web_id == null ) {
    http_response_code(200);
    echo json_encode(array(
        'message' => "Data Invalid",
        'code' => 500
    ));
}   
else{
    // set Term property of record to create
    $post_type->post_type_title       = htmlspecialchars(trim($data->post_type_title));
    $post_type->post_type_description = htmlspecialchars(trim($data->post_type_description));
    $post_type->post_type_show        = htmlspecialchars(trim($data->post_type_show));
    $post_type->post_type_active      = intVal($data->post_type_active);
    $post_type->allow_show_homepage   = intVal($data->allow_show_homepage);
    $post_type->web_id                = intVal($data->web_id);
    $post_type->cmp_id                = intVal($data->cmp_id);
}

$result = $post_type->create();
if($result === true){
    http_response_code(200);
    echo json_encode(array("message" => "Create Success", "code" => 200));
}
else{
    http_response_code(200);
    echo json_encode(array('message' => $result,
                             'code' => 500 ));
}

