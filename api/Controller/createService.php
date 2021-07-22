<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../config/database.php');
require_once('../objects/service.php');
require_once('../../classes/upload.php');
    

$database = new ConfigAPI();
$db = $database->getConnection();

$service = new Service($db);
$data = json_decode(file_get_contents("php://input"));

$UploadBase64 = new upload_image();
$url_save = '../../data/image/services';


if(isset($data)){
    $service_image = array(htmlspecialchars(trim($data->service_image)));
    $service_image_base_64 = saveBase64($UploadBase64, $service_image, $url_save, 'jpg, png, svg, jpeg', 2000, 'service_image', 'service_image');


    $service->service_name          = htmlspecialchars(trim($data->service_name));
    $service->service_description   = htmlspecialchars((trim($data->service_description)));
    $service->service_content       = trim($data->service_content);
    $service->service_gr_id         = intval($data->service_gr_id);
    $service->service_image         = $service_image_base_64;

    if($service->service_name == null || $service->service_name == ""){
        http_response_code(200);
        echo json_encode([
            "message" => "service name empty!!",
            "code"    => 500
        ]);
    }
    else if($service->service_gr_id == null || $service->service_gr_id ==""){
        http_response_code(200);
        echo json_encode([
            "message" => "service group empty!!",
            "code"    => 500
        ]);
    }
    else{
        $message = $service->createService();
        if($message === true){
            http_response_code(200);
            echo json_encode([
                "message"  => "Create Service Success!!",
                "code"     => 200
            ]);
        }
        else{
            http_response_code(200);
            echo json_encode([
                "message"  => $message,
                "code"     => 500
            ]);
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