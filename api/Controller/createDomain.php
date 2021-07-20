<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/domain.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$domain = new Domain($db);
$data   = json_decode(file_get_contents("php://input"));

if($data !== NULL && $data->domain_name != "" && $data->domain_name != NULL && intVal($data->web_id) !== 0){
    $domain->domain_name = htmlspecialchars($data->domain_name);
    $domain->web_id = intVal($data->web_id);
    $result = $domain->create();
    http_response_code(200);
    echo json_encode($result);
}
else{
    http_response_code(200);
    echo json_encode(array("code" => 500, "message"=>"Missing Data"));
}
?>