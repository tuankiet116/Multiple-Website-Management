<?php
$arr_topic_parents = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NULL AND web_id = $web_id");
$arr_topic_child = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NOT NULL AND web_id = $web_id");
$arr_buy = get_data_rows("SELECT * FROM configuration WHERE web_id = $web_id");
$arr_con = get_data_row("SELECT * FROM configuration WHERE web_id = $web_id");
$web_top_icon = $get_web_icon['con_logo_top'];

?>

<div id="menu">
    <?php
        if ($get_web_icon['con_logo_top'] != "" || $get_web_icon['con_logo_top'] != null) {
            echo'
                <div id="logo">
                    <div id="logo-top">
                        <img src="' . $base_url . $web_top_icon . '" alt="logo top">
                    </div>
                </div>
            ';
        } 
        else {
            echo '';
        }
    ?>

    <ul id="navbar">
        <li>
            <a href="../index.php" target="_self">
                <span>Trang chủ </span>
            </a>
        </li>

        <?php
        foreach ($arr_topic_parents as $key => $topic_parents) { 
            if ($topic_parents['cmp_has_child'] == 1 && $topic_parents['cmp_active'] == 1) {
                $arr_child_id = explode(",", $topic_parents['cmp_has_child']);
                echo '
                        <li>
                            <a href="#" target="_self">
                                <span>' . $topic_parents['cmp_name'] . '</span>
                            </a>';
                echo '
                            <div class="sub-navbar">
                                <div class="sub-container"></div>
                                <table>';
                foreach ($arr_topic_child as $key => $topic_child) { 
                    if ($topic_child['cmp_parent_id'] == $topic_parents['cmp_id'] && $topic_child['cmp_active'] == 1) {

                        $topic_child_pt_id = $topic_child['post_type_id'];
                        $topic_child_pt = explode(",", $topic_child_pt_id);
                        $count_pt_child = count($topic_child_pt);
                        if ($count_pt_child == 1) {
                            
                            $changeUrlId = 'id=' . $topic_child['post_type_id'];

                            echo '
                                <tr>
                                    <td>
                                        <a href="../post_list/post_list.php?' . $changeUrlId . '" target="_self">
                                            <div> ' . $topic_child['cmp_name'] . ' </div>
                                        </a>
                                    </td>
                                </tr>
                            ';
                            
                        }
                        else if ($count_pt_child > 1) {
                            if ($topic_child_pt_id != "" || $topic_child_pt_id != null) {
                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                if ($mod_rewrite == 1) {
                                    if ($topic_child['cmp_rewrite_name'] != "" || $topic_child['cmp_rewrite_name'] != null) {
                                        $changeUrlName = 'name=' . $topic_child['cmp_rewrite_name'];
                                    }
                                    else if ($topic_child['cmp_rewrite_name'] == "" || $topic_child['cmp_rewrite_name'] == null) {
                                        $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                    }                    
                                } else {
                                    $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                }

                                echo '
                                    <tr>
                                        <td>
                                            <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                                <div> ' . $topic_child['cmp_name'] . ' </div>
                                            </a>
                                        </td>
                                    </tr>
                                ';
                            }
                            else if ($topic_child_pt_id == "" || $topic_child_pt_id == null) {
                                echo '
                                    <tr>
                                        <td>
                                            <a href="error.php" target="_self">
                                                <div> ' . $topic_child['cmp_name'] . ' </div>
                                            </a>
                                        </td>
                                    </tr>
                                ';
                            }
                        }
                        else if ($count_pt_child == 0) {
                            echo '
                                <tr>
                                    <td>
                                        <a href="error.php" target="_self">
                                            <div> ' . $topic_child['cmp_name'] . ' </div>
                                        </a>
                                    </td>
                                </tr>
                            ';
                        }
                    }
                }
                echo '
                                </table>
                            </div>
                        </li>
                    ';
            } 
            else if ($topic_parents['cmp_has_child'] == 0 && $topic_parents['cmp_active'] == 1) {
                $topic_cmp_id = $topic_parents['cmp_id'];
                $topic_pt_id = $topic_parents['post_type_id'];
                $topic_parents_pt = explode("," , $topic_pt_id);
                $count_pt = count($topic_parents_pt);
                
                if ($count_pt == 1) { 
                    if($topic_pt_id != "" || $topic_pt_id != null){
                        $topic_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id = $topic_pt_id");
                        $topic_post_count = get_data_rows("SELECT COUNT(*) FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id = $topic_pt_id");
                        $count_post = $topic_post_count[0]['COUNT(*)'];
                        if ($count_post == 1){
                            foreach ($topic_post as $tp) {
                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                if ($mod_rewrite == 1) {
                                    if ($tp['post_rewrite_name'] != "" || $tp['post_rewrite_name'] != null) {
                                        $changeUrlName = 'name=' . $tp['post_rewrite_name'];
                                    }
                                    else if ($tp['post_rewrite_name'] == "" || $tp['post_rewrite_name'] == null) {
                                        $changeUrlName = 'cid=' . $tp['cmp_id'];
                                    }                    
                                } else {
                                    $changeUrlName = 'cid=' . $tp['cmp_id'];
                                }

                                echo '
                                    <li>
                                        <a href="news.php?' . $changeUrlName . '" target="_self">
                                            <span>' . $topic_parents['cmp_name'] . '</span>
                                        </a>
                                    </li>
                                ';
                            }
                        }
                        else if ($count_post > 1) {
                            $topic_posts = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id = $topic_pt_id LIMIT 1");
                            foreach ($topic_posts as $tps) {
                                $changeUrlId = 'id=' . $topic_parents['post_type_id'];
        
                                echo '
                                    <li>
                                        <a href="../post_list/post_list.php?' . $changeUrlId . '" target="_self">
                                            <span>' . $topic_parents['cmp_name'] . '</span>
                                        </a>
                                    </li>
                                ';
                            }
                        }
                        else if ($count_post == 0) {
                            echo '
                                <li>
                                    <a href="error.php" target="_self">
                                        <span>' . $topic_parents['cmp_name'] . '</span>
                                    </a>
                                </li>
                            ';
                        }
                    }
                    else if ($topic_pt_id == "" || $topic_pt_id == null) {
                        echo '
                            <li>
                                <a href="error.php" target="_self">
                                    <span>' . $topic_parents['cmp_name'] . '</span>
                                </a>
                            </li>
                        ';
                    }

                }
                else if ($count_pt > 1) {
                    if ($topic_pt_id != "" || $topic_pt_id != null) {
                        $topic_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id IN ($topic_pt_id)");
                        $topic_post_count = get_data_rows("SELECT COUNT(*) FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id IN ($topic_pt_id)");
                        $count_post = $topic_post_count[0]['COUNT(*)'];
                        if ($count_post == 1) {
                            foreach ($topic_post as $tp) {
                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                if ($mod_rewrite == 1) {
                                    if ($topic_child['cmp_rewrite_name'] != "" || $topic_child['cmp_rewrite_name'] != null) {
                                        $changeUrlName = 'name=' . $topic_child['cmp_rewrite_name'];
                                    }
                                    else if ($topic_child['cmp_rewrite_name'] == "" || $topic_child['cmp_rewrite_name'] == null) {
                                        $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                    }                    
                                } else {
                                    $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                }
                                
                                echo '
                                    <li>
                                        <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                            <span>' . $topic_parents['cmp_name'] . '</span>
                                        </a>
                                    </li>
                                ';
                            }
                        } else if ($count_post > 1) {
                            $mod_rewrite = $arr_con['con_mod_rewrite'];
                            if ($mod_rewrite == 1) {
                                if ($topic_parents['cmp_rewrite_name'] != "" || $topic_parents['cmp_rewrite_name'] != null) {
                                    $changeUrlName = 'name=' . $topic_parents['cmp_rewrite_name'];
                                } 
                                else if ($topic_parents['cmp_rewrite_name'] == "" || $topic_parents['cmp_rewrite_name'] == null) {
                                    $changeUrlName = 'cid=' . $topic_parents['cmp_id'];
                                }
                            } else {
                                $changeUrlName = 'cid=' . $topic_parents['cmp_id'];
                            }

                            echo '
                                <li>
                                    <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                        <span>' . $topic_parents['cmp_name'] . '</span>
                                    </a>
                                </li>
                            ';
                        } else if ($count_post == 0) {
                            echo '
                                <li>
                                    <a href="error.php" target="_self">
                                        <span>' . $topic_parents['cmp_name'] . '</span>
                                    </a>
                                </li>
                            ';
                        }
                    }
                    else if ($topic_pt_id == "" || $topic_pt_id == null) {
                        echo '
                            <li>
                                <a href="error.php" target="_self">
                                    <span>' . $topic_parents['cmp_name'] . '</span>
                                </a>
                            </li>
                        ';
                    }
                }
                else if ($count_pt == 0) {
                    echo '
                        <li>
                            <a href="error.php" target="_self">
                                <span>' . $topic_parents['cmp_name'] . '</span>
                            </a>
                        </li>
                    ';
                }
            }
        }
        ?>
        <li>
            <a href="../shop.php" target="_self">
                <span>Báo giá sản phẩm</span>
            </a>
        </li>
    </ul>

    <a id="cart" href="../cart.php" target="_self">
        <i class="fas fa-shopping-cart"></i>
    </a>

    <div id="sub-icon">
        <i class="fas fa-bars bars-icon"></i>
    </div>
