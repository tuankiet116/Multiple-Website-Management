<? require_once("inc_security.php") ?>
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
    <link rel="stylesheet" href="../../resource/css/service.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../resource/ckeditor-full/ckeditor.js"></script>


    <script src="../../resource/select_nice/js/jquery.js"></script>
    <script src="../../resource/select_nice/js/jquery.nice-select.min.js" ></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/service.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="search">
            <div class="title-search">
                <p><?= translate_text('Tìm Kiếm Sản Phẩm')?></p>
            </div>

            <div class="input-search">

                <div class="pick_website_container fiximg">
                    <div class="title_pick_website title-pick">
                        <h4><?= translate_text('Chọn trang web')?></h4>
                    </div>
                    <div class="box">
                        <select class="pick_website_select">
                        </select>
                    </div>
                </div>

                <div class="pick_service_gr_container">
                    <div class="title_pick_service_gr title-pick">
                        <h4><?= translate_text('Chọn nhóm dịch vụ')?></h4>
                    </div>
                    <div class="box">
                        <select class="pick_service_gr_select" disabled>
                        </select>
                    </div>
                </div>


                <div class="text-input-search">
                    <div class="form-group form-group-fix">
                        <label for="text-search"><?= translate_text('Tìm Kiếm')?></label>
                        <input type="text" class="form-control" id="text-search" placeholder="tìm kiếm">
                    </div>
                </div>

                <div class="select-search">
                    <label for="searching"><?= translate_text('Trạng Thái Dịch vụ')?></label>
                    <select id="service-status" class=" form-group">
                        <option value="#">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="btn-group">
                    <div class="form-group">
                        <button class="btn btn-primary" id="btn-search">Tìm</button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" id="btn-clear">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-add-service">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-modal-show" data-toggle="modal" data-target="#form-add">
                <i class="fas fa-plus"></i>
                <p>Thêm Mới Dịch Vụ</p>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="form-add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Mới</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#">
                                <div class="form-group">
                                    <label for="service_name">Tên Dịch Vụ</label>
                                    <input type="text" class="form-control" id="service_name" placeholder="Tên Dịch Vụ">
                                </div>
                                <div class="form-group">
                                    <label for="service_description">Mô tả</label>
                                    <textarea type="text" class="form-control" id="service_description"></textarea>
                                </div>

                                <div style="display: flex; margin-left: 10px; margin-bottom: 30px">
                                    <div class="pick_website_container fiximg add">
                                        <div class="title_pick_website title-pick">
                                            <h4><?= translate_text('trang web')?></h4>
                                        </div>
                                        <div class="box add">
                                            <select class="pick_website_select add">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="pick_service_gr_container add">
                                        <div class="title_pick_service_gr title-pick">
                                            <h4><?= translate_text('Nhóm dịch vụ')?></h4>
                                        </div>
                                        <div class="box add">
                                            <select class="pick_service_gr_select add" disabled>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-service">
                                    <div class="content-service-edit">
                                        <textarea name="content-service-add" id="content-service-add"></textarea>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" id="btn-submit-add">Thêm Mới</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="line"></div>
    </div>

    <div class="container">
        <div class="title-list-service">
            <p>Danh Sách Dịch Vụ</p>
        </div>

        <div class="list-service">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tên Dịch Vụ</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Nhóm Dịch Vụ</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Rửa xe</td>
                        <td>Rửa xe thay dầu</td>
                        <td>Rửa xe</td>
                        <td><button class="btn btn-danger btn-status">Đã Ẩn</button></td>
                        <td><button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#form-update">Chi Tiết</button></td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="modal fade" id="form-update">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Dịch Vụ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form-update">
                            <div class="form-group">
                                <label for="service_name">Tên Dịch Vụ</label>
                                <input type="text" class="form-control" id="service_name_update" placeholder="Tên Dịch Vụ">
                            </div>
                            <div class="form-group">
                                <label for="service_description">Mô tả</label>
                                <textarea type="text" class="form-control" id="service_description_update"></textarea>
                            </div>

                            <div style="display: flex; margin-left: 10px; margin-bottom: 30px">
                                <div class="pick_website_container fiximg add">
                                    <div class="title_pick_website title-pick">
                                        <h4><?= translate_text('trang web')?></h4>
                                    </div>
                                    <div class="box update">
                                        <select class="pick_website_select update">
                                        </select>
                                    </div>
                                </div>

                                <div class="pick_service_gr_container update">
                                    <div class="title_pick_service_gr title-pick">
                                        <h4><?= translate_text('Nhóm dịch vụ')?></h4>
                                    </div>
                                    <div class="box update">
                                        <select class="pick_service_gr_select update" disabled>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="content-service">
                                <div class="content-service-edit">
                                    <textarea name="content-service-update" id="content-service-update"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="btn-submit-update">Cập Nhật</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script>
    CKEDITOR.replace('content-service-add', {
        extraPlugins: 'image2,uploadimage',
        removePlugins: 'image',
        width: '100%',
        height: 300,

        // Configure your file manager integration. This example uses CKFinder 3 for PHP.
        filebrowserBrowseUrl: '../../resource/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '../../resource/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '../../resource/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '../../resource/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

        // Upload dropped or pasted images to the CKFinder connector (note that the response type is set to JSON).
        uploadUrl: '../../resource/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

        // Reduce the list of block elements listed in the Format drop-down to the most commonly used.
        format_tags: 'p;h1;h2;h3;pre',
        // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        removeDialogTabs: 'image:advanced;link:advanced',
    });


    CKEDITOR.replace('content-service-update', {
        extraPlugins: 'image2,uploadimage',
        removePlugins: 'image',
        width: '100%',
        height: 300,

        // Configure your file manager integration. This example uses CKFinder 3 for PHP.
        filebrowserBrowseUrl: '../../resource/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '../../resource/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '../../resource/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '../../resource/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

        // Upload dropped or pasted images to the CKFinder connector (note that the response type is set to JSON).
        uploadUrl: '../../resource/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

        // Reduce the list of block elements listed in the Format drop-down to the most commonly used.
        format_tags: 'p;h1;h2;h3;pre',
        // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        removeDialogTabs: 'image:advanced;link:advanced',
    });
</script>
</html>