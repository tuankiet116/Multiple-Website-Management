<?php 
    require("inc_security.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/categories.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/categories.js"></script>


    <title>Document</title>
</head>

<body>
    <div class="main-content container">
        <div class="pick_website_container">
            <div class="title_pick_website title">
                <h4><?= translate_text('Chọn Trang Web')?>: </h4>
            </div>
            <div class="box">
                <select class="pick_website_select">
                    <option value="">web 1</option>
                    <option value="">web 2</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="categories-container col-lg-6">
                <div class="categories-title title">
                    <h4><?= translate_text('Danh Mục')?>:</h4>
                </div>

                <div class="categories-content">
                    <div class="categories-add ">
                        <i class="fas fa-plus-circle"></i>
                        <p><?= translate_text('thêm mới')?></p>
                    </div>
                    <div class="categories-item">
                        <div class="categories-parent-item">
                            <p>Dịch vụ vệ sinh</p>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="wapper-categories-child">
                            <div class="categories-child-item">
                                <div>
                                    <p>vệ sinh nhà riêng</p>
                                    <div class="categories-child-2">
                                        <p>somthing</p>
                                        <p>some thing</p>
                                        <div class="categories-add" style=" background-color: rgba(62, 103, 214, 0.6);">
                                            <i class="fas fa-plus-circle"></i>
                                            <p><?= translate_text('thêm mới')?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="categories-add " style="background-color: rgba(62, 103, 214, 0.8);">
                                <i class="fas fa-plus-circle"></i>
                                <p><?= translate_text('thêm mới')?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="categories-container-form col-lg-6">
                <div class="categories-container-form-title">
                    <p class="title"><?= translate_text('Mời bạn nhập dữ liệu')?>:</p>
                </div>
                <form method="POST">
                    <div class="form-group">
                        <label for="cmp_name"><?= translate_text('Tên danh mục')?></label>
                        <input type="text" class="form-control" id="cmp_name"  placeholder="...." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="cmp_rewrite_name"><?= translate_text('Tên đường link danh mục')?></label>
                        <input type="text" class="form-control" id="cmp_rewrite_name" placeholder="...." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="cmp_icon"><?= translate_text('icon')?></label>
                        <input type="text" class="form-control" id="cmp_icon" placeholder="...." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="cmp_has_child"><?= translate_text('danh mục con')?></label>
                        <select class="custom-select" id="cmp_has_child">
                            <option value="0">không</option>
                            <option value="1">có</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-check-label" for="cmp_background"><?= translate_text('ảnh cho slide')?></label>
                        <div class="custom-file">
                            <div class="input-image-container">
                                <i class="fas fa-trash-alt"></i>
                                <div class="input-image" id="input_image_background_homepage_1">
                                    <img id="image_background_homepage_1" src="#"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>                                        
                                    <input name="input_background_homepage_1" type="file" class="form-input-image" id="input_background_homepage_1">
                                </div>
                                <p><?= translate_text('Hình 1')?></p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= translate_text('nhập')?></button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>