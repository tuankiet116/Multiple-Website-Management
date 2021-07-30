<?php 
require_once("../Token/checkToken.php");
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

$service->term = htmlspecialchars(trim($data->term));
if($data->service_gr_id != null || $data->service_gr_id !=""){
    $service->service_gr_id = intval($data->service_gr_id);
}
if($data->service_active != null || $data->service_active !=""){
    $service->service_active = intval(boolval($data->service_active));
}
$res = $service->getAllService();
if($res->rowCount() > 0){
    $service_arr =[];
    while($row = $res->fetch(PDO::FETCH_ASSOC)){
        array_push($service_arr, [
            "service_id"             => $row['service_id'],
            "service_name"           => $row['service_name'],
            "service_description"    => $row['service_description'],
            "service_content"        => $row['service_content'],
            "service_active"         => $row['service_active'],
            "service_gr_id"          => $row['service_gr_id'],
            "service_gr_name"        => $row['service_gr_name']
        ]);
    }
    http_response_code(200);
    echo json_encode([
        "result" => $service_arr,
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
?>