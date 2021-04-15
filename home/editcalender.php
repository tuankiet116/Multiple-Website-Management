<?php
require_once("config.php");
ob_start("callback");

if ($myuser->u_id <= 0) {
    redirect(LOGIN_URL);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hệ thống điểm danh sinh viên | Chỉnh sửa Lịch</title>
    <? include("../includes/inc_head.php"); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <? include("../includes/inc_top_menu.php"); ?>
    <? include("../includes/inc_left_menu.php"); ?>
    <? include("../includes/inc_edit_calender.php"); ?>
</div>
<? include("../includes/inc_footer.php"); ?>
<script type="text/javascript">
    function addCalendar() {
        var forms = $("#add-calendar-form");
        var validation = Array.prototype.filter.call(forms, function (form) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                forms.submit();
            }
            form.classList.add('was-validated');
        });

        return false;
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Chọn ngày trong tuần
        $('#weekdays').select2({
            multiple: true,
            tags: false
        });

        // Tìm kiếm người dùng để thêm vào lịch
        $('#object').select2({
            placeholder: 'Tìm kiếm sinh viên & giáo viên',
            allowClear: true,
            ajax: {
                url: '/ajax/search_student.php',
                data: function (params) {
                    let query = {
                        q: params.term
                    };
                    return query;
                },
                dataType: 'json',
                processResults: function (result) {
                    result.map(
                        i => {
                            i.text = i.use_name + '(#' + i.use_code + ')';
                            i.id = i.use_id;
                        }
                    );

                    return {
                        results: result
                    };
                }
            }
        }).on('select2:select', function (e) {
            if (e.params._type === "select") {
                let isset = false;
                $('#show-object input[name=object]').each((k, i)=> {
                    if(e.params.data.use_id == $(i).val()) {
                        isset = true;
                    }
                });
                if(!isset) {
                    $('#show-object').append(`<div class="item"> <i class="fa fa-trash" style="color: red;margin-right: 10px;font-size: 12px;"></i><i>${e.params.data.use_name} (#${e.params.data.use_code})</i><input type="hidden" name="object[]" value="${e.params.data.use_id}" /></div>`);
                }
            }
        });

        $(document).on('click', '#show-object .fa-trash', function() {
            $(this).parents('.item').remove();
        });

        $('#checkinTime').timepicker({
            timeFormat: 'H:mm',
            interval: 60,
            defaultTime: '<?=$checkinTime?>',
            startTime: '6:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
<? if ($errors != "") { ?>
    <script type="text/javascript">toastr.error("<?=$errors?>");</script>
<? } ?>
</body>
</html>
<?php
ob_end_flush();
?>
