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

if($data !== NULL && intVal($data->domain_id) != 0 && $data->domain_name != "" && $data->domain_name != NULL){
    $domain->domain_id   = htmlspecialchars($data->domain_id);
    $domain->domain_name = htmlspecialchars($data->domain_name);
    $result = $domain->update();
    if($result === true){
        http_response_code(200);
        echo json_encode(array('message'=> "Domain Update Successful.", "code" => "200"));
    }
    else{
        http_response_code(200);
        echo json_encode($result);
    }
}
else{
    http_response_code(200);
    echo json_encode(array("code" => 500, "message"=>"Missing Data"));
}
?>