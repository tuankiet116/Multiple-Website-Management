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

if(isset($data)){
    $service->service_name          = htmlspecialchars(trim($data->service_name));
    $service->service_description   = htmlspecialchars((trim($data->service_description)));
    $service->service_content       = trim($data->service_content);
    $service->service_gr_id         = intval($data->service_gr_id);

    if($service->service_name == null || $service->service_name == ""){
        http_response_code(200);
        echo json_encode([
            "message" => "service name empty!!",
            "code"    => 500
        ]);
    }
    else if($service->service_gr_id == null || $service->service_gr_id ==""){
        http_response_code(200);
        echo json_encode([
            "message" => "service group empty!!",
            "code"    => 500
        ]);
    }
    else{
        $message = $service->createService();
        if($message === true){
            http_response_code(200);
            echo json_encode([
                "message"  => "Create Service Success!!",
                "code"     => 200
            ]);
        }
        else{
            http_response_code(200);
            echo json_encode([
                "message"  => $message,
                "code"     => 500
            ]);
        }
    }
}
?>