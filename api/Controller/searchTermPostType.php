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
$post_type->term   = $data->term; 
$post_type->cmp_id = $data->cmp_id;

$stmt_search = $post_type->searchTerm();
$num = $stmt_search->rowCount();

if($num>0){
    //website array
    $post_type_arr = array();
    
    while ($row = $stmt_search->fetch(PDO::FETCH_ASSOC)){
        
        $post_type_array = array(
            "post_type_id"          => $row['post_type_id'],
            "post_type_title"       => $row['post_type_title'],
            "post_type_description" => $row['post_type_description'],
            "post_type_show"        => $row['post_type_show'],
            "post_type_active"      => $row['post_type_active'],    
            "cmp_id"                => $row['cmp_id'],
            "post_type_term"        => $data->term
            
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
    http_response_code(200);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Post Type Not Found.",
                            "code"   => "404",
/*"test"   => $stmt_search->debugDumpParams()*/));
}
?>