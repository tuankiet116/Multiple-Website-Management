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
if($data != null){
    if($data -> web_id != null || $data -> web_id != ""){
        $post_type->web_id = intVal($data->web_id);
    }
    
    if($data -> term != null || $data -> term != ""){
        $term = htmlspecialchars(trim($data->term));
        $post_type->term = $term;
    }
}

$stmt = $post_type->getAll();
$count = $stmt->rowCount();
//$debug = $stmt->debugDumpParams();
if($count>0){
    //post_type array
    $post_type_arr = array();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $post_type_array = array(
            "post_type_id"          => $row['post_type_id'],
            "post_type_title"       => $row['post_type_title'],
            "post_type_description" => $row['post_type_description'],
            "post_type_show"        => $row['post_type_show'],
            "post_type_active"      => $row['post_type_active'],
            "allow_show_homepage"   => $row['allow_show_homepage'],
            "web_name"              => $row['web_name'],
            "cmp_name"              => $row['cmp_name'],
            "web_id"                => $row['web_id'],
            "cmp_id"                => $row['cmp_id'],
            "cmp_has_child"         => $row['cmp_has_child'],
            "cmp_active"            => $row['cmp_active'],
            "code"                  => 200
        );

        array_push($post_type_arr, $post_type_array);
    }
    
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($post_type_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Post Type not found.",
                            "code"   => "404"
                            ));
}
