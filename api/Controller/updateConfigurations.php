<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../objects/configuations.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$config = new Configuations($db);

$data = json_decode(file_get_contents("php://input"));

$image_homepage_background = array($data->image_background_homepage_1, $data->image_background_homepage_2,
                                   $data->image_background_homepage_3, $data->image_background_homepage_4, $data->image_background_homepage_5,
                                   $data->image_background_homepage_6, $data->image_background_homepage_7);

$logo_top_data     = array($data->image_logo_top);
$logo_bottom_data  = array($data->image_logo_bottom);
$image_banner_data = array($data->image_banner);

//upload image

$web_id = $data->web_id;
$UploadBase64 = new upload_image();

//Save Image Hompage Background
$url_save = '../../data/image/image_background_homepage';
$image_background = saveBase64($UploadBase64, $image_homepage_background, $url_save, 'jpg, png, jpeg', 2000, 'Background_HomePage', 'Background_HomePage');

//Save Logo Top
$url_save = '../../data/image/logo_top';
$logo_top = saveBase64($UploadBase64, $logo_top_data, $url_save, 'jpg, png, jpeg', 2000, 'LogoTop', 'LogoTop');

//Save Logo Top
$url_save = '../../data/image/logo_bottom';
$logo_bottom = saveBase64($UploadBase64, $logo_bottom_data, $url_save, 'jpg, png, jpeg', 2000, 'LogoBottom', 'LogoBottom');

//Save Logo Top
$url_save = '../../data/image/image_banner';
$image_banner = saveBase64($UploadBase64, $image_banner_data, $url_save, 'jpg, png, jpeg', 5000, 'Banner', 'Banner');


// set Term property of record to update
$config->web_id                    = $data->web_id; 
$config->con_admin_email           = $data->con_admin_email;
$config->con_site_title            = $data->con_site_title;
$config->con_meta_description      = $data->con_meta_description;
$config->con_meta_keyword          = $data->con_meta_keyword;
$config->con_mod_rewrite           = $data->con_mod_rewrite;
$config->con_extenstion            = $data->con_extenstion;
$config->lang_id                   = $data->lang_id;
$config->con_active_contact        = $data->con_active_contact;
$config->con_hotline               = $data->con_hotline;
$config->con_hotline_banhang       = $data->con_hotline_banhang;
$config->con_hotline_hotro_kythuat = $data->con_hotline_hotro_kythuat;
$config->con_address               = $data->con_address;
$config->con_background_homepage   = $image_background;
$config->con_info_payment          = $data->con_info_payment;
$config->con_fee_transport         = $data->con_fee_transport;
$config->con_contact_sale          = $data->con_contact_sale;
$config->con_info_company          = $data->con_info_company;
$config->con_logo_top              = $logo_top;
$config->con_logo_bottom           = $logo_bottom;
$config->con_page_fb               = $data->con_page_fb;
$config->con_link_fb               = $data->con_link_fb;
$config->con_link_twitter          = $data->con_link_twitter;
$config->con_link_insta            = $data->con_link_insta;
$config->con_map                   = $data->con_map;
$config->con_banner_image          = $image_banner;
$config->con_banner_title          = $data->con_banner_title;
$config->con_banner_description    = $data->con_banner_description;
$config->con_banner_active         = $data->con_banner_active;


$count = $config -> getByWebID($data->web_id, false);

if($image_background === false || $logo_top === false || $logo_bottom === false || $image_banner === false){
    http_response_code(200);
    echo json_encode(array("message" => $UploadBase64->common_error,
                            "code"    => 500));
}
else{
    if($count>0){
        if(isset($config->web_id)){
            $stmt = $config -> update();
            if($stmt === true){
                http_response_code(200);
                echo json_encode(array("message" => "Update Success ", "code" => 200));
            }
            else{
                http_response_code(200);
                echo json_encode(array('message' => "Something has wrong while updating", 
                                       'code'    => 500,
                                       'query'   => $stmt->debugDumpParams() ));
            }
        }
        else{
            http_response_code(200);
            echo json_encode(array("message" => "Web ID Doesn't Exist Or Something Has Broken, Contact To Admin",
                                   "code"    => 500));
        }
    }
    else{
        
        http_response_code(200);
        echo json_encode(array("message" => "This Website Doesn't Exists Configuration",
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