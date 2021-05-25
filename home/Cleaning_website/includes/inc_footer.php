<?php 
    $info_footer = get_data_row("SELECT con_admin_email, con_hotline, con_hotline_banhang, con_info_company, con_site_title
                                 FROM configuration WHERE web_id = $web_id");

?>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="footer-container col-lg-3">
                <div> <?php echo $info_footer['con_site_title']?> </div>
                <table>
                    <tr>
                        <td><i class="fas fa-map-marker-alt"></i></td>
                        <td><?php echo $info_footer['con_info_company']?></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-phone-alt"></i></td>
                        <td><?php echo $info_footer['con_hotline']?></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-mobile-alt"></i></td>
                        <td><?php echo $info_footer['con_hotline_banhang']?></td>
                    </tr>
                    <tr>
                        <td><i class="far fa-envelope"></i></td>
                        <td><?php echo $info_footer['con_admin_email']?></td>
                    </tr>
                </table>
            </div>
            <div class="footer-container col-lg-3">
                <div> Thông tin </div>
                <table>
                    <tr>
                        <td>Chính sách riêng tư</td>
                    </tr>
                    <tr>
                        <td>Thỏa thuận người dùng</td>
                    </tr>
                    <tr>
                        <td>Điều khoản & Điều kiện</td>
                    </tr>
                    <tr>
                        <td>Về chúng tôi</td>
                    </tr>
                </table>
            </div>
            <div class="footer-container col-lg-3">
                <div> TÀI KHOẢN </div>
                <table>
                    <tr>
                        <td>Tài khoản</td>
                    </tr>
                    <tr>
                        <td>Đơn hàng</td>
                    </tr>
                    <tr>
                        <td>Yêu thích</td>
                    </tr>
                    <tr>
                        <td>Thông báo</td>
                    </tr>
                </table>
            </div>
            <div class="footer-container col-lg-3">
                <div> TÀI KHOẢN </div>
                <table>
                    <tr>
                        <td>Tài khoản</td>
                    </tr>
                    <tr>
                        <td>Đơn hàng</td>
                    </tr>
                    <tr>
                        <td>Yêu thích</td>
                    </tr>
                    <tr>
                        <td>Thông báo</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>