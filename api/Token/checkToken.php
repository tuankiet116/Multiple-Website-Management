<?php
    require_once '../../vendor/autoload.php';
    require_once '../config/database.php';
    require_once '../objects/admin.php';
    // require_once("../../admin/session.php");
    use Tymon\JWTAuth\JWT;
    // $jwt = new JWT();
    session_start();
    if(!isset($_SESSION['userlogin']) || !isset($_SESSION['password'])){
        //set response code - 200 OK
        http_response_code(500);
        echo json_encode(array(
            "error" => "You Do Not Have Access!"
        ));
        exit;
    }
    else{

        $database = new ConfigAPI();
        $db = $database->getConnection();

        $check = new Admin($db);
        $check->username = $_SESSION['userlogin'];
        $check->password = $_SESSION['password'];
        $result = $check->checkLoginAdmin();
        if($result === true){
            return;
        }
        else{
            //set response code - 200 OK
            http_response_code(500);
            echo json_encode(array(
                "error" => "You Do Not Have Access!"
            ));
            exit;
        }
    }
?>