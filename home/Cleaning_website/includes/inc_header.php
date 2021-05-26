<?php
$arr_topic_parents = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NULL AND web_id = $web_id");
$arr_topic_child = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NOT NULL AND web_id = $web_id");
?>

<div id="menu" class="topnav">
    <div id="menu-container">
        <ul id="navbar" style="width: 100%; text-align: right;">
            <!-- <li>
                <a href="" style="font-weight: bold">TIN TỨC</a>
            </li>
            <li>
                <a href="" style="font-weight: bold">TRANG CHỦ</a>
            </li> -->
            <?php
            foreach ($arr_topic_parents as $key => $topic_parents) {
                if ($topic_parents['cmp_has_child'] == 1 && $topic_parents['cmp_active'] == 1) {
                    echo '
                            <li>
                                <a href="javascript:void(0)" target="_self" class="hover-navbar" style="position: relative;">
                                    ' . $topic_parents['cmp_icon'] . '
                                    ' . $topic_parents['cmp_name'] . '
                                </a>';
                    echo '  <div class="sub-content">
                                    <div class="sub-navbar"> 
                                        <table>';
                    foreach ($arr_topic_child as $key => $topic_child) {
                        if ($topic_child['cmp_parent_id'] == $topic_parents['cmp_id'] && $topic_child['cmp_active'] == 1) {
                            echo '
                                                    <tr>';
                            if ($topic_child['cmp_has_child'] == 1) {
                                echo '
                                                            <td>';

                                echo '                            
                                                                <a href="' . $topic_child['cmp_rewrite_name'] . '">   
                                                                    ' . $topic_child['cmp_name'] . '
                                                                </a>
                                                                    <ul class="sub-menu-1">
                                                            ';
                                foreach ($arr_topic_child as $value) {
                                    if ($value['cmp_parent_id'] == $topic_child['cmp_id'] && $value['cmp_active'] == 1) {
                                        echo '
                                                                        <li>
                                                                            <a href="' . $value['cmp_rewrite_name'] . '"> -' . $value['cmp_name'] . ' </a>
</li>  
                                                                    ';
                                    }
                                }
                                echo '
                                                                    </ul>
                                                                ';
                                echo '                     
                                                            </td>';
                            } else {
                                echo '
                                                            <td>
                                                                <a href="' . $topic_child['cmp_rewrite_name'] . '">' . $topic_child['cmp_name'] . '</a>
                                                            </td>';
                            }
                            echo '
                                                    </tr>';
                        }
                    }
                    echo '          </table>
                                    </div>
                                </div>
                            </li>';
                } else if ($topic_parents['cmp_has_child'] == 0 && $topic_parents['cmp_active'] == 1) {
                    echo '
                            <li>
                                <a href="' . $topic_parents['cmp_rewrite_name'] . '" target="_self" style="font-weight: bold">
                                    ' . $topic_parents['cmp_icon'] . '
                                    ' . $topic_parents['cmp_name'] . '
                                </a>
                            </li>
                        ';
                }
            }
            ?>
        </ul>
    </div>
    <a id="btn-navbar" href="javascript:void(0);"><i class="fas fa-bars bars-icon"></i></a>
    <div id="submenu-container">
        <div class="submenu-content">
            <a href="" target="_self">
                <div>
                    <p style="margin:0">
                        <i class="fas fa-home"></i>
                        Tin tức
                    </p>
                </div>
            </a>
        </div>
        <?php
        foreach ($arr_topic_parents as $key => $topic_parents) {
            if ($topic_parents['cmp_has_child'] == 1 && $topic_parents['cmp_active'] == 1) {
                echo '
                        <div class="submenu-content ">
                            <a href="javascript:void(0)" target="_self">
                                <div style="display: flex; align-items: center; justify-content: space-between;" class="wrap-sub-content">
                                    <p style="margin: 0">
' . $topic_parents['cmp_icon'] . '
                                        ' . $topic_parents['cmp_name'] . '
                                    </p>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </a>
                            <div class="sub-link">    
                    ';
                foreach ($arr_topic_child as $key => $topic_child) {
                    if ($topic_child['cmp_parent_id'] == $topic_parents['cmp_id'] && $topic_child['cmp_active'] == 1) {
                        echo '
                                <div>
                            ';
                        if ($topic_child['cmp_has_child'] == 1) {
                            echo '
                                        <div>
                                    ';
                            echo '
                                            <a href="' . $topic_child['cmp_rewrite_name'] . '" target="_self">
                                                <div>
                                                    ' . $topic_child['cmp_name'] . '
                                                </div>
                                            </a>
                                            <ul style="margin: 0">
                                    ';
                            foreach ($arr_topic_child as $value) {
                                if ($value['cmp_parent_id'] == $topic_child['cmp_id'] && $value['cmp_active'] == 1) {
                                    echo '
                                                    <li>
                                                        <a href="' . $value['cmp_rewrite_name'] . '" style="padding: 0">
                                                            <div style="padding-left: 80px"> -' . $value['cmp_name'] . '</div>
                                                        </a>
                                                    </li>  
                                                ';
                                }
                            }
                            echo '
                                            </ul>
                                        </div>
                                    ';
                        } else {
                            echo '
                                        <div>
                                            <a href="' . $topic_child['cmp_rewrite_name'] . '" target="_self">
                                                <div>' . $topic_child['cmp_name'] . ' </div>
                                            </a>
                                        </div>
                                    ';
                        }
                        echo '
                                </div>
                            ';
                    }
                }
                echo '
                            </div>
                        </div>
';
            } else if ($topic_parents['cmp_has_child'] == 0 && $topic_parents['cmp_active'] == 1) {
                echo '
                        <div class="submenu-content">
                            <a href="' . $topic_parents['cmp_rewrite_name'] . '" target="_self">
                                <div>
                                    <p style="margin:0">
                                        ' . $topic_parents['cmp_icon'] . '
                                        ' . $topic_parents['cmp_name'] . '
                                    </p>
                                </div>
                            </a>
                        </div>
                    ';
            }
        }
        ?>

    </div>

    <div class="close-navbar"></div>
</div>