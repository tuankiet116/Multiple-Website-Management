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

//Save Image Hompage Background
$url_save = '../../data/image/image_background_homepage/';
$image_background = saveBase64($image_homepage_background, $url_save, 'jpg, png', 2000, '', 'Background_HomePage');

//Save Logo Top
$url_save = '../../data/image/Logo_Top';
$logo_top = saveBase64($logo_top_data, $url_save, 'jpg, png, svg', 2000, '', 'LogoTop');

//Save Logo Top
$url_save = '../../data/image/Logo_Bottom';
$logo_bottom = saveBase64($logo_bottom_data, $url_save, 'jpg, png, svg', 2000, '', 'LogoBottom');

//Save Logo Top
$url_save = '../../data/image/image_banner';
$image_banner = saveBase64($image_banner_data, $url_save, 'jpg, png', 5000, '', 'Banner');


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



if(isset($config->web_id)){
    if($config -> create()){
        http_response_code(200);
        echo json_encode(array("message" => "Create Success", "code" => 200,
                                "result" => $image_background));
    }
    else{
        http_response_code(500);
        echo json_encode(array('message' => "Something has wrong", 'code' => 500));
    }
}
else{
    http_response_code(200);
    echo json_encode(array("message" => "Web ID Doesn't Exist Or Something Has Broken, Contact To Admin",
                           "code"    => 500));
}



function saveBase64($data, $url_save, $extension_list, $limit_size, $filename = "" ,$name_prefix = ""){
    $image_url = array();
    $UploadBase64 = new upload_image();

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

    foreach($data as $value){
        if($value != '' && $value != '#' && $value != null){
            $name = $UploadBase64->upload_base64($value, $url_save, $extension_list, $limit_size, $filename, $name_prefix);
            array_push($image_url,substr($name, 6));
        }
    }
    $result = implode(",", $image_url);
    return $result ;
}

?>