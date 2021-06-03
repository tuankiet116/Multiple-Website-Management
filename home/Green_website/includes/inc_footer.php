<?php
require_once('../../classes/database.php');
$web_id = 2;

?>

<div id="footer">
    <div id="footer-container">
        <div class="container-fluid">
            <div id="footer-content" class="row">
                <div class="col-lg-4 col-md-12">
                    <p>Thông tin liên hệ</p>
                    <ul class="footer-contact">
                        <?php
                            $footer_contact = get_data_rows("SELECT * FROM configuration WHERE web_id = $web_id");
                            foreach ($footer_contact as $key => $f_contact) {
                                echo '
                                    <li>
                                        <a href="" target="_self">
                                            ' . $f_contact['con_site_title'] . '
                                        </a>
                                    </li>

                                    <li>
                                        <a href="" target="_self">
                                            Địa chỉ: ' . $f_contact['con_address'] . '
                                        </a>
                                    </li>

                                    <li>
                                        <a href="" target="_self">
                                            Hotline: ' . $f_contact['con_hotline'] . '
                                        </a>
                                    </li>

                                    <li>
                                        <a href="" target="_self">
                                            Email: ' . $f_contact['con_admin_email'] . '
                                        </a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12">
                    <p>Danh mục</p>
                    <ul class="footer-link">
                        <li>
                            <a href="index.php" target="_self">
                                Trang chủ
                            </a>
                        </li>

                        <?php
                        $arr_footer_menu = get_data_rows("SELECT * FROM categories_multi_parent WHERE cmp_parent_id IS NULL AND web_id = $web_id");
                        foreach ($arr_footer_menu as $key => $footer_menu) {
                            if ($footer_menu['cmp_active'] == 1 && $footer_menu['cmp_has_child'] == 0) {
                                echo '
                                    <li>
                                        <a href="' . $footer_menu['cmp_rewrite_name'] . '" target="_self">
                                            ' . $footer_menu['cmp_name'] . '
                                        </a>
                                    </li>';
                            }
                        }
                        ?>

                        <li>
                            <a href="shop.php" target="_self">
                                Báo giá sản phẩm
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <p>Dịch vụ cung cấp</p>
                    <ul class="footer-link">
                        <?php
                        $arr_footer_services = get_data_rows("SELECT * FROM categories_multi_parent WHERE web_id = $web_id");
                        foreach ($arr_footer_services as $key => $footer_services) {
                            if ($footer_services['cmp_active'] == 1 && $footer_services['cmp_parent_id'] == 10) {
                                $footer_services_id = $footer_services['cmp_id'];
                                $arr_p = get_data_rows("SELECT * FROM post WHERE FIND_IN_SET($footer_services_id, cmp_id)");
                                foreach ($arr_p as $key => $ar) {
                                    echo '
                                    <li>
                                        <a href="news.php?name=' . $ar['post_rewrite_name'] . '&title=' . $ar['post_title'] . '&breadcrumbs=' . $footer_services['cmp_rewrite_name'] . '&nameBreadcrumbs=' . $footer_services['cmp_name'] . '&postNews=' . $ar['ptd_id'] . '" target="_self">
                                            ' . $footer_services['cmp_name'] . '
                                        </a>
                                    </li>';
                                }
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>