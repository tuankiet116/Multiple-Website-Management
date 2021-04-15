<?php
require_once("lang.php");
$action = getValue("action", "str", "POST", "");

$arrSchools = array();
$list_schools = new db_query("SELECT * FROM schools WHERE sch_active = 1");
while($row = mysqli_fetch_assoc($list_schools->result)){
    $arrSchools[] = $row;
}
unset($list_schools);

if ($action == "export") {

    $excel = new PHPExcel();
    $excel->setActiveSheetIndex(0);

    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

    $excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
    $excel->getActiveSheet()->getStyle('A1:E1')->getAlignment();

    //Vị trí có dạng như sau:
    $excel->getActiveSheet()->setCellValue('A1', 'Mã sinh viên');
    $excel->getActiveSheet()->setCellValue('B1', 'Họ và tên');
    $excel->getActiveSheet()->setCellValue('C1', 'Chứng minh thư');
    $excel->getActiveSheet()->setCellValue('D1', 'Giới tính');
    $excel->getActiveSheet()->setCellValue('E1', 'Ngày sinh');

    $numRow = 2;
    $db_listing = new db_query("SELECT * FROM " . $fs_table);
    while ($row = mysqli_fetch_assoc($db_listing->result)) {
        $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['use_code']);
        $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['use_name']);
        $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['use_idnumber']);
        $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['use_gender'] == 1 ? "Nam" : "Nữ");
        $excel->getActiveSheet()->setCellValue('E' . $numRow, date("m/d/Y", $row['use_birthdays']));
        $numRow++;
    }
    unset($db_listing);

    // Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
    header('Content-Disposition: attachment; filename="excel_epu.xlsx"');
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?= $load_header ?>
    <?php
    //add form for javacheck
    $myform->addFormname("add");
    $myform->checkjavascript();
    //chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
    $myform->evaluate();
    $fs_errorMsg .= $myform->strErrorField;

    ?>
</head>

<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
    <!-- Modal export-->
    <div id="form_export" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="listing.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-file-excel-o"></i> Xuất Excel Danh sách Sinh viên</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sell">Chọn trường</label>
                            <div>
                                <select class="form-control" title="Chọn Trường" id="school_id" name="school_id" onchange="loadFaculties('#form_export');" >
                                    <option value="">- Chọn Trường -</option>
                                    <?
                                    foreach ($arrSchools as $row) {
                                        ?>
                                        <option value="<?= $row['sch_id']?>"><?= $row['sch_name']?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sell">Chọn khoa</label>
                            <div id="listFaculties">
                                <select class="form-control" title="Chọn Khoa" id="faculty_id" name="faculty_id" onchange="loadClasses('#form_export');" >
                                    <option value="">- Chọn Khoa -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sell">Chọn lớp</label>
                            <div id="listClasses">
                                <select class="form-control" title="Chọn Lớp" id="class_id" name="class_id" >
                                    <option value="">- Chọn Lớp -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="action" name="action" value="export" />
                        <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Xuất Excel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        /**
         * ajax load danh sách Khoa
         */
        function loadFaculties(){
            var schoolID = $("#school_id").val();
            $( "#listFaculties" ).html("<img src='/images/loading_process.gif' height='34px' />");

            setTimeout(function(){
                $( "#listFaculties" ).load("/ajax/load_faculties.php?schoolID=" + schoolID);
            }, 500);


        }

        /**
         * ajax load danh sách Lớp
         */
        function loadClasses(){
            var facultyID = $("#faculty_id").val();
            $( "#listClasses" ).html("<img src='/images/loading_process.gif' height='34px' />");

            setTimeout(function(){
                $( "#listClasses" ).load("/ajax/load_classes.php?facultyID=" + facultyID);
            }, 500);


        }
    </script>
</body>
</html>