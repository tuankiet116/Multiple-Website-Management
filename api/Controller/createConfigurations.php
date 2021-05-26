<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/configuations.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$config = new Configuations($db);

$data = json_decode(file_get_contents("php://input"));

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
$config->con_background_homepage   = $data->con_background_homepage;
$config->con_info_payment          = $data->con_info_payment;
$config->con_fee_transport         = $data->con_fee_transport;
$config->con_contact_sale          = $data->con_contact_sale;
$config->con_info_company          = $data->con_info_company;
$config->con_logo_top              = $data->con_logo_top;
$config->con_logo_bottom           = $data->con_logo_bottom;
$config->con_page_fb               = $data->con_page_fb;
$config->con_link_fb               = $data->con_link_fb;
$config->con_link_twitter          = $data->con_link_twitter;
$config->con_link_insta            = $data->con_link_insta;
$config->con_map                   = $data->con_map;
$config->con_banner_image          = $data->con_banner_image;
$config->con_banner_title          = $data->con_banner_title;
$config->con_banner_description    = $data->con_banner_description;
$config->con_banner_active         = $data->con_banner_active;

echo json_encode($data);

if(isset($config->web_id)){
    if($config -> create()){
        http_response_code(200);
        echo json_encode(array("message" => "Create Success", "code" => 200));
    }
    else{
        http_response_code(200);
        echo json_encode(array('message' => 'Something Wrong!', 'code' => 500));
    }
}
else{
    http_response_code(200);
    // echo json_encode(array("message" => "Web ID Doesn't Exist Or Something Has Broken, Contact To Admin",
    //                        "code" => 500,
    //                         "test" => $data->web_id));
}
?>