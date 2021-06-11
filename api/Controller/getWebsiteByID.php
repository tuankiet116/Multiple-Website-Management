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
$website = new Website_Config($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data)){
    // set Term property of record to read
$website->web_id = intVal($data->web_id); 

    if($website->getWebsiteByID() === true){
        //language array
        $website_array = array(
            "web_id"          => $website->web_id,
            "web_name"        => $website->web_name,
            "web_url"         => $website->web_url,
            "web_icon"        => $website->web_icon,
            "web_description" => $website->web_description
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
        echo json_encode(array("message" => "Website not found.",
                                "code" => 404));
    }
}
else{
    http_response_code(500);
    
    // tell the user product does not exist
    echo json_encode(array("message" => "Data Invalid."));
}

?>