<? require_once("inc_security.php") ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
            </div>
            
            <div class="container-editor container">
                <form action="" method="post">
                    <!-- (2): textarea sẽ được thay thế bởi CKEditor -->
                    <!-- <textarea name = 'post' id = 'post_editor' class="form-control ckeditor"></textarea> -->
                    <div class="editor-form">
                        <textarea name = 'post_editor' id = 'post_editor' class="form-control"></textarea>
                    </div>
                    <div class='button-container'>
                        <input id="submit_button" class="btn btn-primary  btn-lg " type="submit" value="<?= translate_text('Thêm Bài Viết')?>">
                        <input id="clear_button" class="btn btn-danger  btn-lg " type="button" value="<?= translate_text('Xóa')?>">
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
        width: 1000,
        height: 600,

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