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

$service_group->term = htmlspecialchars(trim($data->term));
$service_group->web_id = intval($data->web_id);
$res = $service_group->searchTerm();

if($res->rowCount() > 0){
    $service_gr_arr =[];
    while ($row = $res->fetch(PDO::FETCH_ASSOC)){
        array_push($service_gr_arr, [
            "service_gr_id"          => $row['service_gr_id'],
            "service_gr_name"        => $row['service_gr_name'],
            "service_gr_description" => $row['service_gr_description'],
            "service_gr_active"      => $row['service_gr_active'],
            "web_id"                 => $row['web_id']
        ]);
    }

    http_response_code(200);
    echo json_encode([
        "result"  => $service_gr_arr,
        "code"    => 200
    ]);
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => "Service Group Not Found!!",
        "code"     => 500
    ]);
}

?>