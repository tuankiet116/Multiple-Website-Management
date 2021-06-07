<?
require_once("inc_security.php")

?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/post_detail.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../resource/ckeditor/ckeditor.js"></script>
    <!-- <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script> -->
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/post_type_detail.js"></script>

</head>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="alert alert-warning alert-dismissible fade alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container-fluid container_post_infor">
        <form class="needs-validation" action="">
            <div class="post_info_title">
                <h3><?= translate_text('Thông Tin Nhóm Bài Viết') ?></h3>
            </div>
            <div class="container-fluid post-info">
                <row class="container-fluid">
                    <div class="form-group form-post col-4">
                        <label for="postTitle"><?= translate_text('Tiêu Đề') ?></label>
                        <input required type="text" class="form-control" id="postTypeTitle" placeholder="<?= translate_text('Nhập Tiêu Đề') ?>">
                        <small class="form-text text-muted"><?= translate_text('Tiêu Đề Phải Là Duy Nhất.') ?></small>
                    </div>

                    <div class="form-group form-post col-4">
                        <label for="postDescription"><?= translate_text('Mô Tả') ?></label>
                        <textarea required type="text" class="form-control" id="postTypeDescription" placeholder="<?= translate_text('Nhập Mô Tả') ?>"></textarea>
                    </div>

                    <!-- <div class="form-group form-post col-4">
                        <label for="metaDescription"><?= translate_text('Kiểu Hiển Thị') ?></label>
                        <textarea required type="text" class="form-control" id="postTypeShow" placeholder="<?= translate_text('Nhập Kiểu Hiển Thị') ?>"></textarea>
                    </div> -->

                    <div class=" form-group form-post col-4">
                        <label><?= translate_text('Chọn Kiểu Hiển Thị') ?></label>
                        <div class="box" style="margin: 0;">
                            <select class="pickPostTypeShow">
                                <option value="grid"> grid </option>
                                <option value="slide"> slide </option>
                                <option value="special"> special </option>
                                <option value="column"> column </option>
                            </select>
                        </div>
                        <small class="form-text text-muted"><?= translate_text('grid: dạng lưới <br> slide: dạng slide <br> special: dạng đặc biệt <br> column: dạng cột') ?></small>
                    </div>
                </row>
                <div class="datetime-container container">

                </div>

                <div class='button-container'>

                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>