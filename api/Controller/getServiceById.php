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

if(isset($data) && ($data->service_id != null || $data->service_id != "") && ($data->service_gr_id != null || $data->service_gr_id !="")){
    $service->service_id    = intval($data->service_id);
    $service->service_gr_id = intval($data->service_gr_id);

    $res = $service->getServiceById();
    if($res->rowCount() > 0){
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $result =[
            "service_id"          => $row['service_id'],
            "service_name"        => $row['service_name'],
            "service_description" => $row['service_description'],
            "service_content"     => $row['service_content'],
            "service_gr_id"       => $row['service_gr_id'],
            "service_image"       => $row['service_image']
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
            "message"  => "Service Not Found!!",
            "code"     => 500
        ]);
    }
}
?>