<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../objects/post.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post_image_background = array(htmlspecialchars(trim($data->post_image_background)));

$UploadBase64 = new upload_image();

$url_save = '../../data/image/post';
$post_image_background = saveBase64($UploadBase64, $post_image_background, $url_save, 'jpg, png, jpeg', 5000, 'Post', '');

// set Term property of record to create
$post->post_title            = htmlspecialchars(trim($data->post_title)); 
$post->post_description      = htmlspecialchars(trim($data->post_description));
$post->post_image_background = htmlspecialchars(trim($post_image_background));
$post->post_color_background = htmlspecialchars(trim($data->post_color_background));
$post->post_meta_description = htmlspecialchars(trim($data->post_meta_description));
$post->post_rewrite_name     = htmlspecialchars(trim($data->post_rewrite_name));
$post->cmp_id                = intVal($data->cmp_id);
$post->post_type_id          = intVal($data->post_type_id);
$post->produce_id            = intVal($data->product_id);
$post->content               = $data->content;

if($post_image_background === false){
    http_response_code(200);
    echo json_encode(array("message" => $UploadBase64->common_error,
                            "code"    => 500));
}
else{
    $message = $post->create();
    if($message === true){
        http_response_code(200);
        echo json_encode(array("message" => "Create Success", "code" => 200));
        
    }
    else{
        http_response_code(200);
        echo json_encode(array('message' => $message, 'code' => 403));
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
    return $result ;
}

?>