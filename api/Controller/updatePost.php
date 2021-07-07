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

// prepare post object
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post_image_background = array(htmlspecialchars(trim($data->post_image_background)));

//upload image

$post_id = $data->post_id;
$UploadBase64 = new upload_image();

//Save post image
$url_save = '../../data/image/post';
$image_post = saveBase64($UploadBase64, $post_image_background, $url_save, 'jpg, png, jpeg', 5000, 'Post', '');


// set Term property of record to update

$post->post_id               = $data->post_id;
$post->post_title            = htmlspecialchars(trim($data->post_title)); 
$post->post_description      = htmlspecialchars(trim($data->post_description));
$post->post_image_background = $image_post;
$post->post_color_background = htmlspecialchars(trim($data->post_color_background));
$post->post_meta_description = htmlspecialchars(trim($data->post_meta_description));
$post->post_rewrite_name     = htmlspecialchars(trim($data->post_rewrite_name));
$post->product_id            = intVal($data->product_id);
$post->content               = $data->content;


$count = $post -> getPostByID(false);

if($post_image_background === false){
    http_response_code(200);
    echo json_encode(array("message" => $UploadBase64->common_error,
                            "code"    => 500));
}
else{
    if($count>0){
        if(isset($post->post_id)){
            $stmt = $post -> update();
            if($stmt === true){
                http_response_code(200);
                echo json_encode(array("message" => "Update Success ", "code" => 200));
            }
            else{
                http_response_code(200);
                echo json_encode(array('message' => $stmt, 
                                       'code'    => 500,
            /*'query'   => $stmt->debugDumpParams()*/ ));
            }
        }
        else{
            http_response_code(200);
            echo json_encode(array("message" => "Post Doesn't Exist Or Something Has Broken, Contact To Admin",
                                   "code"    => 500));
        }
    }
    else{
        
        http_response_code(200);
        echo json_encode(array("message" => "Post Doesn't Exists",
                               "code"    => 500));
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