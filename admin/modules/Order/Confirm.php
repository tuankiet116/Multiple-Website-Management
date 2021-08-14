<?php
require("inc_security.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/select_nice/css/nice-select.css">
    <link rel="stylesheet" href="../../resource/css/order_confirm.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../../resource/select_nice/js/jquery.js"></script>
    <script src="../../resource/select_nice/js/jquery.nice-select.min.js" ></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/order_confirm.js"></script>
    <title>Document</title>
</head>
<body>

    <div class="loader-container"><div class="loader"></div></div>
    <div class="alert alert-warning alert-dismissible d-none alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">  
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="container">
        <div class="title-search">
            <p>Tìm Kiếm</p>
        </div>
        <div class="wrapper-search">
            <div class="pick_website_container">
                <div class="title_pick_website title-pick">
                    <h4><?= translate_text('Chọn trang web')?>: </h4>
                </div>
                <div class="box">
                    <select class="pick_website_select">
                    </select>
                </div>
            </div>
            <div class="select_container">
                <div class="form-group">
                    <label for="order_search"><?= translate_text('Tìm Kiếm')?>:</label>
                    <input type="text" class="form-control style_input" id="order_search" placeholder="Mã đơn hàng hoặc mã giao dịch">
                </div>
            </div>
            <div class="btn-action">
                <button class="btn btn-primary" id="btn-search">Tìm kiếm</button>
                <button class="btn btn-danger" id="btn-clear">xóa</button>
            </div>
        </div>
        <div class="line"></div>
        <div class="title">
            <p><?= translate_text('Danh Sách Đơn Hàng Chờ Xác Nhận')?></p>
        </div>

        <div class="list-order-confirm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?= translate_text('Mã Đơn Hàng')?></th>
                        <th scope="col"><?= translate_text('Tên Khách Hàng')?></th>
                        <th scope="col"><?= translate_text('Số Điện Thoại')?></th> 
                        <th scope="col"><?= translate_text('Phương Thức Thanh Toán')?></th>
                        <th scope="col"><?= translate_text('Mã Giao Dịch')?></th>  
                        <th scope="col"><?= translate_text('Website')?></th>
                        <th scope="col"><?= translate_text('Tổng Tiền')?></th>
                        <th scope="col"><?= translate_text('Trạng Thái Đơn Hàng')?></th>
                        <th scope="col"><?= translate_text('Hành Động')?></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="show-modal-detail">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title-detail">Chi Tiết Đơn Hàng <p id="order_suspicious"></p></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal-detail">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Mã Đơn Hàng')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_id"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Khách Hàng')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="user_name"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Số Điện Thoại')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="user_number_phone"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('email')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="user_email"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Ghi Chú Của Khách Hàng')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_description"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Trạng Thái Giao Dịch')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_payment_status"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Phương Thức Thanh Toán')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_payment"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('website')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="web_name"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('ID Yêu Cầu')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_request_id"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Mã Giao Dịch')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_trans_id"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Tổng Tiền')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_sum_price"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('QR hoặc Web Hoặc Atm')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_paytype"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Thời Gian')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_datetime"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Trạng Thái Đơn Hàng')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_status"></p>
                            </div>
                        </div>
                        <div class="row-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Trạng Thái Hoàn Tiền')?>:</p>
                            </div>
                            <div class="content-row">
                                <p id="order_refund_code"></p>
                            </div>
                        </div>
                        <div class="table-data-detail">
                            <div class="title-row">
                                <p><?= translate_text('Chi Tiết Đơn Hàng')?>:</p>
                            </div>
                            <div class="content-row">
                                <table style="border-collapse: collapse; margin-bottom: 14px; width: 100%; margin-top: 5px; font-size: 14px">
                                    <thead>
                                        <tr>     
                                            <th style="border: 1px solid #dee2e6; font-weight: 500; padding: 5px"> Tên Sản Phẩm </th>
                                            <th style="border: 1px solid #dee2e6; font-weight: 500; padding: 5px"> Số Lượng </th>
                                            <th style="border: 1px solid #dee2e6; font-weight: 500; padding: 5px"> Tổng </th>            
                                        </tr>
                                    </thead>
                                    <tbody id="order_detail"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-confirm">Xác Nhận</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-cancel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bạn Có Chắc Là Muốn Hủy Đơn Hàng Này?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal-cancel">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="order_reason">
                            <label for=""><?= translate_text('Lý Do')?>:</label>
                            <select name="" id="order_reason">
                                <option value="1">Admin Hủy</option>
                                <option value="2">Không Xác Nhận Được Với Khách Hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btn-cancel">Xác Nhận</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>