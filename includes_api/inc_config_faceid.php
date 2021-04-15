<?
$groupId    = getValue("groupID", "str", "GET", "");
if($groupId > 0){
    $db_user = new db_query("SELECT use_id, use_name FROM users WHERE use_class_id=". $groupId);
    while($rowUse = mysqli_fetch_assoc($db_user->result)){
        echo $rowUse["use_id"] . "#" . $rowUse["use_name"] . "\n";
    }
    $db_user->close();
    unset($db_user);
}
?>
