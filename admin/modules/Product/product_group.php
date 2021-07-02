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
    <link rel="stylesheet" href="../../resource/css/product_group.css">
    <link rel="stylesheet" href="../../resource/select_nice/css/nice-select.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../../resource/select_nice/js/jquery.js"></script>
    <script src="../../resource/select_nice/js/jquery.nice-select.min.js" ></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/product_group.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">

        <div class="add-product-group">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus"></i>Thêm mới
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm Nhóm Sản Phẩm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-container">
                                <form id="form" action="#">
                                    <div class="form-group">
                                        <label for="name-product-group"><?= translate_text('Tên Nhóm Sản Phẩm')?>:</label>
                                        <input type="text" class="form-control" id="name-product-group" placeholder="Nhập Tên Nhóm Sản Phẩm" name="name-product-group">
                                    </div>
                                    <div class="form-group">
                                        <label for="description-product-group"><?= translate_text('Mô Tả')?>:</label>
                                        <input type="text" class="form-control" id="description-product-group" placeholder="Nhập Mô tả" name="description-product-group">
                                    </div>
                                    <div class="form-group-btn">
                                        <button type="submit" class="btn btn-primary">Thêm Mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="title">
            <h3>danh sách nhóm bài viết</h3>
        </div>
    </div>
</body>
</html>