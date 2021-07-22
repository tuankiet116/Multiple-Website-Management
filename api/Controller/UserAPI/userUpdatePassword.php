<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once('../../objects/userToken.php');
require_once('../../objects/user.php');
require_once('../../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
if ($data->user_token != "" && $data->user_token != NULL && $data) {
    $user->user_token       = $data->user_token;
    $user->user_newpassword = $data->user_newpassword;
    $user->user_password    = $data->user_password;
    $result = $user->updatePassword();
    http_response_code(200);
    echo json_encode($result);
}
else{
    http_response_code(200);
    echo json_encode(array('message' => 'Token Expired.', 'code' => 403));
}
