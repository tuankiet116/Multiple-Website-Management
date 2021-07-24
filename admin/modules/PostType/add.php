<? require_once("inc_security.php") ?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/add_post.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../resource/ckeditor/ckeditor.js"></script>
    <!-- <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script> -->
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/add_postType.js"></script>

</head>

<body>
    <div class="alert alert-warning alert-dismissible fade alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="alert alert-warning alert-dismissible fade alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="main_container">
        <div class="choose-container container-fluid">
            <div class="select-container pick_website_container col-3">
                <div class="title_pick_website title">
                    <h4><?= translate_text('Chọn Trang Web') ?>: </h4>
                </div>
                <div class="box">
                    <select class="pick_website_select">
                    </select>
                </div>
            </div>
            <div class="select-container col-3">
                <div class="title">
                    <h4><?= translate_text('Chọn Danh Mục') ?>: </h4>
                </div>
                <div class="box">
                    <img class="image-loading" src="../../../Bean Eater-1s-200px.gif">
                    <select class="pick_categories" disabled>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid container_post_infor">
            <form class="needs-validation" novalidate action="">
                <div class="post_info_title">
                    <h3><?= translate_text('Thông Tin Nhóm Bài Viết') ?></h3>
                </div>
                <div class="container-fluid post-info">
                    <row class="container-fluid">
                        <div class="form-group form-post col-4">
                            <label for="postTitle"><?= translate_text('Tiêu Đề') ?></label>
                            <input disabled required type="text" class="form-control" id="postTypeTitle" placeholder="<?= translate_text('Nhập Tiêu Đề') ?>" style="font-size: 11.5px">
                            <small class="form-text text-muted"><?= translate_text('Tiêu Đề Phải Là Duy Nhất.') ?></small>
                        </div>

                        <div class="form-group form-post col-4">
                            <label for="postDescription"><?= translate_text('Mô Tả') ?></label>
                            <textarea disabled required type="text" class="form-control" id="postTypeDescription" placeholder="<?= translate_text('Nhập Mô Tả') ?>" style="font-size: 11.5px"></textarea>
                        </div>

                        <div class=" form-group form-post col-4">
                            <label><?= translate_text('Chọn Kiểu Hiển Thị') ?></label>
                            <div class="box" style="margin: 0;">
                                <select disabled class="pick_show" name="state">
                                    <option value="grid"> grid </option>
                                    <option value="slide"> slide </option>
                                    <option value="special"> special </option>
                                    <option value="column"> column </option>
                                </select>
                            </div>
                            <small class="form-text text-muted"><?= translate_text('grid: dạng lưới <br> slide: dạng slide <br> special: dạng đặc biệt <br> column: dạng cột') ?></small>
                        </div>

                    </row>

                    <row class="container-fluid">
                        <div class=" form-group form-post col-4">
                            <label><?= translate_text('Trạng Thái Nhóm Bài Viết') ?></label>
                            <div class="box" style="margin: 0;">
                                <select disabled class="pick_active" name="state">
                                    <option value="1"> <?= translate_text('Kích Hoạt') ?> </option>
                                    <option value="0"> <?= translate_text('Vô Hiệu Hóa') ?> </option>
                                </select>
                            </div>
                        </div>

                        <div class=" form-group form-post col-4">
                            <label><?= translate_text('Hiển Thị Trang Chủ') ?></label>
                            <div class="box" style="margin: 0;">
                                <select disabled class="pick_allow_show" name="state">
                                    <option value="1"> <?= translate_text('Hiển Thị') ?> </option>
                                    <option value="0"> <?= translate_text('Không Hiển Thị') ?> </option>
                                </select>
                            </div>
                        </div>
                    </row>

                </div>
                <hr>
                <div class='button-container'>
                    <input disabled id="submit_button" class="btn btn-primary  btn-lg " type="submit" value="<?= translate_text('Thêm Bài Viết') ?>">
                    <input id="clear_button" class="btn btn-danger  btn-lg " type="button" value="<?= translate_text('Xóa') ?>">
                </div>
            </form>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>