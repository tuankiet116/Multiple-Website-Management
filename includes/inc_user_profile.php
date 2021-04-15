<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tài khoản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ACC_URL ?>">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Tài khoản</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="data:image/png;base64,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"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $myuser->use_name ?></h3>

                            <p class="text-muted text-center"><?= $myuser->use_code ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Số chứng minh</b> <a class="float-right"><?= $myuser->use_idnumber ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Giới tính</b> <a class="float-right"><?= @$gender_list[$myuser->use_gender] ?></a>
                                </li>
                            </ul>
                            <div class="link_logout">
                                <a href="/logout" title="Thoát" class="icon_logout"><i class="fa fa-power-off" aria-hidden="true"></i> Thoát</a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Trường</strong>

                            <p class="text-muted">
                                <?=showUserSchool($myuser->array_info_user["use_school_id"])?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-book mr-1"></i> Khoa</strong>

                            <p class="text-muted"><?=showUserFaculty($myuser->array_info_user["use_faculty_id"])?></p>

                            <hr>

                            <strong><i class="fas fa-book mr-1"></i> Lớp</strong>

                            <p class="text-muted"><?=showUserClass($myuser->array_info_user["use_class_id"])?></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Cập nhật ảnh</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Cài đặt</a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <?
                                        $db_question = new db_query("SELECT *
                                                                     FROM questions
                                                                     LEFT JOIN users_photos ON(up_user_id = " . $myuser->u_id . " AND up_question_id = que_id)
                                                                     WHERE que_active = 1
                                                                     ORDER BY que_stt ASC");
                                        while($rowQuestion = mysqli_fetch_assoc($db_question->result)){
                                            $pictureDemoURL = "/data/questions/" . $rowQuestion["que_img_example"];
                                        ?>
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-camera bg-blue"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-header">
                                                        <strong style="color: #007bff;">Kiểu ảnh <?=$rowQuestion["que_stt"]?></strong><? if($rowQuestion["que_required"] == 1){ ?> (<span class="text-danger">*</span>)<? } ?>: <?=$rowQuestion["que_content"]?>
                                                    </div>

                                                    <div class="timeline-body row">
                                                        <div class="col-md-6">
                                                            <div class="demo_picture">
                                                                <div class="image">
                                                                    <img id="demo_<?=$rowQuestion["que_id"]?>" src="<?=$pictureDemoURL?>">
                                                                </div>
                                                            </div>
                                                            <div class="name" style="padding: 10px; text-align: center">Ảnh mẫu</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="user_picture">
                                                                <div class="image">
                                                                    <?
                                                                    $pictureURL = "/images/photo.png";
                                                                    if($rowQuestion["up_picture"] != ""){
                                                                        $uPath = str_pad(intval($rowQuestion["up_user_id"]), 2, '0', STR_PAD_LEFT);
                                                                        $pictureURL = "/data/users/" . $uPath . "/" . $rowQuestion["up_picture"];

                                                                    }
                                                                    ?>
                                                                    <img id="img_<?=$rowQuestion["que_id"]?>" src="<?=$pictureURL?>">
                                                                </div>
                                                                <div class="upload" id="uploading_img_<?=$rowQuestion["que_id"]?>"><img src="/images/loading_process.gif" width="50" /></div>
                                                            </div>
                                                            <div class="upload" style="padding: 10px; text-align: center">
                                                                <input title="Upload ảnh" class="file-upload" type="file" onchange="updatePicture('img_<?=$rowQuestion["que_id"]?>', this)" accept="image/*">
                                                                Tải lên ảnh của bạn &nbsp; <i class="fa fa-upload"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                        <?
                                        } // End while
                                        ?>

                                        <div><i class="fas fa-check bg-blue"></i></div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <h2>Đổi mật khẩu</h2>

                                    <form class="form-horizontal needs-validation" action="" id="logout-form" novalidate onsubmit="updateUserPassword(); return false">
                                        <div class="form-group row">
                                            <label for="inputOldPassword" class="col-sm-3 col-form-label">Mật khẩu cũ</label>

                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="inputOldPassword"
                                                       placeholder="Nhập mật khẩu cũ" required>
                                                <div class="invalid-feedback">Vui lòng nhập Mật khẩu cũ.</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputNewPassword" class="col-sm-3 col-form-label">Mật khẩu mới</label>

                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="inputNewPassword"
                                                       placeholder="Nhập mật khẩu mới" required>
                                                <div class="invalid-feedback">Vui lòng nhập Mật khẩu mới.</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputConfirmNewPassword" class="col-sm-3 col-form-label">Nhập lại mật khẩu mới</label>

                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="inputConfirmNewPassword"
                                                       placeholder="Nhập lại mật khẩu mới" required>
                                                <div class="invalid-feedback">Vui lòng nhập lại Mật khẩu mới.</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <input type="hidden" action="update_info"/>
                                                <button type="submit" class="btn btn-danger">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    /**
     * updatePicture
     * @param id
     * @param obj
     */
    function updatePicture(id, obj) {
        var userImage = document.querySelector('img[id=' + id + ']');
        var userImageUploading = $('#uploading_' + id);
        var oldSrc = userImage.src;
        var file = obj.files[0];
        var reader = new FileReader();
        reader.onload = function (event) {
            userImage.src = reader.result;
            userImageUploading.fadeIn();

            var $data = {'name': id, 'file': reader.result};
            $.ajax({
                type: 'POST',
                url: '/ajax/update_user_picture.php',
                data: $data,
                dataType: "json",
                success: function (response) {
                    if (response.code === 0) {
                        showAndDismissAlert("danger", response.msg);
                        userImage.src = oldSrc;
                    }else{
                        userImageUploading.hide();
                        showAndDismissAlert("info", "Bạn đã tải ảnh lên thành công!");
                    }
                },
                error: function (response) {
                    userImage.src = oldSrc;
                    showAndDismissAlert("danger", "Có lỗi xảy ra khi thực hiện. Vui lòng thử lại.");
                }

            });

        };
        reader.readAsDataURL(file);
    }

    /**
     * updateUserPassword
     */
    function updateUserPassword(){

        var forms =$("#logout-form");
        var validation = Array.prototype.filter.call(forms, function(form) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }else{

                $inputOldPassword       = $("#inputOldPassword").val();
                $inputNewPassword       = $("#inputNewPassword").val();
                $inputConfirmNewPassword = $("#inputConfirmNewPassword").val();

                if($inputConfirmNewPassword != $inputNewPassword){
                    showAndDismissAlert("danger", "Mật khẩu mới và Mật khẩu xác nhận không trùng khớp. Vui lòng thử lại!");
                    return false;
                }

                var $data = {'inputOldPassword': $inputOldPassword, 'inputNewPassword': $inputNewPassword};

                $.ajax({
                    type: 'POST',
                    url: '/ajax/update_user_password.php',
                    data: $data,
                    dataType: "json",
                    success: function (response) {
                        if (response.code === 0) {
                            showAndDismissAlert("danger", response.msg);
                        }else{
                            showAndDismissAlert("success", "Cập nhật mật khẩu mới thành công. Bạn cần đăng nhập lại để tiếp tục!");
                            setTimeout(function () {
                                window.location.href = "/login";
                            }, 2000);
                        }
                    }

                });
            }
            form.classList.add('was-validated');
        });

        return false;
    }
</script>