<?php
require_once("../Token/checkToken.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../config/database.php');
require_once('../objects/policies.php');
include_once '../../classes/upload.php';

$database = new ConfigAPI();
$db = $database->getConnection();

$policies = new Policies($db);
$data = json_decode(file_get_contents("php://input"));

if (
    isset($data)
    && ($data->web_id != ""         || $data->web_id != null)
    && ($data->policies_id != ""    || $data->policies_id)
    && ($data->policies_title != "" || $data->policies_title != null)
) {
    $policies_image = array(htmlspecialchars(trim($data->policies_image)));
    $UploadBase64 = new upload_image();

    //Save post image
    $url_save = '../../data/image/post';
    $policies_image = saveBase64($UploadBase64, $policies_image, $url_save, 'jpg, png, jpeg', 5000, 'policies', '');

    $policies->web_id                    = intval($data->web_id);
    $policies->policies_id               = intVal($data->policies_id);
    $policies->policies_title            = htmlspecialchars(trim($data->policies_title));
    $policies->policies_description      = htmlspecialchars(trim($data->policies_description));
    $policies->policies_meta_description = htmlspecialchars(trim($data->policies_meta_description));
    $policies->policies_content          = $data->policies_content;
    $policies->policies_image            = htmlspecialchars(trim($policies_image));
    $policies->policies_rewrite_name     = htmlspecialchars(trim($data->policies_rewrite_name));

    $message = $policies->updatePolicies();

    http_response_code(200);
    echo json_encode($message);
} else {
    http_response_code(200);
    echo json_encode([
        "message"  => "Data Invalid!",
        "code"     => 500
    ]);
}

function saveBase64($UploadBase64 ,$data, $url_save, $extension_list, $limit_size, $filename = "" ,$name_prefix = ""){
    $image_url = array();

    $count = count($data);
    $stt   = 1;
    foreach($data as $value){
        if($value != '' && $value != '#' && $value != null){
            if($count > 1){
                $new_filename = $filename."_".$stt; 
                $stt++;
            }
            else{
                $new_filename = $filename;
            }
            $name = $UploadBase64->upload_base64($value, $url_save, $extension_list, $limit_size, $new_filename, $name_prefix);
            if($name === false){
                return $name;
            }
            array_push($image_url,$name);
        }
    }
    $result = implode(",", $image_url);
    return $result;
}
