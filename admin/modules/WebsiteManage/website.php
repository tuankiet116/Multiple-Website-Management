<?php
require("inc_security.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/websiteManage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/websiteManage.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="alert alert-warning alert-dismissible d-none alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container-fluid">
        <div class="btn-show-modal">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#show-modal-form">
                <i class="fas fa-plus"></i> Thêm mới
            </button>
        </div>
        <div class="modal fade" id="show-modal-form">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cài Đặt Website</h5>
                        <button type="button" class="close close-form-create" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-container">
                            <form action="#" id="form">
                                <div class="form-group">
                                    <label for="web_name"><?= translate_text('Tên Website') ?>:</label>
                                    <input type="text" class="form-control" id="web_name" placeholder="Nhập Tên Website" name="web_name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for=""><?= translate_text('icon website') ?>:</label>
                                    <div class="customs-file">
                                        <div class="input-image-container">
                                            <i class="fas fa-trash-alt"></i>
                                            <div class="input-image" id="input_image_icon_1">
                                                <img id="image_icon_1" src="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                                </svg>
                                                <input name="input_icon_1" type="file" class="form-input-image" id="input_icon_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="web_description"><?= translate_text('Mô Tả') ?>:</label>
                                    <textarea class="form-control" id="web_description" name="web_description"></textarea>
                                </div>
                                <div class="form-group btn-submit">
                                    <input id="submit" class="btn btn-primary" type="submit" value="Thêm Mới">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-website-container">
            <div class="list-website-title">
                <p>Danh Sách Website</p>
            </div>
            <table class="table table-listing-website">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Tên Miền</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <!-- Modal Domain Information -->
        <div class="modal fade" id="modal-domain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title-domain" id="exampleModalLabel">Quản Lý Tên Miền<span class="web_name"></span></h5>
                        <button type="button" class="close close-modal-domain" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <button style="margin-bottom: 10px;" data-dismiss="modal" data-toggle="modal" data-target="#modal-add-domain" id="btn-add-domain" type="button" class="btn btn-primary btn-sm">
                            Thêm Tên Miền <i class="fas fa-plus-circle"></i>
                        </button>
                        <table class="table listing-domain">
                            <thead class="table-primary">
                                <th>Tên Miền</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-back-modal btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#show-modal-form-update"><i class="fas fa-arrow-circle-left"></i> Quay Lại</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Domain -->
        <div class="modal fade" id="modal-domain-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title-domain" id="exampleModalLabel">Chi Tiết Tên Miền</h5>
                        <button type="button" class="close close-modal-domain-detail" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-group" style="padding: 20px;">
                        <label for="input-domain-detail">Tên Miền: </label>
                        <input autocomplete="off" type="url" class="form-control" id="input-domain-detail" placeholder="Enter Domain">
                        <small id="domain-small" style="display: none; color: red !important;" class="form-text text-muted"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-back-modal btn-sm btn-back-modal-info" data-dismiss="modal" data-toggle="modal" data-target="#modal-domain"><i class="fas fa-arrow-circle-left"></i> Quay Lại</button>
                        <button type="button" id="update-domain-btn" class="btn btn-success btn-sm">Cập Nhật</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create Domain -->
        <div class="modal fade" id="modal-add-domain" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title-domain">Thêm Mới Tên Miền</h5>
                        <button type="button" class="close close-modal-domain-add" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-group" style="padding: 20px;">
                        <label for="input-domain-detail">Tên Miền: </label>
                        <input type="url" autocomplete="off" class="form-control" id="input-domain-add" placeholder="Enter Domain">
                        <small id="domain-add-small" style="display: none; color: red !important;" class="form-text text-muted"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-back-modal btn-sm btn-back-modal-info" data-dismiss="modal" data-toggle="modal" data-target="#modal-domain"><i class="fas fa-arrow-circle-left"></i> Quay Lại</button>
                        <button type="button" id="add-domain-btn" class="btn btn-success btn-sm">Thêm</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Update Website Information -->
        <div class="modal fade" id="show-modal-form-update">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập Nhật Website</h5>
                        <button type="button" class="close close-form-update" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-container">
                            <form action="#" id="form-update">
                                <div class="form-group">
                                    <label for="web_name_update"><?= translate_text('Tên Website') ?>:</label>
                                    <input type="text" class="form-control" id="web_name_update" placeholder="Nhập Tên Website" name="web_name_update" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label id="label-domain" for="web_url_update"><?= translate_text('Tên Miền Website') ?>:</label><span id="domain-status"></span>
                                    <a id="redirect-domain-manage" style="text-decoration: none; color: white;" href="../../resource/Error/404/404.html">
                                        <button type="button" class="btn btn-info" style="float: right;">
                                            Quản Lý Domain <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </a>
                                    <table style="margin: auto;" class="domain-listing">
                                        <thead>
                                            <th style="font-size: 15px;">Domain: </th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for=""><?= translate_text('icon website') ?>:</label>
                                    <div class="customs-file">
                                        <div class="input-image-container">
                                            <i class="fas fa-trash-alt"></i>
                                            <div class="input-image" id="input_image_icon_1_update">
                                                <img id="image_icon_1_update" src="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                                </svg>
                                                <input name="input_icon_1_update" type="file" class="form-input-image" id="input_icon_1_update">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="web_description_update"><?= translate_text('Mô Tả') ?>:</label>
                                    <textarea class="form-control" id="web_description_update" name="web_description_update"></textarea>
                                </div>
                                <div class="form-group btn-submit">
                                    <input id="submit-update" class="btn btn-primary" type="submit" value="Cập Nhật">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>