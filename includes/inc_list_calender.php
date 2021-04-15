<style>
    .form_filter_calender {
        display: grid;
        grid-template-columns: 14% 14% 14% 14% 14% 14% 14%;
        -webkit-box-pack: justify;
        justify-content: space-between;
        margin: 10px 0;
        width: 100%;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách Lịch Daily</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách Lịch Daily</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-12">
            <div class="card">
        <div class="card-body">
        <table id="example2" class="table table-striped table-bordered table-hover">
        <thead>
        <tr style="text-align: center">
            <th>Mã lịch</th>
            <th>Tên lịch</th>
            <th>Thời gian hoạt động</th>
            <th>Giờ điểm danh</th>
            <th>Chi tiết</th>
            <th>Chỉnh sửa</th>
        </tr>
        </thead>
        <tbody>
        <?
        $db_calendar    = new db_query("SELECT * FROM calender WHERE cal_user_id=" . $myuser->u_id);
        while($row = mysqli_fetch_assoc($db_calendar->result)){
        ?>
            <tr>
                <td><?=$row["cal_code"]?></td>
                <td><?=$row["cal_name"]?></td>
                <td>
                    <?
                    if($row["cal_weekday"] == "0" || $row["cal_weekday"] == "1"){
                        echo "Tất cả các ngày";
                    }else{
                        $arrTmp = explode(",", $row["cal_weekday"]);
                        foreach($arrTmp as $day){
                            if(intval($day) > 1){
                                echo "Thứ " . intval($day) . ", ";
                            }
                        }
                    }
                    ?>
                </td>
                <td style="text-align: right"><?=$row["cal_checkin_time"]?> H</td>
                <td style="text-align: center"><a href="/historycalender/<?=$row["cal_id"]?>"><i class="fas fa-eye"></i></a></td>
                <td style="text-align: center"><a href="/editcalender/<?=$row["cal_id"]?>"><i class="fas fa-edit"></i></a></td>
            </tr>
        <?
        }
        $db_calendar->close();
        unset($db_calendar);
        ?>
        </tbody>
        <tfoot>
        <tr style="text-align: center">
            <th>Mã lịch</th>
            <th>Tên lịch</th>
            <th>Thời gian hoạt động</th>
            <th>Giờ điểm danh</th>
            <th>Chi tiết</th>
            <th>Chỉnh sửa</th>
        </tr>
        </tfoot>
        </table>
        </div>
        <!-- /.card-body -->
        </div>
            <!-- /.card -->
        </div>
    </div>
    </section>
</div>
<!-- DataTables -->
<script src="/dist/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/dist/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/dist/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>