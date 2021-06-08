<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/post_type.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$post_type = new PostType($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to read
$post_type->post_type_id = intVal($data->post_type_id);
$post_type->getPostTypeByID(true);

if(isset($post_type->post_type_id)){
    //post array
    $post_type_array = array(
        "post_type_id"               => $post_type->post_type_id,
        "post_type_title"            => $post_type->post_type_title,
        "post_type_description"      => $post_type->post_type_description,
        "post_type_show"             => $post_type->post_type_show,
        "post_type_active"           => $post_type->post_type_active,     
        "allow_show_homepage"        => $post_type->allow_show_homepage,
        "web_id"                     => $post_type->web_id,      
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($post_type_array);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Post not found."));
}
