<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../objects/categories.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';


$database = new ConfigAPI();
$db = $database->getConnection();

$categories = new Categories($db);

$data = json_decode(file_get_contents("php://input"));
$web_id = $data->web_id;

$images_background_category = array(htmlspecialchars(trim($data->image_background_category_1)), htmlspecialchars(trim($data->image_background_category_2)),
                                    htmlspecialchars(trim($data->image_background_category_3)), htmlspecialchars(trim($data->image_background_category_4)), htmlspecialchars(trim($data->image_background_category_5)));

$UploadBase64 = new upload_image();
$url_save = '../../data/image/image_categories';
$images_background_category_64 =  saveBase64($UploadBase64, $images_background_category, $url_save, 'jpg, png, svg, jpeg', 2000, 'backgroundCategory', 'backgroundCategory');

$categories->cmp_name               = htmlspecialchars($data->cmp_name);
$categories->cmp_rewrite_name       = htmlspecialchars($data->cmp_rewrite_name);
$categories->cmp_icon               = htmlspecialchars($data->cmp_icon);
$categories->cmp_background         = $images_background_category_64;
$categories->bgt_type               = htmlspecialchars($data->bgt_type);
$categories->cmp_meta_description   = htmlspecialchars($data->cmp_meta_description);
$categories->cmp_active             = htmlspecialchars(intVal($data->cmp_active));
$categories->cmp_parent_id          = htmlspecialchars($data->cmp_parent_id);
$categories->web_id                 = htmlspecialchars($data->web_id);
$categories->post_type_id           = htmlspecialchars($data->post_type_id);

// unset($message);
if($data->cmp_name == "" || $data->cmp_name == null || $data->web_id == null || $data->web_id == ""){
    echo json_encode(array(
        "message" => "Data Invalid",
        "code"    => 500
    ));
}
else{
    if($images_background_category_64 === false){
        http_response_code(200);
        echo json_encode(array(
            "message" => $UploadBase64->common_error,
            "code"    => 500
        ));
    }
    else{
        $message = $categories->creatCategories($web_id);
        if($message===true){
            echo json_encode(array(
                "message" => "Create Success Menu",
                "code"    => 200
            ));
        }
        else{
            echo json_encode(array(
                "message" => $message,
                "code"    => 500
            ));
        }
    }
}

unset($db);
unset($categories);
unset($UploadBase64);


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