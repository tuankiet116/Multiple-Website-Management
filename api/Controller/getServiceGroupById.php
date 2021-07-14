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

if(isset($data) && ($data->service_gr_id != null || $data->service_gr_id != "")){
    $service_group->service_gr_id = intval($data->service_gr_id);

    $res = $service_group->getServiceGroupById();

    if($res->rowCount()>0){
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $result =[
            "service_gr_name"        => $row['service_gr_name'],
            "service_gr_description" => $row['service_gr_description']
        ];
        http_response_code(200);
        echo json_encode([
            "result" => $result,
            "code"   => 200
        ]);
    }
    else{
        http_response_code(200);
        echo json_encode([
            "message" => "Cannot get data",
            "code"    => 404
        ]);
    }
}
else{
    http_response_code(200);
    echo json_encode([
        "message" => "Data Invalid",
        "code"    => 403
    ]);
}
?>