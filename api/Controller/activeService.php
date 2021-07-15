<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../config/database.php');
require_once('../objects/service.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$service = new Service($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($data) && ($data->service_id != null || $data->service_id != "") 
                && ($data->service_active != null || $data->service_active != "")
                && ($data->service_gr_id != null || $data->service_gr_id != ""))
{
    $service->service_active = intval(boolval($data->service_active));
    $service->service_id     = intval($data->service_id);
    $service->service_gr_id  = intval($data->service_gr_id);

    $message = $service->activeStatus();

    if($message === true){
        http_response_code(200);
        echo json_encode([
            "message"  => "Active Service Success!!",
            "code"     => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message" => $message,
            "code"    => 500
        ]);
    }
}
?>