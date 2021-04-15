<?
include("inc_security.php");
//check quyền them sua xoa
checkAddEdit("edit");
$msg            = "Lệnh duyệt không thành công";
$status         = 0;
$returnurl 		= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$type           = getValue("type", "str", "GET", "ajax_update");
$record_id		= getValue("record_id","str","POST","0");

// TH duyệt 1 người dùng
if($type == "update"){
    $record_id = getValue("record_id","int","GET",0);

    // Kiểm tra xem người dùng đã nhập những ảnh required chưa?
    $accepted = 1;
    $db_check = new db_query("SELECT *
                             FROM questions
                             LEFT JOIN users_photos ON(up_user_id = " . $record_id . " AND up_question_id = que_id)
                             WHERE que_active = 1");
    while($rowCheck = mysqli_fetch_assoc($db_check->result)){
        if($rowCheck["que_required"] == 1 && ($rowCheck["up_picture"] == "" || is_null($rowCheck["up_picture"]))){
            $accepted = 0;
            break;
        }
    }
    $db_check->close();
    unset($db_check);

    if($accepted == 0){
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">';
        echo '<div class="alert alert-danger" style="margin: 30px auto; width: 70%">';
        echo '<div>Người dùng chưa nhập đủ ảnh cần thiết. Bạn không thể duyệt ảnh cho người dùng này.</div>';
        echo '<div><a href="listing.php"><strong>Quay lại</strong></a></div>';
        echo '</div>';
        exit();
    }

}

$db_update = new db_execute("UPDATE users SET use_approved_image = 1 WHERE use_id IN(" . $record_id . ")", 1);
if($db_update->row_affect>0){
        $msg = "Có " . $db_update->row_affect . " người dùng đã đưuợc duyệt ảnh !";
        $status = 1;
}
unset($db_update);

switch($type){
    case "update":
        redirect($returnurl);
        break;
    default:
        echo json_encode(array("msg"=>$msg,"status"=>$status));
        break;
}
?>