<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/categories.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$cate = new Categories($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to read
$cate->term   = $data->term; 
$cate->web_id = $data->web_id;

$stmt_search = $cate->searchTermActive();
if($stmt_search ->execute()){
    $num = $stmt_search->rowCount();

    if($num>0){
        //website array
        $cate_arr = array();
        
        while ($row = $stmt_search->fetch(PDO::FETCH_ASSOC)){
            
            $cmp_array = array(
                "cmp_id"               => $row['cmp_id'],
                "cmp_name"             => $row['cmp_name'],
                "cmp_rewrite_name"     => $row['cmp_rewrite_name'],
                "cmp_icon"             => $row['cmp_icon'],
                "cmp_has_child"        => $row['cmp_has_child'],
                "cmp_background"       => $row['cmp_background'],
                "bgt_type"             => $row['bgt_type'],
                "cmp_meta_description" => $row['cmp_meta_description'],
                "cmp_parent_id"        => $row['cmp_parent_id'],
                "cate_term"            => $data->term
                
            );
            array_push($cate_arr, $cmp_array);
        }
    
        // set response code - 200 OK
        http_response_code(200);
    
        // make it json format
        echo json_encode($cate_arr);
    }
    else{
        // set response code - 404 Not found
        http_response_code(200);
    
        // tell the user product does not exist
        echo json_encode(array("message" => "Category not found.",
                                "code"   => "404",
    /*"test"   => $stmt_search->debugDumpParams()*/));
    }
}
else{
     // set response code - 404 Not found
     http_response_code(200);
    
     // tell the user product does not exist
     echo json_encode(array("message" => "ERROR.",
                             "code"   => "500",));
}

?>