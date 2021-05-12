<?php
    require_once('../classes/database.php');

    isset($_GET['act']) ? $act = $_GET['act'] : $act = '';

    $sql = "SELECT * FROM categories_multi_parent WHERE cmp_id = $act AND cmp_child_id IS NULL AND cmp_web_id = 1";
    $result = new db_query($sql);

    if(mysqli_num_rows($result->result)> 0){
        $arr_result_post = mysqli_fetch_array($result->result, MYSQLI_ASSOC);
    }
    else {
        header('location: index.php');
    }
    unset($sql, $result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Dịch vụ vệ sinh - CleanHouse </title>
    <? include("../includes/inc_head.php") ?>
</head>
<body>
    <!--------------- HEADER --------------->

    <? include("../includes/inc_header.php"); ?>

    <!--------------- CONTENT --------------->
    <div class="main-sub">
        <div class="banner">
            <?php if($arr_result_post['bgt_type'] == 'slide'){ ?>
                <img src="https://sites.google.com/site/hinhanhdep24h/_/rsrc/1436687439788/home/hinh%20anh%20thien%20nhien%20dep%202015%20%281%29.jpeg" alt="" style="width: 100%; min-height: 400px"> 
            <?php } 
            
            else{ ?>
               <img src="https://i.pinimg.com/originals/82/e4/12/82e412763fb611b0a8eaf28b58da0856.jpg" alt="" style="width: 100%; min-height: 400px">
            <?php }?>
        </div>
        
    </div>
    <!--------------- FOOT --------------->

    <? include("../includes/inc_foot.php"); ?>
    <? include("../includes/inc_footer.php") ?>
</body>
</html>