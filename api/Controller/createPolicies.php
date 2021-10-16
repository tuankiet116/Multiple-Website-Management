<?php

use GuzzleHttp\Pool;

require_once("../Token/checkToken.php");
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../objects/policies.php';
include_once '../config/database.php';
include_once '../../classes/upload.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$policies = new Policies($db);
$data = json_decode(file_get_contents("php://input"));

if ($data->policies_title == "" || $data->policies_title == null || $data->web_id == null) {
    http_response_code(200);
    echo json_encode(array(
        'message' => "Data Invalid",
        'code' => 500
    ));
} else {
    // set Term property of record to create
    $policies_image = array(htmlspecialchars(trim($data->policies_image)));
    $UploadBase64 = new upload_image();

    //Save policies image
    $url_save = '../../data/image/post';
    $policies_image = saveBase64($UploadBase64, $policies_image, $url_save, 'jpg, png, jpeg', 5000, 'policies', '');

    $policies->web_id                    = intval($data->web_id);
    $policies->policies_title            = htmlspecialchars(trim($data->policies_title));
    $policies->policies_description      = htmlspecialchars(trim($data->policies_description));
    $policies->policies_meta_description = htmlspecialchars(trim($data->policies_meta_description));
    $policies->policies_content          = $data->policies_content;
    $policies->policies_image            = htmlspecialchars(trim($policies_image));
    $policies->policies_rewrite_name     = htmlspecialchars(trim($data->policies_rewrite_name));

    $result = $policies->createPolicies();
    http_response_code(200);
    echo json_encode($result);
}

unset($UploadBase64);
unset($db);
unset($policies);

function saveBase64($UploadBase64, $data, $url_save, $extension_list, $limit_size, $filename = "", $name_prefix = "")
{
    $image_url = array();

    $count = count($data);
    $stt   = 1;
    foreach ($data as $value) {
        if ($value != '' && $value != '#' && $value != null) {
            if ($count > 1) {
                $new_filename = $filename . "_" . $stt;
                $stt++;
            } else {
                $new_filename = $filename;
            }
            $name = $UploadBase64->upload_base64($value, $url_save, $extension_list, $limit_size, $new_filename, $name_prefix);
            if ($name === false) {
                return $name;
            }
            array_push($image_url, $name);
        }
    }
    $result = implode(",", $image_url);
    return $result;
}
