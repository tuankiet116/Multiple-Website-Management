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
    <link rel="stylesheet" href="../../resource/css/service_group.css">
    <link rel="stylesheet" href="../../resource/select_nice/css/nice-select.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../../resource/select_nice/js/jquery.js"></script>
    <script src="../../resource/select_nice/js/jquery.nice-select.min.js" ></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/service_group.js"></script>

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
        <div class="wrapper-header">
            <div class="pick_website_container">
                <div class="title_pick_website title-pick">
                    <i class="fas fa-caret-right"></i>
                    <h4><?= translate_text('Nhóm Dịch Vụ theo trang web')?>: </h4>
                </div>
                <div class="box">
                    <select class="pick_website_select">
                    </select>
                </div>
            </div>

            <div class="add-service-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"  id="btn-add">
                    <i class="fas fa-plus"></i>Thêm mới
                </button>
    
                <div class="modal fade" id="addModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Thêm Nhóm Dịch Vụ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-addModal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-container">
                                    <form id="form" action="#">
                                        <div class="form-group">
                                            <label for="name-service-group"><?= translate_text('Tên Nhóm Sản Phẩm')?>:</label>
                                            <input type="text" class="form-control" id="name-service-group" placeholder="Nhập Tên Nhóm Dịch Vụ" name="name-service-group" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="description-service-group"><?= translate_text('Mô Tả')?>:</label>
                                            <input type="text" class="form-control" id="description-service-group" placeholder="Nhập Mô tả" name="description-service-group" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <div class="pick_website_container fiximg" style="width: 100%">
                                                <div class="title_pick_website title-pick">
                                                    <h4><?= translate_text('Chọn Trang Web')?>: </h4>
                                                </div>
                                                <div class="box" style="padding: 0">
                                                    <select class="pick_website_select_add" style="width: 100%;">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit-add" id="submit-add">Thêm Mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="title">
            <h3>Danh Sách Nhóm Dịch Vụ</h3>
        </div>


        <div class="list-service-group">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Website</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody id ="data-service-group">
                </tbody>
            </table>


            <div class="modal fade" id="updateModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Cập Nhật Nhóm Dịch Vụ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-updateModal">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-container">
                                <form id="form-update" action="#">
                                    <div class="form-group">
                                        <label for="name-product-group-update"><?= translate_text('Tên Nhóm Sản Phẩm')?>:</label>
                                        <input type="text" class="form-control" id="name-service-group-update" placeholder="Nhập Tên Nhóm Dịch Vụ" name="name-service-group-update" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="description-product-group-update"><?= translate_text('Mô Tả')?>:</label>
                                        <textarea type="text" class="form-control" id="description-service-group-update" placeholder="Nhập Mô tả" name="description-service-group-update" autocomplete="off"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit-update" id="submit-update">Cập Nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>