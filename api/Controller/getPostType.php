<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/post_type.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$post_type = new PostType($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data)){
    $web_id = $data->web_id;
    $resultPostType = $post_type->getPostType($web_id);

    if($resultPostType->rowCount()>0){
        $post_type_arr = array();
        while($row = $resultPostType->fetch(PDO::FETCH_ASSOC)){
            $arr_push = array(
                "post_type_id"          => $row['post_type_id'],
                "post_type_title"       => $row['post_type_title'],
                "post_type_description" => $row['post_type_description'],
                "post_type_show"        => $row['post_type_show'],
                "post_type_active"      => $row['post_type_active'],
                "allow_show_homepage"   => $row['allow_show_homepage'],
                "web_id"                => $row['web_id']
            );
            array_push($post_type_arr, $arr_push);
        }
        http_response_code(200);
        echo json_encode($post_type_arr);
    }
    else{
        http_response_code(200);
        echo json_encode(array(
            "message" => "chưa có bài viết nào!!",
            "code"    => 404,
            "row"     => $resultPostType->rowCount(),
        ));
    }
}
else{
    http_response_code(200);
    echo json_encode(array(
            "message" => "chưa nhận được dữ liệu",
            "code"    => 404
        ));
}
?>