<?php
require_once("inc_security.php");
require_once("../../../classes/PHPExcel/PHPExcel.php");

$action = getValue("action", "str", "POST", "");

$arrSchools = array();
$list_schools = new db_query("SELECT * FROM schools WHERE sch_active = 1");
while($row = mysqli_fetch_assoc($list_schools->result)){
    $arrSchools[] = $row;
}
unset($list_schools);

$school_id = getValue("school_id", "int", "POST", 0);
$faculty_id = getValue("faculty_id", "int", "POST", 0);
$class_id = getValue("class_id", "int", "POST", 0);

if ($action == "export") {

    if($school_id <= 0 || $faculty_id <= 0 || $class_id <= 0) exit("Dữ liệu đầu vào không hợp lệ. Vui long lựa chọn đầy đủ Trường, Khoa, Lớp.");

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
    $db_student = new db_query("SELECT * FROM users WHERE use_school_id = " . $school_id . " AND use_faculty_id = " . $faculty_id . " AND use_class_id=" . $class_id);
    while ($row = mysqli_fetch_assoc($db_student->result)) {
        $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['use_code']);
        $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['use_name']);
        $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['use_idnumber']);
        $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['use_gender'] == 1 ? "Nam" : "Nữ");
        $excel->getActiveSheet()->setCellValue('E' . $numRow, date("m/d/Y", $row['use_birthdays']));
        $numRow++;
    }
    unset($db_student);

    // Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
    header('Content-Disposition: attachment; filename="danh_sach_sinh_vien_' . time() . '.xlsx"');
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');


}

if ($action == "import") {

    if($school_id <= 0 || $faculty_id <= 0 || $class_id <= 0 || !isset($_FILES['excel_file'])) exit("Dữ liệu đầu vào không hợp lệ. Vui long lựa chọn đầy đủ Trường, Khoa, Lớp và lựa chọn File Excel Danh sách Sinh viên trước.");

    //Đường dẫn file
    $file = $_FILES['excel_file']['tmp_name'];
    $objFile = PHPExcel_IOFactory::identify($file);
    $objData = PHPExcel_IOFactory::createReader($objFile);


    //Chỉ đọc dữ liệu
    $objData->setReadDataOnly(true);

    // Load dữ liệu sang dạng đối tượng
    $objPHPExcel = $objData->load($file);
    $sheet = $objPHPExcel->setActiveSheetIndex(0);

    //Lấy ra số dòng cuối cùng
    $Totalrow = $sheet->getHighestRow();

    //Lấy ra tên cột cuối cùng
    $LastColumn = $sheet->getHighestColumn();

    //Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
    $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

    //Tạo mảng chứa dữ liệu
    $data = array();

    //Tiến hành lặp qua từng ô dữ liệu
    //----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
    for ($i = 2; $i <= $Totalrow; $i++) {
        //----Lặp cột
        for ($j = 0; $j < $TotalCol; $j++) {
            // Tiến hành lấy giá trị của từng ô đổ vào mảng
            $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
        }
    }
    if (isset($data)) {
        foreach ($data as $key => $value) {

            $use_name = @$value[1];
            $use_code = @$value[0];
            $use_code_md5 = md5($use_code);
            $use_idnumber = @$value[2];
            $use_idnumber_md5 = md5($use_idnumber);
            $use_active = 0;
            $gender = @$value[3];
            if(trim($gender) == "Nữ") $use_gender   = 2;
            else $use_gender = 1;
            var_dump($use_gender);
            $use_birthdays = @$value[4];
            $use_birthdays = strtotime(str_replace('/', '-', $use_birthdays));
            if (empty($use_birthdays)) {
                $use_birthdays = time();
            }
            $use_created_time    = time();
            $use_updated_time    = time();

            //Call Class generate_form();
            $myform = new generate_form();
            $myform->add("use_school_id", "school_id", 1, 1, 0, 1, "Bạn chưa chọn Trường.", 0, "");
            $myform->add("use_faculty_id", "faculty_id", 1, 1, 0, 1, "Bạn chưa chọn Khoa.", 0, "");
            $myform->add("use_class_id", "class_id", 1, 1, 0, 1, "Bạn chưa chọn Lớp.", 0, "");
            $myform->add("use_name", "use_name", 0, 1, "", 1, translate("Họ và Tên không được để trống."), 0, "");
            $myform->add("use_birthdays", "use_birthdays", 1, 1, "", 1, translate("Bạn chưa nhập Ngày sinh"));
            $myform->add("use_gender", "use_gender", 1, 1, "");

            $use_salt = md5(rand(100000, 999999));
            $use_password = md5('123456' . $use_salt);
            $myform->add("use_password", "use_password", 0, 1, '', 0, "", 0, "");
            $myform->add("use_salt", "use_salt", 0, 1, '', 0, "", 0, "");
            $myform->add("use_code", "use_code", 0, 1, "", 1, translate("Mã Sinh Viên không được để trống"), 0, "0");
            $myform->add("use_code_md5", "use_code_md5", 0, 1, "", 0, translate("Mã Sinh Viên không được để trống"), 1, "Mã Sinh Viên đã tồn tại trong hệ thống.");
            $myform->add("use_idnumber", "use_idnumber", 0, 1, "", 1, translate("Số CMND/Hộ chiếu không được để trống."), 0, "0");
            $myform->add("use_idnumber_md5", "use_idnumber_md5", 0, 1, "", 0, translate("Số CMND/Hộ chiếu không được để trống."), 1, "Số CMND/Hộ chiếu đã tồn tại trong hệ thống.");
            $myform->add("use_type", "use_type", 1, 1, 1, 0, "", 0, "");
            $myform->add("use_active", "use_active", 1, 1, 1, 0, "", 0, "");
            $myform->add("use_created_time", "use_created_time", 1, 1, 1, 0, "", 0, "");
            $myform->add("use_updated_time", "use_updated_time", 1, 1, 1, 0, "", 0, "");
            $myform->add("admin_id", "admin_id", 1, 1, 1, 0, "", 0, "");
            $myform->addTable("users");

            //Check form data
            $fs_errorMsg = $myform->checkdata();

            if ($fs_errorMsg == "") {
                //Insert to database
                $myform->removeHTML(1);
                $db_insert = new db_execute($myform->generate_insert_SQL());
                unset($db_insert);
            }
        }
    }


}
?>
<style type="text/css">
    #form_export .form-control, #form_import .form-control{
        width: 100% !important;
        height: 30px;
        line-height: 30px;
    }
