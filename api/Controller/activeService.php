<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../config/database.php');
require_once('../objects/service.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$service = new Service($db);
$data = json_decode(file_get_contents("php://input"));
?>