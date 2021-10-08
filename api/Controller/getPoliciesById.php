<?php
require_once("../Token/checkToken.php");
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/policies.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$policies = new Policies($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to read
$policies->policies_id = $data->policies_id;
$stmt = $policies->getPoliciesById();

if(isset($policies->policies_id)){
    $policies_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $policies_array = array(
            "policies_id"               => $row['policies_id'],
            "policies_title"            => $row['policies_title'],
            "policies_description"      => $row['policies_description'],
            "policies_meta_description" => $row['policies_meta_description'],
            "policies_active"           => $row['policies_active'],
            "policies_content"          => $row['policies_content'],
            "policies_image"            => $row['policies_image'],
            "policies_term"             => $data->term

        );
        array_push($policies_arr, $policies_array);
    }
  
    // set response code - 200 OK
    http_response_code(200);
    echo json_encode(array("code"=> 200, "result"=>$policies_arr));
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    echo json_encode(array("code"=> 404, "result"=>"NOT FOUND"));
}
