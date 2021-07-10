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

if(isset($data) || $data->web_id !="" || $data->web_id = null){
    $service_group->web_id = intVal($data->web_id);

    $res = $service_group->getServiceGroup(true);
    if($res->rowCount() > 0){
        $result = [];
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($result, [
                "service_gr_id"             => $row['service_gr_id'],
                "service_gr_name"           => $row['service_gr_name'],
                "service_gr_description"    => $row['service_gr_description'],
                "service_gr_active"         => $row['service_gr_active'],
                "web_name"                  => $row['web_name']
            ]);
        }

        http_response_code(200);
        echo json_encode([
            "result"  => $result,
            "code"    => 200 
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message"   => "NOT FOUND SERVICE GROUP!!",
            "code"      => 404
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message"   => "Data Invalid",
        "code"      => 402
    ]);
}
?>