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

$domain->web_id = $data->web_id;

$stmt = $domain->getAllByWebID();
if($stmt->rowCount() == 0){
    http_response_code(200);
    echo json_encode(array('message'=> "NOT FOUND", "code" => "404"));
}
else{
    $array_domain = array();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $domain = array(
            'domain_id'     => $row['domain_id'],
            'domain_name'   => $row['domain_name'],
            'web_id'        => $row['web_id'],
            'web_name'      => $row['web_name'],
            'domain_active' => $row['domain_active']
        );
        array_push($array_domain, $domain);
    }
    http_response_code(200);
    echo json_encode($array_domain);
}
?>