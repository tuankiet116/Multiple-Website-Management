<?php
require_once("inc_security.php");
require_once("../../../classes/PHPExcel/PHPExcel.php");

$action = getValue("action", "str", "POST", "");

if ($action == "export") {
    $month = getValue("month_id", "int", "POST", "");
    $year = getValue("year_id", "int", "POST", "");
    $start = new DateTime('2000-01-16');
    $finish = new DateTime('2000-01-16');
    $latetimeStart = "";
    $latetimeFinish = "";
    $listWorkShift = new db_query("SELECT * FROM workshift WHERE wor_idShift = 1");
    $listlate = new db_query("SELECT * FROM late WHERE lat_idShift = 1");

    $cf_salary_ontime = 1;
    $cf_salary_ot = 1.5;
    $cf_salary_late = 0.5;
    $cf_salary_off = 'N';

    while ($workShift = mysqli_fetch_assoc($listWorkShift->result)) {
        $start = new DateTime($workShift["StartTime"]);
        $finish = new DateTime($workShift["FinishTime"]);
    }

    while ($late = mysqli_fetch_assoc($listlate->result)) {
        $latetimeStart = $late["lat_time_start"];
        $latetimeFinish = $late["lat_time_finish"];

        $m = $latetimeStart % 60;
        $h = intval($latetimeStart / 60);
        $latetimeStart = "PT" . $h . "H" . $m . "M";

        $m = $latetimeFinish % 60;
        $h = intval($latetimeFinish / 60);
        $latetimeFinish = $h . ":" . $m;
    }

    $start = $start->add(new DateInterval($latetimeStart));
    $finish = $finish->diff(new DateTime($latetimeFinish));

    $start = new DateTime($start->format('H:i'));
    $finish = new DateTime($finish->format('%H:%I'));

    $excel = new PHPExcel();
    $activeSheet = $excel->getActiveSheet();

    $excel->setActiveSheetIndex(0);
    $activeSheet->setTitle("Danh Sách Checkin ");

    $days = cal_days_in_month(CAL_GREGORIAN, $month, 2020);
    $column = 1;
    $row = 4;
    $No = 1;

    $memberID = new db_query("SELECT id, name FROM members WHERE members.active = 1");
    while ($listMember = mysqli_fetch_assoc($memberID->result)) {
        $activeSheet->setCellValue('A' . $row, strval($No));
        $activeSheet->setCellValueByColumnAndRow($column, $row, $listMember["name"]);

        $activeSheet->getStyle("A" . $row)
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $activeSheet->getStyle("A" . $row)
            ->applyFromArray(
                array(
                    'font'    => array(
                        'name'      => 'Times New Roman',
                        'bold'      => true,
                        'size'      => 11
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => '000000')
                        )
                    )
                )
            );

        $activeSheet->getStyleByColumnAndRow($column, $row)
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->getStyleByColumnAndRow($column, $row)
            ->applyFromArray(
                array(
                    'font'    => array(
                        'name'      => 'Times New Roman',
                        'bold'      => false,
                        'size'      => 11
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => '000000')
                        )
                    )
                )
            );

        $checkin = new db_query("SELECT member_checkin.id,member_id, member_checkin.checkin_time
                                        FROM member_checkin, members
                                        WHERE MONTH(member_checkin.checkin_time)= ".$month." AND YEAR(member_checkin.checkin_time) = 2020 
                                                AND member_checkin.member_id = " . $listMember["id"] . "
                                                AND members.active = 1 AND member_checkin.active = 1
                                        GROUP BY DATE(member_checkin.checkin_time), member_id ");
        $checkout = new db_query("SELECT member_checkin.id, member_checkin.member_id, member_checkin.checkin_time as checkout_time 
                                         FROM member_checkin, members 
                                         WHERE member_checkin.member_id = members.id	
                                            AND member_checkin.id IN (SELECT MAX(member_checkin.id) 
                                                                    FROM member_checkin, members
                                                                    WHERE MONTH(member_checkin.checkin_time)= ".$month." 
                                                                            AND YEAR(member_checkin.checkin_time) = 2020
                                                                            AND members.active = 1 AND member_checkin.active = 1	
                                                                            AND member_checkin.member_id = " . $listMember["id"] . "
                                                                    GROUP BY DATE(checkin_time), member_id) ");
        $sum_sf_salary = 0;
        $daywork = array();

        while ($listCheckin = mysqli_fetch_assoc($checkin->result)) {
            $listCheckout = mysqli_fetch_assoc($checkout->result);

            $checkin_daytime = new DateTime($listCheckin["checkin_time"]);
            $checkout_daytime = new DateTime($listCheckout["checkout_time"]);
            array_push($daywork, $checkin_daytime->format("d"));

            $checkin_time = new DateTime($checkin_daytime->format('H:I'));
            $checkout_time = new DateTime($checkout_daytime->format('H:I'));


            if ($checkin_time->diff($start)->format('%R') == '-' || $checkout_time->diff($finish)->format('%R') == '+') {
                $activeSheet->setCellValueByColumnAndRow(($column + intval($checkin_daytime->format("d"))), $row, strval(0.5));
                $sum_sf_salary += 0.5;
            } else {
                $activeSheet->setCellValueByColumnAndRow(($column + intval($checkin_daytime->format("d"))), $row, strval(1));
                $sum_sf_salary += 1;
            }

            $activeSheet->getStyleByColumnAndRow($column + intval($checkin_daytime->format("d")), $row)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $activeSheet->getStyleByColumnAndRow($column + intval($checkin_daytime->format("d")), $row)
                ->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('rgb' => '000000')
                            )
                        )
                    )
                );
        }

        $activeSheet->setCellValueByColumnAndRow(($days + 2), $row, strval($sum_sf_salary));
        $activeSheet->getStyleByColumnAndRow(($days + 2), $row)
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->getStyleByColumnAndRow(($days + 2), $row)
            ->applyFromArray(
                array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => '000000')
                        )
                    )
                )
            );

        $j = 0;
        for ($i = 1; $i <= $days; $i++) {
            if (isset($daywork[$j]) && $i == intval($daywork[$j])) {
                $j++;
            } else {
                $activeSheet->setCellValueByColumnAndRow(($column + intval($i)), $row, 'N');
                $activeSheet->getStyleByColumnAndRow(($column + intval($i)), $row)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $activeSheet->getStyleByColumnAndRow(($column + intval($i)), $row)
                    ->applyFromArray(
                        array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array('rgb' => '000000')
                                )
                            )
                        )
                    );
            }
        }

        $No++;
        $row++;
    }

    if ($days == 30) {
        $activeSheet->getStyle('A1:AK1')->getFont()->setBold(true);
        $activeSheet->getStyle('A1:AK1')->getAlignment()->setWrapText(true);
        $activeSheet->mergeCells('A1:AK1');
        $activeSheet->setCellValue('A1', "Bảng chấm công tháng ".$month."/2020");
        $activeSheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->mergeCells('C2:AF2');
        $activeSheet->getStyle("A1:AK1")->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => true,
                    'size'      => 16
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );
    }

    if ($days == 31) {
        $activeSheet->getStyle('A1:AL1')->getFont()->setBold(true);
        $activeSheet->mergeCells('A1:AL1');
        $activeSheet->setCellValue('A1', "Bảng chấm công tháng $month/2020");
        $activeSheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->mergeCells('C2:AG2');
        $activeSheet->getStyle("A1:AL1")->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => true,
                    'size'      => 16
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );
    }

    if ($days == 28) {
        $activeSheet->getStyle('A1:AI1')->getFont()->setBold(true);
        $activeSheet->mergeCells('A1:AI1');
        $activeSheet->setCellValue('A1', "Bảng chấm công tháng ".$month."/2020");
        $activeSheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->mergeCells('C2:AD2');
        $activeSheet->getStyle("A1:AI1")->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => true,
                    'size'      => 16
                ),

                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );
    }

    if ($days == 29) {
        $activeSheet->getStyle('A1:AJ1')->getFont()->setBold(true);
        $activeSheet->mergeCells('A1:AJ1');
        $activeSheet->setCellValue('A1', "Bảng chấm công tháng ".$month."/2020");
        $activeSheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->mergeCells('C2:AE2');
        $activeSheet->getStyle("A1:AJ1")->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => true,
                    'size'      => 16
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );
    }


    $activeSheet->getColumnDimension('A')->setWidth(5);
    $activeSheet->getColumnDimension('B')->setWidth(25);
    $activeSheet->getRowDimension('3')->setRowHeight(60);

    $col = 'C';
    for ($i = 1; $i <= $days; $i++) {
        $activeSheet->setCellValue($col . '3', strval($i));
        $activeSheet
            ->getStyle($col . '3')
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $activeSheet->getStyle($col . '3')->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );
        $activeSheet->getColumnDimension($col)->setWidth(5);
        $col++;
    }

    $activeSheet->mergeCellsByColumnAndRow((2 + $days), 2, (2 + $days), 3);
    $activeSheet->setCellValueByColumnAndRow((2 + $days), 2, "Công Chính");
    $activeSheet->getColumnDimensionByColumn((2 + $days))->setWidth(15);
    $activeSheet
        ->getStyleByColumnAndRow((2 + $days), 2)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
    $activeSheet->getStyleByColumnAndRow((2 + $days), 2, (2 + $days), 3)
        ->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => false,
                    'size'      => 11,
                    'color'     => array(
                        'rbg' => 'FF0000'
                    )
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

    $activeSheet->mergeCellsByColumnAndRow((3 + $days), 2, (3 + $days), 3);
    $activeSheet->setCellValueByColumnAndRow((3 + $days), 2, "công làm thêm ngày thường * 150%");
    $activeSheet->getColumnDimensionByColumn((3 + $days))->setWidth(15);
    $activeSheet
        ->getStyleByColumnAndRow((3 + $days), 2, (3 + $days), 3)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
    $activeSheet->getStyleByColumnAndRow((3 + $days), 2, (3 + $days), 3)
        ->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => false,
                    'size'      => 11,
                    'color'     => array(
                        'rbg' => 'FF0000'
                    )
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

    $activeSheet->mergeCellsByColumnAndRow((4 + $days), 2, (4 + $days), 3);
    $activeSheet->setCellValueByColumnAndRow((4 + $days), 2, "công Làm thêm ngày nghỉ x 200% ");
    $activeSheet->getColumnDimensionByColumn((4 + $days))->setWidth(15);
    $activeSheet
        ->getStyleByColumnAndRow((4 + $days), 2, (4 + $days), 3)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
    $activeSheet->getStyleByColumnAndRow((4 + $days), 2, (4 + $days), 3)
        ->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => false,
                    'size'      => 11,
                    'color'     => array(
                        'rbg' => 'FF0000'
                    )
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

    $activeSheet->mergeCellsByColumnAndRow((5 + $days), 2, (5 + $days), 3);
    $activeSheet->setCellValueByColumnAndRow((5 + $days), 2, "Tổng công");
    $activeSheet->getColumnDimensionByColumn((5 + $days))->setWidth(15);
    $activeSheet
        ->getStyleByColumnAndRow((5 + $days), 2, (5 + $days), 3)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
    $activeSheet->getStyleByColumnAndRow((5 + $days), 2, (5 + $days), 3)
        ->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => false,
                    'size'      => 11,
                    'color'     => array('rbg' => 'FF0000')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

    $activeSheet->mergeCellsByColumnAndRow((6 + $days), 2, (6 + $days), 3);
    $activeSheet->setCellValueByColumnAndRow((6 + $days), 2, "Ký nhận");
    $activeSheet->getColumnDimensionByColumn((6 + $days))->setWidth(15);
    $activeSheet
        ->getStyleByColumnAndRow((6 + $days), 2, (6 + $days), 3)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
    $activeSheet->getStyleByColumnAndRow((6 + $days), 2, (6 + $days), 3)
        ->applyFromArray(
            array(
                'font'    => array(
                    'name'      => 'Times New Roman',
                    'bold'      => false,
                    'size'      => 11,
                    'color'     => array(
                        'rbg' => 'FF0000'
                    )
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

    $activeSheet->mergeCells('A2:A3');
    $activeSheet->setCellValue('A2', "STT");
    $activeSheet
        ->getStyle('A2:A3')
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $activeSheet->getStyle("A2:A3")->applyFromArray(
        array(
            'font'    => array(
                'name'      => 'Times New Roman',
                'bold'      => false,
                'size'      => 11
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        )
    );


    $activeSheet->mergeCells('B2:B3');
    $activeSheet->setCellValue('B2', "Họ và tên");
    $activeSheet
        ->getStyle('B2:B3')
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $activeSheet->getStyle("B2:B3")->applyFromArray(
        array(
            'font'    => array(
                'name'      => 'Times New Roman',
                'bold'      => true,
                'size'      => 11,
                'color'     => array(
                    'rbg' => 'FF0000'
                )
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        )
    );


    // Create PHPExcel_IOFactory object to write into file
    header('Content-Disposition: attachment; filename="Checkin_' . time() . '.xlsx"');
    ob_end_clean();
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');

}

?>
<style type="text/css">
    #form_export .form-control,
    #form_import .form-control {
        width: 100% !important;
        height: 30px;
        line-height: 30px;
    }
</style>
<!-- Modal export-->
