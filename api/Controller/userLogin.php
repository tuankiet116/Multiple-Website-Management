<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/user.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
$user->user_name = $data->user_name;
$user->user_password = $data->user_password;

$stmt = $user->login();

// if($stmt === true){
//     //user array
//     $user_array = array(
//         "user_name"             => $user->user_name,
//         "user_password"         => $user->user_password
//     );

//     // set response code - 200 OK
//     http_response_code(200);

//     // make it json format
//     echo json_encode($user_array);
// }
// else{
//     // set response code - 404 Not found
//     http_response_code(404);

//     // tell the user product does not exist
//     echo json_encode(array(
//         "message" => "User not found.",
//         "code"   => "404"
//     ));
// }

if($stmt === true){
    http_response_code(200);
    echo json_encode([
        "message" => "login success",
        "code" => 200
    ]);
}
else{
    http_response_code(200);
    echo json_encode([
        "message"  => $stmt,
        "code"  => 501
    ]);
}
