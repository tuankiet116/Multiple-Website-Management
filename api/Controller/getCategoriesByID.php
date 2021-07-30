<?php 
require_once("../Token/checkToken.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/categories.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$categories = new Categories($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data) && $data->web_id != null && $data->web_id != "" && $data->cmp_id != "" && $data->cmp_id != null){
    $web_id = $data->web_id;
    $cmp_id = $data->cmp_id;

    $result = $categories->getCateById($web_id, $cmp_id);

    if($result->rowCount()>0){
        $cateByID = $result->fetch(PDO::FETCH_ASSOC);
        http_response_code(200);
        
        echo json_encode($cateByID);
    }
    else{
        http_response_code(200);
        echo json_encode(array(
            "message" => "This Category Does Not Exist",
            "code"  => 404,
        ));
    }
}
else{
    http_response_code(200);
    echo json_encode(array(
        "message" => "Data Invalid",
        "code"  => 402
    ));
}



?>