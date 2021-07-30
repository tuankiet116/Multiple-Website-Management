<?php 
require_once("../Token/checkToken.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/domain.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$domain = new Domain($db);
$data   = json_decode(file_get_contents("php://input"));

$domain->domain_id = $data->domain_id;

$result = $domain->getByID();
if($result === false){
    http_response_code(200);
    echo json_encode(array('message'=> "System's got error.", "code" => "500"));
}
else{
    if($domain->domain_name != "" && $domain->domain_name != NULL){
        $domain = array(
            'domain_id'     => $domain->domain_id,
            'domain_name'   => $domain->domain_name,
            'web_id'        => $domain->web_id,
            'web_name'      => $domain->web_name,
            'domain_active' => $domain->domain_active
        );
        http_response_code(200);
        echo json_encode($domain);
    }
    else{
        http_response_code(200);
        echo json_encode(array('message'=> "NOT FOUND", "code" => "404"));
    }
}
?>