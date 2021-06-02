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
        <script language="javascript" src="../../resource/js/add_post.js"></script>

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
                        <h4><?=translate_text('Chọn Trang Web')?>: </h4>
                    </div>
                    <div class="box">
                        <select class="pick_website_select">
                        </select>
                    </div>
                </div>
                <div class="select-container col-3">
                    <div class="title">
                        <h4><?=translate_text('Chọn Danh Mục')?>: </h4>
                    </div>
                    <div class="box">
                        <img class="image-loading" src="../../../Bean Eater-1s-200px.gif">
                        <select class="pick_categories" disabled>
                        </select>
                    </div>
                </div>

                <div class="select-container col-3">
                    <div class="title">
                        <h4><?=translate_text('Chọn Nhóm Bài Viết')?>: </h4>
                    </div>
                    <div class="box">
                        <img class="image-loading-post-type" style="display: none;" src="../../../Bean Eater-1s-200px.gif">
                        <select class="pick_post_type" disabled>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container-fluid container_post_infor">
                <form class="needs-validation" novalidate action="" >
                    <div class="post_info_title">
                        <h3><?=translate_text('Thông Tin Bài Viết')?></h3>
                    </div>
                    <div class="container-fluid post-info">
                        <row class="container-fluid">
                            <div class="form-group form-post col-3">
                                <label for="postTitle"><?=translate_text('Tiêu Đề')?></label>
                                <input disabled required type="text" class="form-control" id="postTitle" placeholder="<?=translate_text('Nhập Tiêu Đề')?>">
                                <small class="form-text text-muted"><?=translate_text('Tiêu Đề Phải Là Duy Nhất.')?></small>
                            </div>

                            <div class="form-group form-post col-4">
                                <label for="postDescription"><?=translate_text('Mô Tả')?></label>
                                <textarea disabled required type="text" class="form-control" id="postDescription" placeholder="<?=translate_text('Nhập Mô Tả')?>"></textarea>
                            </div>
                            
                            <div class="form-group form-post col-3">
                                <label for="metaDescription"><?=translate_text('Mô Tả Meta')?></label>
                                <textarea disabled required type="text" class="form-control" id="metaDescription" placeholder="<?=translate_text('Nhập Mô Tả')?>"></textarea>
                                <small class="form-text text-muted"><?=translate_text('Mô Tả Cần Được Tối Ưu.')?></small>
                            </div>

                            <div class="form-group form-post col-2">
                                <label for="postColorBackground"><?=translate_text('Màu Nền')?></label>
                                <input disabled type="color" value="#ffffff" class="form-control" id="postColorBackground" placeholder="<?=translate_text('Chọn Màu')?>">
                            </div>
                        </row>

                        <row class="container-fluid">
                            

                            <div class="form-group form-post col-3">
                                <label for="rewriteName"><?=translate_text('Rewrite Name')?></label>
                                <textarea disabled required type="text" class="form-control" id="rewriteName" placeholder="<?=translate_text('Nhập Rewrite Name')?>"></textarea>
                            </div>
                            
                            <div class="form-group form-post-image form-post col-2">
                                <label for="input_banner"><?=translate_text('Ảnh Hiển Thị')?></label>
                                <div class="form-image-input">
                                    <div class="input-image-container">
                                        <i class="fas fa-trash-alt"></i>
                                        <div class="input-image" id="input_image_post_container">
                                            <img id="image_post" src="#"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>                                        
                                            <input disabled type="file" class="form-input-image" id="input_image_post">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" form-group form-post col-3">
                                <label><?=translate_text('Chọn Sản Phẩm Liên Kết')?></label>
                                <div class="box" style="margin: 0;">
                                    <select disabled class="pick_product">
                                    </select>
                                </div>
                            </div>
                        </row>

                    </div>
                    <hr>
                    <div class="container-editor container">
                        <div class="editor-form-title">
                            <h3><?=translate_text('Tạo Bài Viết')?></h3>
                        </div>
                        <!-- (2): textarea sẽ được thay thế bởi CKEditor -->
                        <!-- <textarea name = 'post' id = 'post_editor' class="form-control ckeditor"></textarea> -->
                        <div class="editor-form">
                            <textarea name = 'post_editor' id = 'post_editor' class="form-control"></textarea>
                        </div>
                        <div class='button-container'>
                            <input disabled id="submit_button" class="btn btn-primary  btn-lg " type="submit" value="<?= translate_text('Thêm Bài Viết')?>">
                            <input id="clear_button" class="btn btn-danger  btn-lg " type="button" value="<?= translate_text('Xóa')?>">
                        </div>
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
<script>
    CKEDITOR.replace('post_editor', {
        extraPlugins: 'image2,uploadimage',
        removePlugins: 'image',

        toolbar: [{
                name: 'clipboard',
                items: ['Undo', 'Redo']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink']
            },
            {
                name: 'insert',
                items: ['Image', 'Table']
            },
            {
                name: 'tools',
                items: ['Maximize']
            },
            {
                name: 'editing',
                items: ['Scayt']
            }
        ],
        width: 900,
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