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
    <script language="javascript" src="../../resource/js/policies.js"></script>
    <title>Chính sách</title>
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
        <div class="search">
            <div class="title-search">
                <p><?= translate_text('Tìm Kiếm Chính Sách')?></p>
            </div>

            <div class="input-search">
                <div class="pick_website_container fiximg">
                    <div class="title_pick_website title-pick">
                        <h4><?= translate_text('Chọn trang web')?></h4>
                    </div>
                    <div class="box">
                        <select class="pick_website_select search">
                        </select>
                    </div>
                </div>

                <div class="text-input-search">
                    <div class="form-group form-group-fix">
                        <label for="text-search"><?= translate_text('Tìm Kiếm')?></label>
                        <input type="text" class="form-control" id="text-search" placeholder="tìm kiếm" autocomplete="off">
                    </div>
                </div>

                <div class="select-search">
                    <label for="searching"><?= translate_text('Trạng Thái')?></label>
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
            <button type="button" class="btn btn-primary btn-modal-show" data-toggle="modal" data-target="#form-add" id="btn-add-service">
                <i class="fas fa-plus"></i>
                <p>Thêm Mới Chính Sách</p>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="form-add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Mới</h5>
                            <button type="button" class="close" id="close-form-add" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="form">
                                <div class="form-group">
                                    <label for="service_name">Tiêu đề </label>
                                    <input type="text" class="form-control" id="service_name" placeholder="Tiêu đề">
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
                                </div>

                                <div class="form-group">
                                    <label for=""><?= translate_text('Ảnh Đại Diện') ?>:</label>
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

                                <div class="content-service">
                                    <div class="content-service-edit">
                                        <textarea name="content-service-add" id="content_service_add"></textarea>
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
            <p>Danh Sách Chính Sách</p>
        </div>

        <div class="list-service">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tiêu đề chính sách</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>


        <div class="modal fade" id="form-update" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Chính Sách</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-form-update">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="service_name_update">Tiêu đề chính sách</label>
                                <input type="text" class="form-control" id="service_name_update" placeholder="Tiêu đề chính sách">
                            </div>
                            <div class="form-group">
                                <label for="service_description_update">Mô tả</label>
                                <textarea type="text" class="form-control" id="service_description_update"></textarea>
                            </div>

                            <div class="form-group">
                                <label for=""><?= translate_text('Ảnh Đại Diện') ?>:</label>
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

                            <div class="content-service">
                                <div class="content-service-edit">
                                    <textarea name="content_service_update" id="content_service_update"></textarea>
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
    CKEDITOR.replace('content_service_add', {
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


    CKEDITOR.replace('content_service_update', {
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