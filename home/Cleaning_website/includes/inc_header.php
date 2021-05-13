<?php
require_once("../../classes/database.php");
$web_id = 'web_id = 1';

$arr_topic_parents = array();
$sql = "SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NULL AND $web_id";
$result = new db_query($sql);

if(mysqli_num_rows($result->result)>0){
    while($row = mysqli_fetch_assoc($result->result)){
        array_push($arr_topic_parents, $row);
    }
}
unset($sql, $result);

$arr_topic_child = array();
$sql = "SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NOT NULL AND $web_id";
$result = new db_query($sql);

if(mysqli_num_rows($result->result)>0){
    while($row = mysqli_fetch_assoc($result->result)){
        array_push($arr_topic_child, $row);
    }
}

$clone = $arr_topic_child;
unset($sql, $result);
$arr_parent_1 = array();



?>

<div id="menu" class="topnav">
    <div id="menu-container">
        <ul id="navbar" style="width: 100%; text-align: right;">
            <?php 
                foreach($arr_topic_parents as $key => $topic_parents){
                    if($topic_parents['cmp_has_child']==1 && $topic_parents['cmp_active'] == 1){
                        echo '
                            <li>
                                <a href="javascript:void(0)" target="_self" class="hover-navbar" style="position: relative;">
                                    '.$topic_parents['cmp_icon'].'
                                    '.$topic_parents['cmp_name'].'
                                </a>';
                        echo '  <div class="sub-content">
                                    <div class="sub-navbar"> 
                                        <table>';
                                            foreach($arr_topic_child as $key => $topic_child){
                                                if($topic_child['cmp_parent_id'] == $topic_parents['cmp_id'] && $topic_child['cmp_active']==1){
                                                    echo '
                                                        <tr>
                                                    ';
                                                        if($topic_child['cmp_has_child']==1){
                                                            echo'
                                                                <td>';
                                                            echo'        
                                                                    <a>'.$topic_child['cmp_name'].'</a>';
                                                                foreach($clone as $value){
                                                                    if($value['cmp_parent_id']==$topic_child['cmp_id']){
                                                                        echo '<a href="">'.$value['cmp_name'].'</a>';
                                                                    }
                                                                }
                                                            echo'
                                                                </td>
                                                            ';
                                                        }
                                                        else{
                                                            echo'
                                                                <td><a>'.$topic_child['cmp_name'].'</a></td>
                                                            ';
                                                        }   
                                                    echo'
                                                        </tr>
                                                    ';
                                                }
                                            }
                        echo'           </table>
                                    </div>
                                </div>
                            </li>';
                    }

                    else if ($topic_parents['cmp_has_child']== 0 && $topic_parents['cmp_active'] == 1){
                        echo '
                            <li>
                                <a href="" target="_self">
                                    '.$topic_parents['cmp_icon'].'
                                    '.$topic_parents['cmp_name'].'
                                </a>
                            </li>
                        ';
                    }
                }
            ?>
        </ul>
    </div>
    <a id="btn-navbar" href="javascript:void(0);"><i class="fas fa-bars bars-icon"></i></a>
                <!-- <?php var_dump($arr_parent_1);?> -->
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
            foreach($arr_topic_parents as $key => $topic_parents){
                
            }
        ?>

    </div>

    <div class="close-navbar"></div>
</div>