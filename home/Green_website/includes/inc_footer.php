<?php $base_url = "http://localhost:8093/"; ?>

<div id="footer">
    <div id="footer-container">
        <div class="container-fluid">
            <div id="footer-content" class="row">
                <div class="col-lg-6 col-md-12">
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
                                    $footer_cmp_id = $footer_menu['cmp_id'];
                                    $footer_pt_id = $footer_menu['post_type_id'];
                                    $footer_menu_pt = explode(",", $footer_pt_id);
                                    $count_pt_footer = count($footer_menu_pt);
                                    if ($count_pt_footer == 1) {
                                        if ($footer_pt_id != "" || $footer_pt_id != null) {
                                            $footer_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $footer_cmp_id AND post_active = 1 AND post_type_id = $footer_pt_id");
                                            $footer_post_count = get_data_rows("SELECT COUNT(*) FROM post WHERE cmp_id = $footer_cmp_id AND post_active = 1 AND post_type_id = $footer_pt_id");
                                            $footer_post_footer = $footer_post_count[0]['COUNT(*)'];
                                            if ($footer_post_footer == 1) {
                                                foreach ($footer_post as $fp) {
                                                    $mod_rewrite = $arr_con['con_mod_rewrite'];
                                                    if ($mod_rewrite == 1) {
                                                        $changeUrlName = 'name=' . $fp['post_rewrite_name'];
                                                        $changeUrlBread = '&breadcrumbs=' . $footer_menu['cmp_rewrite_name'];
                                                    } else {
                                                        $changeUrlName = 'name=' . $fp['post_id'];
                                                        $changeUrlBread = '&breadcrumbs=' . $footer_menu['cmp_id'];
                                                    }
                                                    echo '
                                                        <li>
                                                            <a href="news.php?' . $changeUrlName . '&title=' . $fp['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $footer_menu['cmp_name'] . '&postNews=' . $fp['ptd_id'] . '" target="_self">
                                                                <span>' . $footer_menu['cmp_name'] . '</span>
                                                            </a>
                                                        </li>
                                                    ';
                                                }
                                            } else if ($footer_post_footer > 1) {
                                                $footer_posts = get_data_rows("SELECT * FROM post WHERE cmp_id = $footer_cmp_id AND post_active = 1 AND post_type_id = $footer_pt_id LIMIT 1");
                                                foreach ($footer_posts as $fps) {
                                                    $mod_rewrite = $arr_con['con_mod_rewrite'];
                                                    if ($mod_rewrite == 1) {
                                                        $changeUrlName = 'name=' . $fps['post_rewrite_name'];
                                                        $changeUrlBread = '&breadcrumbs=' . $footer_menu['cmp_rewrite_name'];
                                                    } else {
                                                        $changeUrlName = 'name=' . $fps['post_id'];
                                                        $changeUrlBread = '&breadcrumbs=' . $footer_menu['cmp_id'];
                                                    }
                                                    echo '
                                                        <li>
                                                            <a href="news.php?' . $changeUrlName . '&title=' . $fps['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $footer_menu['cmp_name'] . '&postTypeId=' . $footer_menu['post_type_id'] . '&postNews=' . $fps['ptd_id'] . '&postName=' . '" target="_self">
                                                                <span>' . $footer_menu['cmp_name'] . '</span>
                                                            </a>
                                                        </li>
                                                    ';
                                                }
                                            } else if ($footer_post_footer == 0) {
                                                echo '
                                                    <li>
                                                        <a href="error.php" target="_self">
                                                            <span>' . $footer_menu['cmp_name'] . '</span>
                                                        </a>
                                                    </li>
                                                ';
                                            }
                                        }
                                        else if ($footer_pt_id == "" || $footer_pt_id == null) {
                                            echo '
                                                <li>
                                                    <a href="error.php" target="_self">
                                                        <span>' . $footer_menu['cmp_name'] . '</span>
                                                    </a>
                                                </li>
                                            ';
                                        }
                                    } else if ($count_pt_footer > 1) {
                                        if ($footer_pt_id != "" || $footer_pt_id != null) {
                                            $footer_post = get_data_rows("SELECT * FROM post WHERE cmp_id = $footer_cmp_id AND post_active = 1 AND post_type_id IN ($footer_pt_id)");
                                            $footer_post_count = get_data_rows("SELECT COUNT(*) FROM post WHERE cmp_id = $footer_cmp_id AND post_active = 1 AND post_type_id IN ($footer_pt_id)");
                                            $footer_post_footer = $footer_post_count[0]['COUNT(*)'];
                                            if ($footer_post_footer == 1) {
                                                foreach ($footer_post as $fp) {
                                                    $mod_rewrite = $arr_con['con_mod_rewrite'];
                                                    if ($mod_rewrite == 1) {
                                                        $changeUrlName = 'name=' . $fp['post_rewrite_name'];
                                                        $changeUrlBread = '&breadcrumbs=' . $footer_menu['cmp_rewrite_name'];
                                                    } else {
                                                        $changeUrlName = 'name=' . $fp['post_id'];
                                                        $changeUrlBread = '&breadcrumbs=' . $footer_menu['cmp_id'];
                                                    }
                                                    echo '
                                                        <li>
                                                            <a href="news.php?' . $changeUrlName . '&title=' . $fp['post_title'] . $changeUrlBread . '&nameBreadcrumbs=' . $footer_menu['cmp_name'] . '&postTypeId=' . $footer_menu['post_type_id'] . '&postNews=' . $fp['ptd_id'] . '" target="_self">
                                                                <span>' . $footer_menu['cmp_name'] . '</span>
                                                            </a>
                                                        </li>
                                                    ';
                                                }
                                            } else if ($footer_post_footer > 1) {
                                                $mod_rewrite = $arr_con['con_mod_rewrite'];
                                                if ($mod_rewrite == 1) {
                                                    $changeUrlBread = 'breadcrumbs=' . $footer_menu['cmp_rewrite_name'];
                                                } else {
                                                    $changeUrlBread = 'breadcrumbs=' . $footer_menu['cmp_id'];
                                                }
                                                echo '
                                                    <li>
                                                        <a href="news.php?' . $changeUrlBread . '&nameBreadcrumbs=' . $footer_menu['cmp_name'] . '&postTypeId=' . $footer_menu['post_type_id'] . '&countPt=' . $count_pt_footer . '" target="_self">
                                                            <span>' . $footer_menu['cmp_name'] . '</span>
                                                        </a>
                                                    </li>
                                                ';
                                            } else if ($footer_post_footer == 0) {
                                                echo '
                                                    <li>
                                                        <a href="error.php" target="_self">
                                                            <span>' . $footer_menu['cmp_name'] . '</span>
                                                        </a>
                                                    </li>
                                                ';
                                            }
                                        }
                                        else if ($footer_pt_id == "" || $footer_pt_id == null) {
                                            echo '
                                                <li>
                                                    <a href="error.php" target="_self">
                                                        <span>' . $footer_menu['cmp_name'] . '</span>
                                                    </a>
                                                </li>
                                            ';
                                        }
                                    } else if ($count_pt_footer == 0) {
                                        echo '
                                            <li>
                                                <a href="error.php" target="_self">
                                                    <span>' . $footer_menu['cmp_name'] . '</span>
                                                </a>
                                            </li>
                                        ';
                                    }
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

                <div class="col-lg-2 col-md-12">
                    <div id="logo-bottom">
                        <img src="<?php echo $base_url . $web_icon ?>" alt="logo bottom">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>