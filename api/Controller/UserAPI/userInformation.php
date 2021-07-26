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
if($user->setWebID($origin) === true){
    if($data->user_token != "" && $data->user_token != NULL){
        $user->user_token = $data->user_token;
        $stmt = $user->getInformation();
        if ($stmt === true) {
            http_response_code(200);
            $user_infor = array('user_name'         =>$user->user_name,
                                'user_address'      => $user->user_address,
                                'user_number_phone' => $user->user_number_phone,
                                'user_email'        => $user->user_email);
            echo json_encode(array('data'=>$user_infor, 'code'=>200));
        }
        else{
            http_response_code(200);
            echo json_encode(array('message'=>'NOT FOUND', 'code'=>404));
        }
    }
}
else {
    $message = array('code' => 403403, 'message' => "This origin does not allow. If you're trying do something bad STOP now. We know about you. :)");
    http_response_code(403);
    echo json_encode($message);
}



?>