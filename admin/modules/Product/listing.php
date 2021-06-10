<? require_once("inc_security.php") ?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/product_listing.css">
    <link rel="stylesheet" href="../../resource/select_nice/css/nice-select.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../../resource/select_nice/js/jquery.js"></script>
    <script src="../../resource/select_nice/js/jquery.nice-select.min.js" ></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/product_listing.js"></script>
</head>

<body>
    <!-- Modal Update -->
    <div class="modal fade " id="Modal" tabindex="-1" 
        role="dialog" 
        aria-labelledby="ModalLabel" 
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="ModalLabel"><?=translate_text('Chỉnh Sửa Sản Phẩm')?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div style="display: flex;">   
                            <div class="form-group col-3">
                                <label for="update-title"><?=translate_text('Tên Sản Phẩm')?></label>
                                <input type="text" class="form-control title" id="update-title" placeholder="<?=translate_text('Tên Sản Phẩm')?>">
                            </div>
                            <div class="form-group col-9">
                                <label for="update-description "><?=translate_text('Mô Tả Sản Phẩm')?></label>
                                <textarea style="min-height: 150px; max-height: 150px;" 
                                type="text" class="form-control description" id="update-description" 
                                placeholder="<?=translate_text('Mô Tả Sản Phẩm')?>"></textarea>
                            </div>
                        </div>
                        
                        <div style="display: flex;">
                            <div class="form-group col-3">
                                <label for="exampleFormControlInput1"><?=translate_text('Giá')?></label>
                                <input type="number" class="form-control price" id="update-price" placeholder="100.000">
                            </div>
                            <div class="form-group col-3">
                                <label><?=translate_text('Tiền Tệ ')?></label>
                                <select class="currency-select" >
                                    <option value="VND">
                                        VND
                                    </option>
                                    <option value="USD">
                                        USD
                                    </option>
                                </select>
                            </div>
                            <div class="form-group form-product-image form-product col-2">
                                <label for="input_banner"><?=translate_text('Ảnh Hiển Thị')?></label>
                                <div class="form-image-input">
                                    <div class="input-image-container">
                                        <i class="fas fa-trash-alt"></i>
                                        <div class="input-image" id="input_image_product_container">
                                            <img id="image_product_update" src="#"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>                                        
                                            <input  type="file" class="form-input-image" id="input_image_product">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="select-container pick_website_container col-4">
                                <div class="title_pick_website title">
                                    <h4><?=translate_text('Chọn Trang Web')?>: </h4>
                                </div>
                                <div class="box">
                                    <select class="website_select">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-update-close" type="button" class="btn-lg btn btn-secondary" data-dismiss="modal"><?=translate_text('Đóng')?></button>
                    <button id="modal-update" type="button" class="btn-lg btn btn-primary"><?=translate_text('Lưu Thay Đổi')?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add New -->
    <div class="modal fade " id="Modal-add" tabindex="-1" 
        role="dialog" 
        aria-labelledby="ModalLabel" 
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="ModalLabel"><?=translate_text('Thêm Sản Phẩm')?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div style="display: flex;">   
                            <div class="form-group col-3">
                                <label for="add-title"><?=translate_text('Tên Sản Phẩm')?></label>
                                <input type="text" class="form-control" id="add-title" placeholder="<?=translate_text('Tên Sản Phẩm')?>">
                            </div>
                            <div class="form-group col-9">
                                <label for="add-description"><?=translate_text('Mô Tả Sản Phẩm')?></label>
                                <textarea style="min-height: 150px; max-height: 150px;" 
                                type="text" class="form-control" id="add-description" 
                                placeholder="<?=translate_text('Mô Tả Sản Phẩm')?>"></textarea>
                            </div>
                        </div>
                        
                        <div style="display: flex;">
                            <div class="form-group col-3">
                                <label for="exampleFormControlInput1"><?=translate_text('Giá')?></label>
                                <input type="number" class="form-control" id="add-price" placeholder="100.000">
                            </div>
                            <div class="form-group col-3">
                                <label><?=translate_text('Tiền Tệ ')?></label>
                                <select class="currency-select" >
                                    <option value="VND">
                                        VND
                                    </option>
                                    <option value="USD">
                                        USD
                                    </option>
                                </select>
                            </div>
                            <div class="form-group form-product-image form-product col-2">
                                <label for="input_banner"><?=translate_text('Ảnh Hiển Thị')?></label>
                                <div class="form-image-input">
                                    <div class="input-image-container">
                                        <i class="fas fa-trash-alt"></i>
                                        <div class="input-image" id="input_image_product_container">
                                            <img id="image_product_add" src="#"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>                                        
                                            <input  type="file" class="form-input-image" id="input_image_product_add">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="select-container pick_website_container col-4">
                                <div class="title_pick_website title">
                                    <h4><?=translate_text('Chọn Trang Web')?>: </h4>
                                </div>
                                <div class="box">
                                    <select class="website_select">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-add-close" type="button" class="btn-lg btn btn-secondary" data-dismiss="modal"><?=translate_text('Đóng')?></button>
                    <button id="modal-add" type="button" class="btn-lg btn btn-primary"><?=translate_text('Thêm')?></button>
                </div>
            </div>
        </div>
    </div>


    <div class="loader-container"><div class="loader"></div></div>
    <div class="alert alert-warning alert-dismissible fade alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">   
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="title-searching container-fluid">
        <h3>Tìm Kiếm Sản Phẩm</h3>
    </div>
    
    <div class="search-container container-fluid">
        <div class="select-container pick_website_container col-3">
            <div class="title_pick_website title">
                <h4><?=translate_text('Chọn Trang Web')?>: </h4>
            </div>
            <div class="box">
                <select class="pick_website_select">
                </select>
            </div>
        </div>
        <div class="form-group col-3">
            <label for="searching"><?= translate_text('Tìm Kiếm')?></label>
            <input type="text" class="form-control" id="searching" placeholder="<?= translate_text('Tìm')?>">
        </div>
        <div class="col-2">
            <label for="searching"><?= translate_text('Trạng Thái Sản Phẩm')?></label>
            <select id="product-status" class=" form-group">
                <option value="#">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div> 
        <div class="col-2 form-group button-search">
            <button id="search_button" class="btn btn-primary" type="button"><?= translate_text('Tìm')?></button>
            <button id="clear_button" class="btn btn-danger" type="button"><?= translate_text('Xóa')?></button>
        </div>
    </div>
    <div class="search-container container-fluid">
        <div class="col-2 form-group button-search">
            <button id="add-new" class="btn btn-primary" data-toggle="modal" data-target="#Modal-add"
            type="button">
                <i class="fas fa-plus-circle"></i><?= translate_text('Thêm Sản Phẩm')?>
            </button>
        </div>
    </div>

    
    <hr>
    <div class="show-product-container container-fluid">
        <div class="container-fluid title-show-product">
            <h3><?= translate_text('Danh Sách Sản Phẩm')?></h3>
        </div>
        <table class = "table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col"><?= translate_text('Tên Sản Phẩm')?></th>
                    <th scope="col"><?= translate_text('Mô Tả')?></th>
                    <th scope="col"><?= translate_text('Hình Ảnh')?></th>           
                    <th scope="col"><?= translate_text('Giá Cả')?></th>
                    <th scope="col"><?= translate_text('Tiền Tệ')?></th>
                    <th scope="col"><?= translate_text('Website')?></th>
                    <th scope="col"><?= translate_text('Trạng Thái')?></th>
                    <th scope="col"><?= translate_text('Hành Động')?></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</body>