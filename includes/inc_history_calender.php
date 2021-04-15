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
                    <h1>Lịch sử điểm danh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Lịch sử điểm danh</li>
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
            <th>Sinh viên</th>
            <th>Giờ điểm danh</th>
        </tr>
        </thead>
        <tbody>
        <?
        $record_id = getValue("record_id");
        $db_calendar    = new db_query("SELECT *
                                        FROM user_calender_history
                                        STRAIGHT_JOIN calender ON(cal_id = uch_calender_id)
                                        STRAIGHT_JOIN users ON(use_id = cal_user_id)
                                        WHERE uch_calender_id=" . $record_id);

        while($row = mysqli_fetch_assoc($db_calendar->result)){
        ?>
            <tr>
                <td><?=$row["cal_code"]?></td>
                <td><?=$row["cal_name"]?></td>
                <td><?=$row["use_name"]?></td>
                <td style="text-align: right"><?=date("d/m/Y H:i:s",$row["uch_time"])?></td>
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
            <th>Sinh viên</th>
            <th>Giờ điểm danh</th>
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