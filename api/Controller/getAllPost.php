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
if($data != null){
    if($data -> web_id != null && $data -> web_id != ""){
        $post->web_id = intVal($data->web_id);
    }
    
    if($data -> term != null && $data -> term != ""){
        $term = htmlspecialchars(trim($data->term));
        $post->term = $term;
    }

    if($data->post_type_active != null && $data->post_type_active != ""){
        $post->post_type_active = intVal($data->post_type_active);
    }

    if($data->post_active != null && $data->post_active != ""){
        $post->post_active = intVal($data->post_active);
    }
}

$stmt = $post->getAll();
$count = $stmt->rowCount();

if($count>0){
    $post_arr = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $post_array = array(
            "post_id"          => $row['post_id'],
            "post_title"       => $row['post_title'],
            "post_description" => $row['post_description'],
            "post_type_title"  => $row['post_type_title'],
            "product_name"     => $row['product_name'],
            "web_name"         => $row['web_name'],
            "post_active"      => $row['post_active'],
            "web_id"           => $row['web_id'],
            "post_type_active" => $row['post_type_active']
        );

        array_push($post_arr, $post_array);
    }
    
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($post_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Post not found.",
                            "code"   => "404"));
}
?>