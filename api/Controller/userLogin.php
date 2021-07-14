<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/userToken.php');
require_once('../objects/user.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$user->user_name = $data->user_name;
$user->user_password = $data->user_password;

$stmt = $user->login();

if($stmt === true){
    setcookie('token', $user->token, mktime()+60*60*5, "/", "greengarden.com", false, false);
    http_response_code(200);
    echo json_encode(array('data'=>$user->token, 'code'=>200));
}
else{
    echo json_encode($stmt);
}
?>