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
$data = json_decode(file_get_contents("php://input"));

if(isset($data)){
    $website->web_active = $data->web_active;
    $website->web_id     = $data->web_id;

    $messageCheck = $website->activeStatus();
    if($messageCheck===true){
        http_response_code(200);
        echo json_encode(array(
            "message" => "Thành công",
            "code"    => 200
        ));
    }
    else{
        http_response_code(200);
        echo json_encode(array(
            "message" => $messageCheck,
            "code"    => 200
        ));
    }
}
else{
    http_response_code(200);
    echo json_encode(array(
        "message" =>"Có Gì Đó Không Đúng!!",
        "code"    => 400
    ));
}


?>