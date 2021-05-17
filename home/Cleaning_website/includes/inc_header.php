<?php
require_once('../../classes/database.php');
$web_id = 'web_id = 1';

// $arr_result_parents = array();
// $sql = "SELECT * FROM categories_multi_parent WHERE cmp_child_id IS NOT NULL AND $web_id";
// $result = new db_query($sql);

// if (mysqli_num_rows($result->result) > 0) {
//     while ($row = mysqli_fetch_assoc($result->result)) {
//         array_push($arr_result_parents, $row);
//     }
// }
// unset($result, $sql);

// $arr_result_child = array();
// $sql ="SELECT cmp_id, cmp_name FROM categories_multi_parent WHERE cmp_child_id IS NULL AND $web_id";
// $result = new db_query($sql);

// if(mysqli_num_rows($result->result)> 0 ){
//     while($row = mysqli_fetch_assoc($result->result)){
//         array_push($arr_result_child, $row);
//     }
// }

// unset($result, $sql);
// $con = $arr_result_child[3]['cmp_id'];
// $cha = explode(",", $arr_result_parents[0]['cmp_child_id']);
// // if(in_array($con, $cha)){
// //     echo 'true';
// // }
// // else {
// //     echo 'false';
// // }
$arr_topic_parents = array();
$sql = "SELECT * FROM categories_multi_parent WHERE ";


?>

<div id="menu" class="topnav">
    <div id="menu-container">
        <ul id="navbar" style="width: 100%; text-align: right;">
            <?php 
                // foreach($arr_result_parents as $key => $topic){
                //     if($topic['cmp_has_child'] == 1 && $topic['cmp_active'] == 1){
                //         $arr_child_id = explode(",", $topic['cmp_child_id']);
                //         echo '
                //             <li>
                //                 <a href="javascript:void(0)" target="_self" class="hover-navbar" style="position: relative;">
                //                     '.$topic['cmp_icon'].'
                //                     '.$topic['cmp_name'].'
                //                 </a>';
                //         echo '  <div class="sub-content">
                //                     <div class="sub-navbar"> 
                //                         <table>';
                //                 foreach($arr_result_child as $key=>$topic_child){
                //                     if(in_array($topic_child['cmp_id'], $arr_child_id)){
                                        
                //                         echo '
                //                             <tr>
                //                                 <td> <a href="./sub.php?act='.$topic_child['cmp_id'].'" target="_self"> '.$topic_child['cmp_name'].' </a> </td>
                //                             </tr>    
                //                         ';
                //                     }

                //                 }
                //         echo'           </table>
                //                     </div>
                //                 </div>
                //             </li>';
                //     }
                //     else if ($topic['cmp_has_child'] == 0 &&  $topic['cmp_active'] == 1){
                //         echo '
                //             <li>
                //                 <a href="./sub.php?act='.$topic['cmp_id'].'" target="_self">
                //                     '.$topic['cmp_icon'].'
                //                     '.$topic['cmp_name'].'
                //                 </a>
                //             </li>
                //         ';
                //     }
                // }
            ?>
        </ul>
    </div>
    <a id="btn-navbar" href="javascript:void(0);"><i class="fas fa-bars bars-icon"></i></a>

    <div id="submenu-container">
        <?php 
            // foreach($arr_result_parents as $key=>$topic){
            //     if($topic['cmp_has_child']==1){
            //         $child_id = explode(",", $topic['cmp_child_id']);
            //         $child1 = $child_id[1];
            //         $child2 = $child_id[2];

            //         $arr_result_child = array();
            //         $sql = "SELECT cmp_id, cmp_name FROM categories_multi_parent WHERE cmp_id = $child1 OR cmp_id = $child2 AND cmp_web_id = 1";
            //         $result = new db_query($sql);
            //         if (mysqli_num_rows($result->result) > 0) {
            //             while ($row = mysqli_fetch_assoc($result->result)) {
            //                 array_push($arr_result_child, $row);
            //             }
            //         }
            //         unset($sql, $result);

            //         echo '
            //             <div class="submenu-content">
            //                 <a href="javascript:void(0)" target="_self">
            //                     <div>
            //                         '.$topic['cmp_icon'].'
            //                         '.$topic['cmp_name'].'
            //                     </div>
            //                 </a>
                
            //                 <div class="sub-link">   
            //         ';
            //         foreach($arr_result_child as $key=>$sub_topic){
            //             echo '
            //                     <a href="./sub.php?act='.$sub_topic['cmp_id'].'" target="_self">
            //                         <div>'.$sub_topic['cmp_name'].' </div>
            //                     </a>
            //             ';
            //         }
            //         echo'
            //                 </div>
            //             </div>
            //         ';
            //     }
            //     else{
            //         echo'
            //             <div class="submenu-content">
            //                 <a href="./sub.php?act='.$topic['cmp_id'].'" target="_self">
            //                     <div>
            //                     '.$topic['cmp_icon'].'
            //                     '.$topic['cmp_name'].'
            //                     </div>
            //                 </a>
            //             </div>
            //         ';
            //     }
            // }
        ?>

    </div>

    <div class="close-navbar"></div>
</div>