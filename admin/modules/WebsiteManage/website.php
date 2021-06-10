<?php 
    require("inc_security.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/websiteManage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/websiteManage.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="btn-show-modal">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#show-modal-form">
                <i class="fas fa-plus"></i> Thêm mới 
            </button>
        </div>
        <div class="modal fade" id="show-modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cài Đặt Website</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-container">
                            <form action="#" id="form">
                                <div class="form-group">
                                    <label for="web_name"><?= translate_text('Tên Website')?>:</label>
                                    <input type="text" class="form-control" id="web_name" placeholder="Nhập Tên Website" name="web_name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="web_url"><?= translate_text('Tên Miền Website')?>:</label>
                                    <input type="text" class="form-control" id="web_url" placeholder="Nhập Tên Miền Website" name="web_url" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for=""><?= translate_text('icon website')?>:</label>
                                    <div class="customs-file">
                                        <div class="input-image-container">
                                            <i class="fas fa-trash-alt"></i>
                                            <div class="input-image" id="input_image_icon_1">
                                                <img id="image_icon_1" src="#"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>                                        
                                                <input name="input_icon_1" type="file" class="form-input-image" id="input_icon_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="web_description"><?= translate_text('Mô Tả')?>:</label>
                                    <textarea class="form-control" id="web_description" name="web_description"></textarea>
                                </div>
                                <div class="form-group btn-submit">
                                    <input id="submit" class="btn btn-primary" type="submit" value="Thêm Mới">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="list-website-container">
            <div class="list-website-title">
                <p>Danh Sách Website</p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Tên Miền</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><p class="web_name">Dịch vụ vệ sinh</p></td>
                        <td><p class="web_url">dichvuvesinh.com.vn</p></td>
                        <td><img src="https://cdn.chanhtuoi.com/uploads/2020/10/w400/logo-zalo-png-vertor-jpeg.jpg.webp" alt="icon" class="icon-website"></td>
                        <td><p class="web_description">Lorem ipsum dolor sit amet consectetur?</p></td>
                        <td><button class="btn btn-success">Hiển Thị</button></td>
                        <td><button class="btn btn-warning">Sửa</button></td>
                    </tr>
                </tbody>
            </table>
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