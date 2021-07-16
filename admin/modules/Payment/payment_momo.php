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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/payment_momo.css">
    <link rel="stylesheet" href="../../resource/select_nice/css/nice-select.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../resource/select_nice/js/jquery.js"></script>
    <script src="../../resource/select_nice/js/jquery.nice-select.min.js" ></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/helper/function.js"></script>
    <script language="javascript" src="../../resource/js/payment_momo.js"></script>
</head>
<body>
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
        <h3>Tìm Kiếm</h3>
    </div>
    
    <div class="search-container container-fluid">
        <div class="select-container pick_website_container col-3">
            <div class="title_pick_website title">
                <h4><?=translate_text('Website')?>: </h4>
            </div>
            <div class="box">
                <select class="pick_website_select">
                </select>
            </div>
        </div>
        <div class=" col-3">
            <label for="searching"><?= translate_text('Hình Thức Thanh Toán')?></label>
            <select id="payment-method" class="form-group">
                <option value="#">All</option>
                <option value="2">Momo</option>
                <option value="1">Thanh Toán Sau Khi Nhận(COD)</option>
            </select>
        </div>
        <div class=" col-2">
            <label for="searching"><?= translate_text('Trạng Thái')?></label>
            <select id="payment-status" class=" form-group">
                <option value="#">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-2 form-group button-search">
            <button id="search_button" class="btn btn-primary" type="button"><?= translate_text('Tìm Kiếm')?></button>
            <button id="clear_button" class="btn btn-danger" type="button"><?= translate_text('Xóa')?></button>
        </div>
        <div class="btn-add">
            <button class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <p>Thêm mới</p>
            </button>
        </div>
    </div>
    <hr>
    <div class="show-payment-container container-fluid">
        <div class="show-payment-container container-fluid">
            <div class="container-fluid title-show-payment">
                <h3><?= translate_text('Danh Sách Hình Thức Thanh Toán')?></h3>
            </div>
            <table class = "table">
                <thead class="table-primary">
                    <tr >
                        <th scope="col" style="width: 30px; text-align: center">No</th>
                        <th scope="col" style="text-align: center;"><?= translate_text('Website')?></th>
                        <th scope="col" style="text-align: center;"><?= translate_text('Hình Thức Thanh Toán')?></th>
                        <th scope="col" style="width: 100px; text-align: center;"><?= translate_text('Partner Code')?></th>
                        <th scope="col" style="width: 100px; text-align: center;"><?= translate_text('Access Key')?></th>
                        <th scope="col" style="width: 100px; text-align: center;"><?= translate_text('Secret Key')?></th>
                        <th scope="col" style="text-align: center;"><?= translate_text('Trạng Thái')?></th>
                        <th scope="col" style="text-align: center;"><?= translate_text('Hành Động')?></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</body>

