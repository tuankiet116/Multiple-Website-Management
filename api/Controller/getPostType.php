<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/post_type.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$post_type = new PostType($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data)){
    $web_id = $data->web_id;
    
}
?>