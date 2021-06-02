<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('../objects/categories.php');
require_once('../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$categories = new Categories($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data)){
   $web_id = $data->web_id;
   $resultCategories = $categories->getCategories($web_id);

    if($resultCategories->rowCount()>0){
        $categories_arr = array();
        while($row = $resultCategories->fetch(PDO::FETCH_ASSOC)){
            $arr_push = array(
                "cmp_id"                => $row['cmp_id'],
                "cmp_name"              => $row['cmp_name'],
                "cmp_rewrite_name"      => $row['cmp_rewrite_name'],
                "cmp_icon"              => $row['cmp_icon'],
                "cmp_has_child"         => $row['cmp_has_child'],
                "cmp_background"        => $row['cmp_background'],
                "bgt_type"              => $row['bgt_type'],
                "cmp_meta_description"  => $row['cmp_meta_description'],
                "cmp_active"            => $row['cmp_active'],
                "cmp_parent_id"         => $row['cmp_parent_id'],
                "web_id"                => $row['web_id'],
                "post_type_id"          => $row['post_type_id']
            );
            array_push($categories_arr, $arr_push);
        }
        http_response_code(200);

        echo json_encode($categories_arr);
    }
    else{
        http_response_code(200);

        echo json_encode(array("message" => "chưa có danh mục nào!!!",
                               "code"  => 404));
    }
}
else{
    http_response_code(200);
    echo json_encode(array("message" => "Không Nhận được dữ liệu!",
                           "code" => 402));
}


?>