<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../config/database.php');
require_once('../objects/service_group.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$service_group = new Service_group($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($data) && ($data->web_id != null || $data->web_id != "") && ($data->service_gr_id != null || $data->service_gr_id != "")){
    $service_group->service_gr_active = intval($data->service_gr_active);
    $service_group->web_id            = intval($data->web_id);
    $service_group->service_gr_id     = intval($data->service_gr_id);

    $message = $service_group->activeStatus();

    if($message === true){
        http_response_code(200);
        echo json_encode([
            "message" => "Active Service Group Success!!",
            "code"    => 200
        ]);
    }
    else{
        http_response_code(500);
        echo json_encode([
            "message" => $message,
            "code"    => 500
        ]);
    }
}
else{
    http_response_code(500);
    echo json_encode([
        "message" => "Data Invalid",
        "code"    => 403
    ]);
}
?>