</style>
<!-- Modal export-->
<div id="form_export" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="listing.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-file-excel-o"></i> Xuất Excel Danh sách Sinh viên</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sell">Chọn trường</label>
                        <div>
                            <select class="form-control" title="Chọn Trường" id="school_id" name="school_id" onchange="loadFaculties('export');" >
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
                            <select class="form-control" title="Chọn Khoa" id="faculty_id" name="faculty_id">
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

<!-- Modal export-->
<div id="form_import" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="listing.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-file-excel-o"></i> Nhập Danh sách Sinh Viên từ Excel</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sell">Chọn file Excel Danh sách Sinh viên</label>
                        <input class="form-control" type="file" title="File Excel Danh sách Sinh viên" id="excel_file" name="excel_file" >
                    </div>
                    <div class="form-group">
                        <label for="sell">Chọn trường</label>
                        <div>
                            <select class="form-control" title="Chọn Trường" id="school_id" name="school_id" onchange="loadFaculties('import');" >
                                <option value="">- Chọn Trường -</option>
                                <?
                                reset($arrSchools);
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
                            <select class="form-control" title="Chọn Khoa" id="faculty_id" name="faculty_id">
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
                    <div class="modal-footer">
                        <input type="hidden" id="action" name="action" value="import" />
                        <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Nhập Excel</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?php
unset($list_schools);
?>

<script type="text/javascript">
    /**
     * ajax load danh sách Khoa
     */
    function loadFaculties(frmID){
        var $_frm = $("#form_" + frmID);
        var schoolID = $_frm.find("#school_id").val();
        $_frm.find( "#listFaculties" ).html("<img src='/images/loading_process.gif' height='34px' />");

        setTimeout(function(){
            $_frm.find( "#listFaculties" ).load("/ajax/load_faculties.php?schoolID=" + schoolID + "&frmID=" + frmID);
        }, 500);


    }

    /**
     * ajax load danh sách Lớp
     */
    function loadClasses(frmID){
        var $_frm = $("#form_" + frmID);
        var facultyID = $_frm.find("#faculty_id").val();
        $_frm.find( "#listClasses" ).html("<img src='/images/loading_process.gif' height='34px' />");

        setTimeout(function(){
            $_frm.find( "#listClasses" ).load("/ajax/load_classes.php?facultyID=" + facultyID);
        }, 500);


    }
</script>