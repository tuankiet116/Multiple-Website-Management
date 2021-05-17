<!---------- MENU ---------->

<?php
require_once('../../classes/database.php');
$web_id = 'web_id = 2';

/********** Parents **********/

$arr_topic_parents = array();
$sql = "SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NULL AND $web_id";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_topic_parents, $row);
    }
}
unset($result, $sql);

/********** Child **********/

$arr_topic_child = array();
$sql = "SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NOT NULL AND $web_id";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_topic_child, $row);
    }
}
unset($result, $sql);
?>




<div id="menu">
    <div id="logo">

    </div>

    <ul id="navbar">
        <?php
        foreach ($arr_topic_parents as $key => $topic) {
            if ($topic['cmp_has_child'] == 1 && $topic['cmp_active'] == 1 && $topic['bgt_type'] == '') {
                $arr_child_id = explode(",", $topic['cmp_has_child']);
                echo '
                        <li>
                            <a href="#" target="_self">
                                <span>' . $topic['cmp_name'] . '</span>
                            </a>';
                echo '
                            <div class="sub-navbar">
                                <div class="sub-container"></div>
                                <table>';
                foreach ($arr_topic_child as $key => $topic_child) {
                    if (in_array($topic_child['cmp_parent_id'] == $topic['cmp_id'], $arr_child_id)) {
                        echo '
                                            <tr>
                                                <td>
                                                    <a href="" target="_self">
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
            } else if ($topic['cmp_has_child'] == 0 &&  $topic['cmp_active'] == 1 && $topic['bgt_type'] == '') {
                echo '
                            <li>
                                <a href="" target="_self">
                                    <span>' . $topic['cmp_name'] . '</span>
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
        foreach ($arr_topic_parents as $key => $topic) {
            if ($topic['cmp_has_child'] == 1 && $topic['cmp_active'] == 1 && $topic['bgt_type'] == '') {
                $arr_child_id = explode(",", $topic['cmp_has_child']);
                echo '
                        <div id="sub-menu-container">
                            <a id="sub_' . $topic['cmp_id'] . '" href="#" target="_self">
                                <div>
                                    ' . $topic['cmp_name'] . '
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </a>';
                echo '
                            <div id="sub_content_' . $topic['cmp_id'] . '" class="sub-menu-content">';
                foreach ($arr_topic_child as $key => $topic_child) {
                    if (in_array($topic_child['cmp_parent_id'] == $topic['cmp_id'], $arr_child_id)) {
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
                    <script type="text/javascript">
                        $(document).ready(function(){
                            var m = 0;

                            $("#sub_' . $topic['cmp_id'] . '").click(function () {
                                $("#sub_content_' . $topic['cmp_id'] . '").slideToggle("slow");
                            });

                            $("#sub_' . $topic['cmp_id'] . '").click(function () {
                                if (m == 0) {
                                $("#sub-menu #sub-menu-container a#sub_' . $topic['cmp_id'] . ' div i").css(
                                    "transform",
                                    "rotate(180deg)"
                                );
                                m++;
                                } else {
                                $("#sub-menu #sub-menu-container a#sub_' . $topic['cmp_id'] . ' div i").css(
                                    "transform",
                                    "rotate(0deg)"
                                );
                                m--;
                                }
                            });
                        });
                    </script>
                ';
            } else if ($topic['cmp_has_child'] == 0 &&  $topic['cmp_active'] == 1 && $topic['bgt_type'] == '') {
                echo '
                                <div id="sub-menu-container">
                                    <a href="#" target="_self">
                                        <div>
                                            ' . $topic['cmp_name'] . '
                                        </div>
                                    </a>
                                </div>';
            }
        }
    ?>
    <!-- <div id="sub-menu-container">
        <a href="#" target="_self">
            <div class="sub-active">
                Trang chủ
            </div>
        </a>
    </div>

    <div id="sub-menu-container">
        <a href="#" target="_self">
            <div>Giới thiệu</div>
        </a>
    </div>

    <div id="sub-menu-container">
        <a id="sub_1" href="#" target="_self">
            <div>
                Dịch vụ
                <i class="fas fa-chevron-down"></i>
            </div>
        </a>

        <div id="sub_content_1" class="sub-menu-content">
            <a href="#" target="_self">
                <div> Thiết kế thi công sân vườn biệt thự </div>
            </a>

            <a href="#" target="_self">
                <div> Thiết kế thi công hồ cá Koi </div>
            </a>

            <a href="#" target="_self">
                <div> Thiết kế thi công cảnh quan ngoại cảnh biệt phủ, lâu đài </div>
            </a>
        </div>
    </div>

    <div id="sub-menu-container">
        <a href="#" target="_self">
            <div>
                Báo giá sản phẩm
            </div>
        </a>
    </div>

    <div id="sub-menu-container">
        <a href="#" target="_self">
            <div>
                Chuyên mục nhà đẹp
                <i class="fas fa-chevron-down"></i>
            </div>
        </a>

        <div id="sub_content_1" class="sub-menu-content">
            <a href="#" target="_self">
                <div> Cảnh quan sân vườn đẹp </div>
            </a>

            <a href="#" target="_self">
                <div> Hồ cá Koi đẹp </div>
            </a>

            <a href="#" target="_self">
                <div> Vườn tường xanh </div>
            </a>

            <a href="#" target="_self">
                <div> Chăm sóc hoa và cây cảnh </div>
            </a>
        </div>
    </div>

    <div id="sub-menu-container">
        <a href="#" target="_self">
            <div>Hỏi đáp</div>
        </a>
    </div> -->
</div>
<div id="sub-menu-close"></div>

<!---------- BUY & CONTACT ---------->

<div id="func_btn">
    <div id="buy">
        <div id="buy-container">
            <a href="#" target="_self">
                <div class="func_icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>

                <div class="buy-content">
                    <p>Mua hàng:</p>
                    <p>035.955.9225</p>
                </div>
            </a>
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