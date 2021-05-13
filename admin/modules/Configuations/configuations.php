<?
    require("inc_security.php");
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../resource/css/configuations.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/configuationsModule.js"></script>
</head>

<body>
    <div class="main_container">
        <div class="pick_website_container">
            <div class="title_pick_website title">
                <h4><?=translate_text('Chọn Trang Web')?>: </h4>
            </div>
            <div class="box">
                <select class="pick_website_select" style="width: 20%;">
                </select>
            </div>
        </div>
        <div class="configuations_container">
            <div class="title_configuations title">
                <h4><?=translate_text('Chỉnh Sửa')?>: </h4>
            </div>

            <div class="configuations">
                <form>
                    <div class="form-group form-configuations">
                        <label for="PageSize"><?=translate_text('Kích Cỡ Trang')?></label>
                        <input type="number" class="form-control" id="input-page-size" placeholder="<?=translate_text('Thêm Kích Cỡ Trang')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="LeftSize"><?=translate_text('Kích Cỡ Bên Trái')?></label>
                        <input type="number" class="form-control" id="input-left-size" placeholder="<?=translate_text('Thêm Kích Cỡ Bên Trái')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="RightSize"><?=translate_text('Kích Cỡ Bên Phải')?></label>
                        <input type="number" class="form-control" id="input-right-size" placeholder="<?=translate_text('Thêm Kích Cỡ Bên Phải')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="AdminEmail"><?=translate_text('Admin Email')?></label>
                        <input type="email" class="form-control" id="input-admin-email" placeholder="<?=translate_text('Thêm Admin Email')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="SiteTitle"><?=translate_text('Tiêu Đề Website')?></label>
                        <input type="text" class="form-control" id="input-site-title" placeholder="<?=translate_text('Thêm Tiêu Đề')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="MetaDescription"><?=translate_text('Meta Description')?></label>
                        <input type="text" class="form-control" id="input-meta-description" placeholder="<?=translate_text('Meta Description')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="MetaKeyword"><?=translate_text('Meta Keyword')?></label>
                        <input type="text" class="form-control" id="input-meta-keyword" placeholder="<?=translate_text('Meta Keyword')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="Currency"><?=translate_text('Đơn Vị Tiền Tệ')?></label>
                        <input type="text" class="form-control" id="input-currency" placeholder="<?=translate_text('Thêm Đơn Vị Tiền Tệ')?>">
                    </div>
                    <div class="form-group form-configuations">
                        <label for="Language"><?=translate_text('Ngôn Ngữ')?></label>
                        <select class="pick_language" style="width: 20%;"></select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</body>