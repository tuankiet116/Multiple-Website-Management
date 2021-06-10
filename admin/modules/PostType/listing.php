<? require_once("inc_security.php") ?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/listing_post.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../resource/ckeditor/ckeditor.js"></script>
    <!-- <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script> -->
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/listing_postType.js"></script>

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
    <div class="title-searching container-fluid">
        <h3>Tìm Kiếm</h3>
    </div>

    <div class="search-container container-fluid">
        <div class="select-container pick_website_container col-3">
            <div class="title_pick_website title">
                <h4><?= translate_text('Chọn Trang Web') ?>: </h4>
            </div>
            <div class="box">
                <select class="pick_website_select">
                </select>
            </div>
        </div>
        <div class="form-group col-3">
            <label for="searching"><?= translate_text('Tìm Kiếm') ?></label>
            <input type="text" class="form-control" id="searching" placeholder="<?= translate_text('Tìm') ?>">
        </div>
        <div class="col-2 form-group button-search">
            <button id="search_button" class="btn btn-primary" type="button"><?= translate_text('Tìm') ?></button>
            <button id="clear_button" class="btn btn-danger" type="button"><?= translate_text('Xóa') ?></button>
        </div>
    </div>
    <hr>
    <div class="show-post-container container-fluid">
        <div class="container-fluid title-show-post">
            <h3><?= translate_text('Danh Sách Nhóm Bài Viết') ?></h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col"><?= translate_text('Tiêu Đề') ?></th>
                    <th scope="col"><?= translate_text('Mô Tả') ?></th>
                    <th scope="col"><?= translate_text('Kiểu Bài Viết') ?></th>
                    <th scope="col"><?= translate_text('Website') ?></th>
                    <th scope="col"><?= translate_text('Danh mục') ?></th>
                    <th scope="col"><?= translate_text('Trạng Thái') ?></th>
                    <th scope="col"><?= translate_text('Hiển Thị Trang Chủ') ?></th>
                    <th scope="col"><?= translate_text('Hành Động') ?></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</body>