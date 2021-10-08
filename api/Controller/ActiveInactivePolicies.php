<?php
require_once("../Token/checkToken.php");
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../objects/policies.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();


// prepare policies object
$policies = new Policies($db);
$data = json_decode(file_get_contents("php://input"));

if (isset($data->policies_id) && isset($data->policies_active)) {
    $policies->policies_id = intVal($data->policies_id);
    $policies->policies_active = intVal($data->policies_active);
    $result = $policies->activeStatus();
    http_response_code(200);
    echo json_encode($result);
} else {
    http_response_code(200);
    echo json_encode(array(
        "message" => "Cannot Get Data Response Or Data Response Is Missing",
        "code" => 500
    ));
}

unset($policies);
unset($database);
