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
$origin = $_SERVER['HTTP_ORIGIN'];
if ($user->setWebID($origin) === true) {
    if ($data->user_token != "" && $data->user_token != NULL && $data) {
        $user->user_token        = $data->user_token;
        $user->user_email        = $data->user_email;
        $user->user_address      = $data->user_address;
        $user->user_number_phone = $data->user_number_phone;
        $result = $user->updateInformation();
        http_response_code(200);
        echo json_encode($result);
    }
    else{
        http_response_code(200);
        echo json_encode(array('message' => 'Token Expired.', 'code' => 403));
    }
}
else {
    $message = array('code' => 403403, 'message' => "This origin does not allow. If you're trying do something bad STOP now. We know about you. :)");
    http_response_code(403);
    echo json_encode($message);
}
