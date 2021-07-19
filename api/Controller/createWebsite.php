<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once('../objects/website_config.php');
require_once('../config/database.php');
require_once('../../classes/upload.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$website = new Website_Config($db);

$data = json_decode(file_get_contents("php://input"));

$UploadBase64 = new upload_image();
$url_save = '../../data/web_icon/icon';

if(isset($data)){
    $web_icon = array(htmlspecialchars(trim($data->web_icon)));
    $web_icon_base_64 = saveBase64($UploadBase64, $web_icon, $url_save, 'jpg, png, svg, jpeg', 2000, 'icon_web', 'icon_web');

    $website->web_name        = $data->web_name;
    $website->web_icon        = $web_icon_base_64;
    $website->web_description = $data->web_description;
    if($data->web_name == null || $data->web_name == ""){
        http_response_code(200);
        echo json_encode(array(
            "message" => "Data Invalid",
            "code"    => 500
        ));
    }
    else{
        $message = $website->createWebsite();
        if($message === true){
            http_response_code(200);
            echo json_encode(array(
                "message" => "Create Website Success.",
                "code"    => 200
            ));
        }
        else{
            http_response_code(200);
            echo json_encode(array(
                "message" => $message,
                "code"    => 500
            ));
        }
    
        if($web_icon_base_64 === false){
            http_response_code(200);
            echo json_encode(array(
                "message" => $UploadBase64->common_error,
                "code"    => 500
            ));
        }
    }
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
?>