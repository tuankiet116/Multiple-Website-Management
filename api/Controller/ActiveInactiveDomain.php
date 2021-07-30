<?php 
require_once("../Token/checkToken.php");
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

if($data !== NULL && $data->domain_active != "" && $data->domain_active != NULL && intVal($data->domain_id) !== 0){
    $domain->domain_active = intVal(boolVal($data->domain_active));
    $domain->domain_id = intVal($data->domain_id);
    $result = $domain->ActiveInactiveDomain();
    if($result === true){
        http_response_code(200);
        echo json_encode(array('code'=>200, 'message'=>'Update Status Success'));
    }
    else{
        http_response_code(200);
        echo json_encode(array('code'=>500, 'message'=>'Cannot Update Status'));
    }
    
}
else{
    http_response_code(200);
    echo json_encode(array("code" => 400, "message"=>"Missing Data"));
}
?>