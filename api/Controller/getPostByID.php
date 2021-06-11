<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/post.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to read
$post->post_id = intVal($data->post_id); 
$post->getPostByID(true);

if(isset($post->post_id) && $data->post_id != null && $data->post_id != ""){
    //post array
    $post_array = array(
        "post_id"               => $post->post_id,
        "post_title"            => $post->post_title,
        "post_description"      => $post->post_description,
        "post_image_background" => $post->post_image_background,
        "post_color_background" => $post->post_color_background,
        "post_meta_description" => $post->post_meta_description,
        "post_rewrite_name"     => $post->post_rewrite_name,
        "cmp_id"                => $post->cmp_id,
        "ptd_id"                => $post->ptd_id,
        "post_type_id"          => $post->post_type_id,
        "post_datetime_create"  => $post->post_datetime_create,
        "post_datetime_update"  => $post->post_datetime_update,
        "product_id"            => $post->product_id,
        "content"               => $post->content,
        "post_active"           => $post->post_active,           
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($post_array);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Post not found."));
}
?>