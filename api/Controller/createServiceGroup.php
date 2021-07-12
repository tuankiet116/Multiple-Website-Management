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

if(isset($data)){
    $service_group->web_id                  = intVal($data->web_id);
    $service_group->service_gr_name         = htmlspecialchars(trim($data->service_gr_name));
    $service_group->service_gr_description  = htmlspecialchars(trim($data->service_gr_description));

    if($data->service_gr_name == null || $data->service_gr_name == "" || $data->web_id == null || $data->web_id =""){
        http_response_code(200);
        echo json_encode([
            "message" =>"Service Group Name Or Website Not Empty!!!",
            "code"    =>500
        ]);
    }
    else{
        $message = $service_group->createServiceGroup();
        if($message === true){
            http_response_code(200);
            echo json_encode(array(
                "message" => "Create Service group Success.",
                "code"    => 200
            ));
        }
        else{
            http_response_code(200);
            echo json_encode(array(
                "message" => $message,
                "code"    => 500
            ));
        }
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "data not received",
        "code"     => 402
    ]);
}

?>