</div>

<div id="sub-menu">
    <div id="sub-menu-container">

        <a href="../index.php" target="_self">
            <div>
                Trang chủ
            </div>
        </a>

        <?php
        foreach ($arr_topic_parents as $key => $topic_parents) {
            if ($topic_parents['cmp_has_child'] == 1 && $topic_parents['cmp_active'] == 1) {
                $arr_child_id = explode(",", $topic_parents['cmp_has_child']);
                echo'
                        <a id="sub_' . $topic_parents['cmp_id'] . '" href="#" target="_self">
                            <div>
                                ' . $topic_parents['cmp_name'] . '
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </a>';
                echo'
                        <div id="sub_content_' . $topic_parents['cmp_id'] . '" class="sub-menu-content">';
                            foreach ($arr_topic_child as $key => $topic_child) {
                                if ($topic_child['cmp_parent_id'] == $topic_parents['cmp_id'] && $topic_child['cmp_active'] == 1) {
                                    $topic_child_id = $topic_child['cmp_id'];
                                    $arr_p = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_child_id LIMIT 1");

                                    $topic_child_cmp_id = $topic_child['cmp_id'];
                                    $topic_child_pt_id = $topic_child['post_type_id'];
                                    $topic_child_pt = explode(",", $topic_child_pt_id);
                                    $count_pt_child = count($topic_child_pt);
                                    if ($count_pt_child == 1) {
                                        $changeUrlId = 'id=' . $topic_child['post_type_id'];    
                                        echo '
                                            <tr>
                                                <td>
                                                    <a href="../post_list/post_list.php?' . $changeUrlId . '" target="_self">
                                                        <div> ' . $topic_child['cmp_name'] . ' </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        ';
                                        
                                    } else if ($count_pt_child > 1) {
                                        if ($topic_child_pt_id != "" || $topic_child_pt_id != null) {
                                            $topic_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_child_cmp_id AND post_active = 1 AND post_type_id IN ($topic_child_pt_id)");
                                            $mod_rewrite = $arr_con['con_mod_rewrite'];
                                            if ($mod_rewrite == 1) {
                                                if ($topic_child['cmp_rewrite_name'] != "" || $topic_child['cmp_rewrite_name'] != null) {
                                                    $changeUrlName = 'name=' . $topic_child['cmp_rewrite_name'];
                                                } else if ($topic_child['cmp_rewrite_name'] == "" || $topic_child['cmp_rewrite_name'] == null) {
                                                    $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                                }
                                            } else {
                                                $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                            }

                                            echo '
                                                <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                                    <div>' . $topic_child['cmp_name'] . '</div>
                                                </a>
                                            ';
                                        }
                                        else if ($topic_child_pt_id == "" || $topic_child_pt_id == null) {
                                            echo '
                                                <a href="error.php" target="_self">
                                                    <div>' . $topic_child['cmp_name'] . '</div>
                                                </a>
                                            ';
                                        }
                                        
                                    } else if ($count_pt_child == 0) {
                                        echo '
                                            <a href="error.php" target="_self">
                                                <div>' . $topic_child['cmp_name'] . '</div>
                                            </a>
                                        ';
                                    }
                                }
                            }
                echo '
                        </div>';
                echo'
                        <script src="../Green_website/resource/js/slideshow/jquery-3.3.1.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var m = 0;
                                $("#sub_' . $topic_parents['cmp_id'] . '").click(function () {
                                    $("#sub_content_' . $topic_parents['cmp_id'] . '").slideToggle("slow");
                                });
                                $("#sub_' . $topic_parents['cmp_id'] . '").click(function () {
                                    if (m == 0) {
                                    $("#sub-menu #sub-menu-container a#sub_' . $topic_parents['cmp_id'] . ' div i").css(
                                        "transform",
                                        "rotate(180deg)"
                                    );
                                    m++;
                                    } else {
                                    $("#sub-menu #sub-menu-container a#sub_' . $topic_parents['cmp_id'] . ' div i").css(
                                        "transform",
                                        "rotate(0deg)"
                                    );
                                    m--;
                                    }
                                });
                            });
                        </script>
                    ';
            } else if ($topic_parents['cmp_has_child'] == 0 &&  $topic_parents['cmp_active'] == 1) {    
                    
                    $topic_cmp_id = $topic_parents['cmp_id'];
                    $topic_pt_id = $topic_parents['post_type_id'];
                    $topic_parents_pt = explode(",", $topic_pt_id);
                    $count_pt = count($topic_parents_pt);
                    if ($count_pt == 1 && ($topic_pt_id != "" || $topic_pt_id != null)) {
                        $topic_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id = $topic_pt_id");
                        $topic_post_count = get_data_rows("SELECT COUNT(*) FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id = $topic_pt_id");
                        $count_post = $topic_post_count[0]['COUNT(*)'];
                        if ($count_post == 1) {
                            foreach ($topic_post as $tp) {
                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                if ($mod_rewrite == 1) {
                                    if ($tp['post_rewrite_name'] != "" || $tp['post_rewrite_name'] != null) {
                                        $changeUrlName = 'name=' . $tp['post_rewrite_name'];
                                    } else if ($tp['post_rewrite_name'] == "" || $tp['post_rewrite_name'] == null) {
                                        $changeUrlName = 'cid=' . $tp['cmp_id'];
                                    }
                                } else {
                                    $changeUrlName = 'cid=' . $tp['cmp_id'];
                                }
                                
                                echo '
                                    <div id="sub-menu-container">
                                        <a href="news.php?' . $changeUrlName . '" target="_self">
                                            <div>
                                                ' . $topic_parents['cmp_name'] . '
                                            </div>
                                        </a>
                                    </div>
                                ';
                            }
                        } else if ($count_post > 1) {
                            $topic_posts = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id = $topic_pt_id LIMIT 1");
                            foreach ($topic_posts as $tps) {
                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                if ($mod_rewrite == 1) {
                                    if ($topic_parents['cmp_rewrite_name'] != "" || $topic_parents['cmp_rewrite_name'] != null) {
                                        $changeUrlName = 'name=' . $topic_parents['cmp_rewrite_name'];
                                    } 
                                    else if ($topic_parents['cmp_rewrite_name'] == "" || $topic_parents['cmp_rewrite_name'] == null) {
                                        $changeUrlName = 'cid=' . $topic_parents['cmp_id'];
                                    }
                                } else {
                                    $changeUrlName = 'cid=' . $topic_parents['cmp_id'];
                                }
                                echo '
                                    <div id="sub-menu-container">
                                        <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                            <div>
                                                ' . $topic_parents['cmp_name'] . '
                                            </div>
                                        </a>
                                    </div>
                                ';
                            }
                        } else if ($count_post == 0) {
                            echo '
                                <div id="sub-menu-container">
                                    <a href="error.php" target="_self">
                                        <div>
                                            ' . $topic_parents['cmp_name'] . '
                                        </div>
                                    </a>
                                </div>
                            ';
                        }
                    } else if ($count_pt > 1 && ($topic_pt_id != "" || $topic_pt_id != null)) {
                        $topic_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id IN ($topic_pt_id)");
                        $topic_post_count = get_data_rows("SELECT COUNT(*) FROM post WHERE cmp_id = $topic_cmp_id AND post_active = 1 AND post_type_id IN ($topic_pt_id)");
                        $count_post = $topic_post_count[0]['COUNT(*)'];
                        if ($count_post == 1) {
                            foreach ($topic_post as $tp) {
                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                if ($mod_rewrite == 1) {
                                    if ($topic_child['cmp_rewrite_name'] != "" || $topic_child['cmp_rewrite_name'] != null) {
                                        $changeUrlName = 'name=' . $topic_child['cmp_rewrite_name'];
                                    }
                                    else if ($topic_child['cmp_rewrite_name'] == "" || $topic_child['cmp_rewrite_name'] == null) {
                                        $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                    }                    
                                } else {
                                    $changeUrlName = 'cid=' . $topic_child['cmp_id'];
                                }

                                echo '
                                    <div id="sub-menu-container">
                                        <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                            <div>
                                                ' . $topic_parents['cmp_name'] . '
                                            </div>
                                        </a>
                                    </div>
                                ';
                            }
                        } else if ($count_post > 1) {

                            if ($mod_rewrite == 1) {
                                if ($topic_parents['cmp_rewrite_name'] != "" || $topic_parents['cmp_rewrite_name'] != null) {
                                    $changeUrlName = 'name=' . $topic_parents['cmp_rewrite_name'];
                                } 
                                else if ($topic_parents['cmp_rewrite_name'] == "" || $topic_parents['cmp_rewrite_name'] == null) {
                                    $changeUrlName = 'cid=' . $topic_parents['cmp_id'];
                                }
                            } else {
                                $changeUrlName = 'cid=' . $topic_parents['cmp_id'];
                            }

                            echo '
                                <div id="sub-menu-container">
                                    <a href="../post_type_list/post_type_list.php?' . $changeUrlName . '" target="_self">
                                        <div>
                                            ' . $topic_parents['cmp_name'] . '
                                        </div>
                                    </a>
                                </div>
                            ';
                        } else if ($count_post == 0) {
                            echo '
                                <div id="sub-menu-container">
                                    <a href="error.php" target="_self">
                                        <div>
                                            ' . $topic_parents['cmp_name'] . '
                                        </div>
                                    </a>
                                </div>
                            ';
                        }
                    }
                    else if ($count_pt == 0 && ($topic_pt_id == "" || $topic_pt_id == null)) {
                        echo '
                            <div id="sub-menu-container">
                                <a href="error.php" target="_self">
                                    <div>
                                        ' . $topic_parents['cmp_name'] . '
                                    </div>
                                </a>
                            </div>
                        ';
                    }
            }
        }
        ?>

        <a href="../shop.php" target="_self">
            <div>
                Báo giá sản phẩm 
            </div>
        </a>
    </div>
</div>

<div id="sub-menu-close"></div>

<!---------- Social Media Plugin ---------->

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="Plj089Mw"></script>

<!---------- BUY & CONTACT ---------->
<div id="func_btn">
    <div id="buy">
        <div id="buy-container">
            <?php foreach ($arr_buy as $key => $buy) { ?>
                <a href="tel: <?php echo $buy['con_hotline_banhang'] ?> " target="_self">
                    <div class="func_icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="buy-content">
                        <p>Mua hàng:</p>
                        <p>
                            <?php echo $buy['con_hotline_banhang'] ?>
                        </p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <div id="scroll-top">
        <div id="scroll-container">
            <a href="#" target="_self">
                <div class="func_icon">
                    <i class="fas fa-chevron-up"></i>
                </div>
            </a>
        </div>
    </div>
</div>