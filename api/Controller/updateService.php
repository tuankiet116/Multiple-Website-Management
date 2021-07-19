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
    $service->service_id          = intval($data->service_id);
    $service->service_gr_id       = intval($data->service_gr_id);
    $service->service_name        = htmlspecialchars(trim($data->service_name));
    $service->service_content     = trim($data->service_content);
    $service->service_description = htmlspecialchars(trim($data->service_description));

    if($service->service_name == null || $service->service_name == ""){
        http_response_code(200);
        echo json_encode([
            "message" => "service name empty!!",
            "code"    => 500
        ]);
    }
    else{
        $message = $service->updateService();
        if($message === true){
            http_response_code(200);
            echo json_encode([
                "message" => "Update Service Success!!",
                "code"    => 200
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
else{
    http_response_code(200);
    echo json_encode([
        "message" => "Data Invalid!",
        "code"    => 500
    ]);
}
?>