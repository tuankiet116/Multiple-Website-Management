<?php
require_once '../config/database.php';
require_once '../objects/admin.php';

session_start();
$now = time();
if (!isset($_SESSION['userlogin']) || !isset($_SESSION['password']) || isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    //set response code - 200 OK
    session_unset();
    session_destroy();
    session_start();
    http_response_code(200);
    echo json_encode(array(
        "error" => "You Do Not Have Access!",
        "code" => 403
    ));
    exit;
} else {
    $database = new ConfigAPI();
    $db = $database->getConnection();

    $check = new Admin($db);
    $check->username = $_SESSION['userlogin'];
    $check->password = $_SESSION['password'];
    $result = $check->checkLoginAdmin();
    if ($result === true) {
        return;
    } else {
        //set response code - 200 OK
        http_response_code(500);
        echo json_encode(array(
            "error" => "You Do Not Have Access!",
            "code"  => 403
        ));
        exit;
    }
}
