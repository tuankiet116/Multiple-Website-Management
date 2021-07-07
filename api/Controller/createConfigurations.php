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

$image_homepage_background = array(htmlspecialchars(trim($data->image_background_homepage_1)), 
                                    htmlspecialchars(trim($data->image_background_homepage_2)),
                                    htmlspecialchars(trim($data->image_background_homepage_3)), 
                                    htmlspecialchars(trim($data->image_background_homepage_4)), 
                                    htmlspecialchars(trim($data->image_background_homepage_5)),
                                    htmlspecialchars(trim($data->image_background_homepage_6)), 
                                    htmlspecialchars(trim($data->image_background_homepage_7)));

$logo_top_data     = array(htmlspecialchars(trim($data->image_logo_top)));
$logo_bottom_data  = array(htmlspecialchars(trim($data->image_logo_bottom)));
$image_banner_data = array(htmlspecialchars(trim($data->image_banner)));

//upload image

$web_id = $data->web_id;
$UploadBase64 = new upload_image();

//Save Image Hompage Background
$url_save = '../../data/image/image_background_homepage';
$image_background = saveBase64($UploadBase64,$image_homepage_background, $url_save, 'jpg, png, jpeg', 2000, 'Background_HomePage', 'Background_HomePage');

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
$config->web_id                    = intVal($data->web_id); 
$config->con_admin_email           = htmlspecialchars(trim($data->con_admin_email));
$config->con_site_title            = htmlspecialchars(trim($data->con_site_title));
$config->con_meta_description      = htmlspecialchars(trim($data->con_meta_description));
$config->con_meta_keyword          = htmlspecialchars(trim($data->con_meta_keyword));
$config->con_mod_rewrite           = htmlspecialchars(trim($data->con_mod_rewrite));
// $config->con_extenstion            = htmlspecialchars(trim($data->con_extenstion));
//$config->lang_id                   = htmlspecialchars(trim($data->lang_id));
$config->con_active_contact        = htmlspecialchars(trim($data->con_active_contact));
$config->con_hotline               = htmlspecialchars(trim($data->con_hotline));
$config->con_hotline_banhang       = htmlspecialchars(trim($data->con_hotline_banhang));
$config->con_hotline_hotro_kythuat = htmlspecialchars(trim($data->con_hotline_hotro_kythuat));
$config->con_address               = htmlspecialchars(trim($data->con_address));
$config->con_background_homepage   = $image_background;
$config->con_info_payment          = htmlspecialchars(trim($data->con_info_payment));
$config->con_fee_transport         = htmlspecialchars(trim($data->con_fee_transport));
$config->con_contact_sale          = htmlspecialchars(trim($data->con_contact_sale));
$config->con_info_company          = htmlspecialchars(trim($data->con_info_company));
$config->con_logo_top              = $logo_top;
$config->con_logo_bottom           = $logo_bottom;
$config->con_page_fb               = trim($data->con_page_fb);
$config->con_link_fb               = htmlspecialchars(trim($data->con_link_fb));
$config->con_link_twitter          = htmlspecialchars(trim($data->con_link_twitter));
$config->con_link_insta            = htmlspecialchars(trim($data->con_link_insta));
$config->con_map                   = trim($data->con_map);
$config->con_banner_image          = $image_banner;
$config->con_banner_title          = htmlspecialchars(trim($data->con_banner_title));
$config->con_banner_description    = htmlspecialchars(trim($data->con_banner_description));
$config->con_banner_active         = htmlspecialchars(trim($data->con_banner_active));
$config->con_rewrite_name_homepage = htmlspecialchars(trim($data->con_rewrite_name_homepage));
$config->con_active_product        = htmlspecialchars(trim($data->con_active_product));
$config->con_active_sale           = htmlspecialchars(trim($data->con_active_sale));
$config->con_active_service        = htmlspecialchars(trim($data->con_active_service));

if($data->web_id == null || $data->web_id == ""){
    http_response_code(200);
    echo json_encode(array("message" => "Data Invalid",
                                    "code"    => 500));
}
else{
    $count = $config -> getByWebID(intVal($data->web_id), false);
    if($image_background === false || $logo_top === false || $logo_bottom === false || $image_banner === false){
        http_response_code(200);
        echo json_encode(array("message" => $UploadBase64->common_error,
                                "code"    => 500));
    }
    else{
        if($count>0){
            http_response_code(200);
            echo json_encode(array("message" => "This Website Have Exists Configuration",
                                "code"    => 500));
        }
        else{
            if(isset($config->web_id)){
                if($config -> create()){
                    http_response_code(200);
                    echo json_encode(array("message" => "Create Success", "code" => 200));
                }
                else{
                    http_response_code(200);
                    echo json_encode(array('message' => "Something has wrong", 'code' => 500));
                }
            }
            else{
                http_response_code(200);
                echo json_encode(array("message" => "Web ID Doesn't Exist Or Something Has Broken, Contact To Admin",
                                    "code"    => 500));
            }
        }
    }
}
unset($db);
unset($cate);
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


    //mkdir can not be done yet!!!!
    //$result = "fail";
    // if (!file_exists("../".$url_save)) {
    //     chmod("../".$url_save, 0777);
    //     if(mkdir("../".$url_save, 0777, true)){
    //         $result = 'success';
    //     };
    // }
    // if (!file_exists("../".$url_save)) {
    //     exec ('sudo chmod ../' . $url_save . '-R 777');
    //     if(mkdir("../".$url_save, 777, true)){
    //         $result = 'success';
    //     };
    // }
?>