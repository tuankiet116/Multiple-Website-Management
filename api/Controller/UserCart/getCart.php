<?php 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once('../../objects/userToken.php');
require_once('../../objects/cart.php');
require_once('../../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$cart = new Cart($db);
$data = json_decode(file_get_contents("php://input"));
if($data->user_token != "" && $data->user_token != NULL){
    $cart->user_token = $data->user_token;
    //Fix
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



?>