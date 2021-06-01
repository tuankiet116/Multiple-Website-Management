<!---------- MENU ---------->

<?php
$web_id = 2;

$arr_topic_parents = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NULL AND web_id = $web_id");
$arr_topic_child = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NOT NULL AND web_id = $web_id");
$arr_buy = get_data_rows("SELECT * FROM configuration WHERE web_id = $web_id");
?>




<div id="menu">
    <div id="logo">

    </div>

    <ul id="navbar">
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
                        echo '
                            <tr>
                                <td>
                                    <a href="' . $topic_child['cmp_rewrite_name'] . '" target="_self">
                                        <div> ' . $topic_child['cmp_name'] . ' </div>
                                    </a>
                                </td>
                            </tr>
                        ';
                    }
                }
                echo '
                                </table>
                            </div>
                        </li>
                    ';
            } else if ($topic_parents['cmp_has_child'] == 0 &&  $topic_parents['cmp_active'] == 1) {
                echo '
                            <li>
                                <a href="' . $topic_parents['cmp_rewrite_name'] . '" target="_self">
                                    <span>' . $topic_parents['cmp_name'] . '</span>
                                </a>
                            </li>
                        ';
            }
        }
        ?>
    </ul>

    <div id="sub-icon">
        <i class="fas fa-bars bars-icon"></i>
    </div>
</div>

<div id="sub-menu">
    <?php
    foreach ($arr_topic_parents as $key => $topic_parents) {
        if ($topic_parents['cmp_has_child'] == 1 && $topic_parents['cmp_active'] == 1) {
            $arr_child_id = explode(",", $topic_parents['cmp_has_child']);
            echo '
                        <div id="sub-menu-container">
                            <a id="sub_' . $topic_parents['cmp_id'] . '" href="#" target="_self">
                                <div>
                                    ' . $topic_parents['cmp_name'] . '
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </a>';
            echo '
                            <div id="sub_content_' . $topic_parents['cmp_id'] . '" class="sub-menu-content">';
            foreach ($arr_topic_child as $key => $topic_child) {
                if ($topic_child['cmp_parent_id'] == $topic_parents['cmp_id'] && $topic_parents['cmp_active'] == 1) {
                    echo '
                                <a href="#" target="_self">
                                    <div>' . $topic_child['cmp_name'] . '</div>
                                </a>
                            ';
                }
            }
            echo '
                            </div>
                        </div>';
            echo '
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
            echo '
                                <div id="sub-menu-container">
                                    <a href="' . $topic_parents['cmp_rewrite_name'] . '" target="_self">
                                        <div>
                                            ' . $topic_parents['cmp_name'] . '
                                        </div>
                                    </a>
                                </div>';
        }
    }
    ?>
</div>

<div id="sub-menu-close"></div>

<!---------- BUY & CONTACT ---------->
<div id="func_btn">
    <div id="buy">
        <div id="buy-container">
            <?php foreach($arr_buy as $key => $buy) { ?>
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