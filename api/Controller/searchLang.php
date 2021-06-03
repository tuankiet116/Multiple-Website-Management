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
$lang->term = htmlspecialchars(trim($data->term)); 

if(!isset($data)){
    $stmt_search = $lang->searchTerm("SELECT * FROM languages");
    $num = $stmt_search->rowCount();
}
else{
    // read the details of product to be edited
    $stmt_search = $lang->searchTerm(null);
    $num = $stmt_search->rowCount();
}

if($num>0){
    //website array
    $lang_arr = array();
    
    while ($row = $stmt_search->fetch(PDO::FETCH_ASSOC)){
        
        $lang_array = array(
            "lang_id"     => $row['lang_id'],
            "lang_name"   => $row['lang_name'],
            "lang_path"   => $row['lang_path'],
            "lang_image"  => $row['lang_image'],
            "lang_domain" => $row['lang_domain'],
            "lang_term"   => $data->term
            
        );
        array_push($lang_arr, $lang_array);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($lang_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Language not found."));
}
?>