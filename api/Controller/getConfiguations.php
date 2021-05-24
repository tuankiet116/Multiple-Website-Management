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

// set Term property of record to read
$web_id = $data->web_id; 

// read the details of product to be edited
$result = $config->getByWebID($web_id);

if($config->con_id != null){
    //website array
    $config_arr = array(
        "con_id"                    => $config->con_id,
        "web_id"                    => $config->web_id,
        "con_admin_email"           => $config->con_admin_email,
        "con_site_title"            => $config->con_site_title,
        "con_meta_description"      => $config->con_meta_description,
        "con_meta_keyword"          => $config->con_meta_keyword,
        "con_mod_rewrite"           => $config->con_mod_rewrite,
        "con_extenstion"            => $config->con_extenstion,
        "lang_id"                   => $config->lang_id,
        "con_active_contact"        => $config->con_active_contact,
        "con_hotline"               => $config->con_hotline,
        "con_hotline_banhang"       => $config->con_hotline_banhang,
        "con_hotline_hotro_kythuat" => $config->con_hotline_hotro_kythuat,
        "con_address"               => $config->con_address,
        "con_background_homepage"   => $config->con_background_homepage,
        "con_info_payment"          => $config->con_info_payment,
        "con_fee_transport"         => $config->con_fee_transport,
        "con_contact_sale"          => $config->con_contact_sale,
        "con_info_company"          => $config->con_info_company,
        "con_logo_top"              => $config->con_logo_top,
        "con_logo_bottom"           => $config->con_logo_bottom,
        "con_page_fb"               => $config->con_page_fb,
        "con_link_fb"               => $config->con_link_fb,
        "con_link_twitter"          => $config->con_link_twitter,
        "con_link_insta"            => $config->con_link_insta,
        "con_map"                   => $config->con_map,
        "con_banner_image"          => $config->con_banner_image,
        "con_banner_title"          => $config->con_banner_title,
        "con_banner_description"    => $config->con_banner_description,
        "con_banner_active"         => $config->con_banner_active,
        "code"                      => 200
    );

    // set response code - 200 OK
    http_response_code(200);
    
    // make it json format
    echo json_encode($config_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(200);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Config not found.",
                           "code"    => 404 ));
}
?>