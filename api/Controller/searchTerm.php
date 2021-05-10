<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/website_config.php';
include_once '../config/database.php';
  
// prepare website object
$databse = new ConfigAPI();
$webconfig = new Website_Config($databse);
  
// set Term property of record to read
$webconfig->term = isset($_GET['term']) ? $_GET['term'] : die();
  
// read the details of product to be edited
$webconfig->searchTerm();
  
if($webconfig->web_name!=null){
    // create array
    $website_array = array(
        "web_id" =>  $webconfig->web_id,
        "web_name" => $webconfig->web_name,
        "web_active" => $webconfig->web_active,
        "web_url" => $webconfig->web_url,
        
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($website_array);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Website does not exist."));
}
?>