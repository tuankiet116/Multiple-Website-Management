<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/website_config.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$webconfig = new Website_Config($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to read
$webconfig->term = htmlspecialchars(trim($data->term)); 

if(!isset($data)){
    $stmt_search = $webconfig->searchTerm("SELECT * FROM website_config");
    $num = $stmt_search->rowCount();
}
else{
    // read the details of product to be edited
    $stmt_search = $webconfig->searchTerm(null);
    $num = $stmt_search->rowCount();
}

if($num>0){
    //website array
    $website_arr = array();
    
    while ($row = $stmt_search->fetch(PDO::FETCH_ASSOC)){
        
        $website_array = array(
            "web_id"     => $row['web_id'],
            "web_name"   => $row['web_name'],
            "web_active" => $row['web_active'],
            "web_url"    => $row['web_url'],
            "web_icon"   => $row['web_icon'],
            "web_term"   => $data->term
            
        );
        array_push($website_arr, $website_array);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($website_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Website not found."));
}
?>