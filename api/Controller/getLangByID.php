<?php
// required headers

use JetBrains\PhpStorm\Language;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../objects/language.php';
include_once '../config/database.php';

//prepare database connection
$database = new ConfigAPI();
$db = $database->getConnection();

// prepare website object
$lang = new LanguageConfig($db);

$data = json_decode(file_get_contents("php://input"));

// set Term property of record to read
$lang->lang_id = $data->lang_id; 
$lang->getLangByID();

if(isset($lang->lang_name)){
    //language array
    $lang_array = array(
        "lang_id"     => $lang->lang_id,
        "lang_name"   => $lang->lang_name,
        "lang_path"   => $lang->lang_path,
        "lang_image"  => $lang->lang_image,
        "lang_domain" => $lang->lang_domain
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($lang_array);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Language not found."));
}
?>