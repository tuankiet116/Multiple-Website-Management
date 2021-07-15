<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/website_config.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$website = new Website_Config($db);

$result = $website->getAllWebSite();

if($result->rowCount() > 0){
    $website_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $arr_push = array(
            "web_id"          => $row['web_id'],
            "web_name"        => $row['web_name'],
            "web_active"      => $row['web_active'],
            "web_icon"        => $row['web_icon'],
            "web_description" => $row['web_description'],
            "domain_name_list"=> $row['domain_name_list']
        );
        array_push($website_arr, $arr_push);
    }
    http_response_code(200);
    echo json_encode($website_arr);
}
else{
    http_response_code(200);
    echo json_encode(array(
        "message" => "chưa có website nào",
        "code"    => 404
    ));
}
?>