<?php
require_once('../../classes/database.php');
$web_id = 'web_id = 2';

/********** TITLE **********/
$arr_footer = array();
$sql = "SELECT * FROM categories_multi_parent WHERE $web_id";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_footer, $row);
    }
}
unset($result, $sql);
?>

<div id="footer">
    <div id="footer-container">
        <div class="container-fluid">
            <div id="footer-content" class="row">
                <div class="col-lg-4 col-md-12">
                    <p>Thông tin liên hệ</p>
                    <ul class="footer-contact">
                        <li>
                            <a href="#" target="_self">
                                Tên giao dịch: SON KIM VIET NAM PRODUCTION AND SERVICES JOINT STOCK COMPANY
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                Địa chỉ: Số 39, ngõ 100/12 Sài Đồng, Long Biên, Hà Nội
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                VPGD: Số 5, ngõ 139/69, phố Hoa Lâm, Long Biên, Hà Nội
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                Nhà vườn: Văn Giang, Hưng Yên
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                ĐKKD/MST: 0107351360 do sở KHĐT cấp ngày 10/03/2016
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                Hotline: 035.955.9225
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                Email: doanphilong2k@gmail.com
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <p>Danh mục</p>
                    <ul class="footer-link">
                        <?php
                        foreach ($arr_footer as $key => $footer_menu) {
                            if ($footer_menu['cmp_active'] == 1 && $footer_menu['cmp_meta_description'] == 'menu') {
                                echo '
                                    <li>
                                        <a href="#" target="_self">
                                            ' . $footer_menu['cmp_name'] . '
                                        </a>
                                    </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <p>Dịch vụ cung cấp</p>
                    <ul class="footer-link">
                        <?php
                        foreach ($arr_footer as $key => $footer_services) {
                            if ($footer_services['cmp_active'] == 1 && $footer_services['cmp_parent_id'] == 3) {
                                echo '
                                    <li>
                                        <a href="#" target="_self">
                                            ' . $footer_services['cmp_name'] . '
                                        </a>
                                    </li>';
                            }
                        }
                        ?>

                        <!-- <li>
                            <a href="#" target="_self">
                                Thiết kế thi công sân vườn biệt thự
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                Thiết kế thi công hồ cá Koi
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_self">
                                Thiết kế thi công cảnh quan ngoại cảnh biệt phủ, lâu đài
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>