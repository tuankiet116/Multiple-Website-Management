<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST TYPE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../objects/user.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$signup = new User($db);

$data = json_decode(file_get_contents("php://input"));

if ($data->user_name == "" || $data->user_name == null) {
    http_response_code(200);
    $code = 3;
    echo json_encode(array(
        'message' => "Username is empty",
        'code' => $code
    ));
    return array('code' => $code, 'message' => 'Username is empty');
}else if ($data->user_password == "" || $data->user_password == null) {
    http_response_code(200);
    $code = 4;
    echo json_encode(array(
        'message' => "Password is empty",
        'code' => $code
    ));
    return array('code' => $code, 'message' => 'Password is empty');
}else if ($data->user_email == "" || $data->user_email == null) {
    http_response_code(200);
    $code = 5;
    echo json_encode(array(
        'message' => "Email is empty",
        'code' => $code
    ));
    return array('code' => $code, 'message' => 'Email is empty');
}else if ($data->user_number_phone == "" || $data->user_number_phone == null) {
    http_response_code(200);
    $code = 6;
    echo json_encode(array(
        'message' => "Phone number is empty",
        'code' => $code
    ));
    return array('code' => $code, 'message' => 'Phone number is empty');
}else if ($data->user_address == "" || $data->user_address == null) {
    http_response_code(200);
    $code = 7;
    echo json_encode(array(
        'message' => "Address is empty",
        'code' => $code
    ));
    return array('code' => $code, 'message' => 'Address is empty');
}else {
    // set Term property of record to create
    $signup->user_name          = htmlspecialchars(trim($data->user_name));
    $signup->user_password      = htmlspecialchars(trim($data->user_password));
    $signup->user_email         = htmlspecialchars(trim($data->user_email));
    $signup->user_number_phone  = intVal($data->user_number_phone);
    $signup->user_address       = htmlspecialchars(trim($data->user_address));
}

$result = $signup->signUp();

if ($result === true) {
    http_response_code(200);
    echo json_encode(array("message" => "Sign up Success", "code" => 200));
} else {
    http_response_code(200);
    echo json_encode($result);
}
