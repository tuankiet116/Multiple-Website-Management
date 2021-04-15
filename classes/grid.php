<?php

/**
 * Class fsDataGird
 */
class fsDataGird
{

	var $stt 				= 0;
	var $arrayField 		= array();
	var $arrayLabel 		= array();
	var $arrayType	 		= array();
	var $arrayAttribute	= array();
	var $field_id			=  '';
	var $field_name		=  '';
	var $image_path		= '../../resource/images/grid/';
	var $fs_border			= "#C3DAF9";
	var $html				= '';
	var $scriptText		= '';
	var $title				= '';
	var $arraySort			= array();
	var $arraySearch		= array();
	var $arrayAddSearch	= array();
	var $addHTML			= array();
	var $quickEdit 		= false;
	var $total_list		= 0;
	var $total_record		= 0;
	var $page_size			= 30;
	var $edit_ajax			= false;
	var $showstt			= true;
	var $showid				= true;
	var $arrayFieldLevel	= array();
	var $delete 			= true;
	var $delete_all 		= true;

	var $detail_count       = '';


	//add cac truong va tieu de vao
	function __construct($field_id,$field_name,$title){
		$this->field_id 	= $field_id;
		$this->field_name	= $field_name;
		$this->title 		= $title;
	}


	/*
	1: Ten truong trong bang
	2: Tieu de header
	3: kieu du lieu
	4: co sap xep hay khong, co thi de la 1, khong thi de la 0
	5: co tim kiem hay khong, co thi de la 1, khong thi de la 0
	*/
	function add($field_name,$lable,$type = "string",$sort=0,$search=0,$attributes = ""){
		if($sort == 1) $this->arraySort[$this->stt] = $field_name;
		if($search == 1) $this->arraySearch[$this->stt] = $field_name;

		$this->arrayField[$this->stt] = $field_name;
		$this->arrayLabel[$this->stt] = $lable;
		$this->arrayType[$this->stt]  = $type;
		$this->arrayAttribute[$this->stt]  = $attributes;
		$this->stt++;
		if($type=="array"){
			global $$field_name;
			$arrayList = $$field_name;
			$strdata   = array();
			foreach($arrayList as $key=>$value){
				$strdata[] = $key . ':' . "'" . str_replace("'","\'",$value) . "'";
			}
			$strdata = implode(",",$strdata);
			$this->scriptText .= '<script type="text/javascript">';
			$this->scriptText .=  '$(function() {
										  $(".editable_select_' . $field_name . '").editable("listing.php?ajaxedit=1", {
											 indicator : \'<img src="' . $this->image_path . 'indicator.gif">\',
											 tooltip   : "' . translate_text("No selected") . '",
											 data   : "{' . $strdata . '}",
											 type   : "select",
											 submit : "' . translate_text("Save") . '",
											 style  : "inherit",
											 cssclass : "formquickedit",
											 submitdata : function() {
												return {id : $(this).attr("name"),array : \'' . $field_name . '\'};
											 }
										  });
										});';
			$this->scriptText .= '</script>';
		}

	}

	/*
	Ham hien thi ra listing
	db : ket qua tra ve cua cau lenh query gọi từ class db_query
	$type_search : Show button search o dau hay cuoi cua url seach 1 o cuoi, 0 o dau
	*/

	function showTable($db, $multi = 0, $type_search = 0){

		//goi phan template
		$this->html .= template_top($this->title,$this->urlsearch($type_search), $this->html_ext());
		// khoi tao table
		$this->html .= '<div class="content"><table cellpadding="5" cellspacing="0" width="100%" class="table table-hover table-bordered">';

		//phan header

		$this->html .= '<tr class="warning">';

		$this->total_list 		= $multi;

		//trường STT
		if($this->showstt){
			$this->html .= '<td class="h" width="40" style="text-align: center;">STT</td>';
		}

		//phan checkbok all
		if($this->delete_all) $this->html .= '<td width="50" class="h check"><input type="checkbox" id="check_all" onclick="checkall(' . $this->total_list . ')"></td>';

		if($this->quickEdit){
			//phan quick edit
			$this->html .= '<td class="h"><img src="' . $this->image_path . 'qedit.png" border="0"></td>';
		}

		foreach($this->arrayLabel as $key=>$lable){

			$this->html .= '<td class="h">' . $lable . $this->urlsort($this->arrayField[$key]) . ' </td>';

		}

		$this->html .= '</tr>';


		$i=0;

		$page = getValue("page");
		if($page<1) $page = 1;

		while($row = mysqli_fetch_assoc($db->result)){
			$i++;
			$this->html .= '<tr id="tr_' . $row[$this->field_id] . '">';

			//phan so thu tu
			if($this->showstt){
				$this->html .= '<td width=40 style="text-align:center"><span style="color:#142E62; font-weight:bold">' . ($i+(($page-1)*$this->page_size)) . '</span></td>';
			}

			//phan checkbok cho tung record
			if($this->delete_all)  $this->html .= '<td class="check" style="text-align: center;"><input type="checkbox" class="check" name="record_id[]" id="record_' . $i . '" value="' . $row[$this->field_id] . '"></td>';

			if($this->quickEdit){
				//phan quick edit
				$this->html .= '<td width=15 align="center"><a class="thickbox" rel="tooltip" title="' . translate_text("Do you want quick edit basic") . '" href="quickedit.php?record_id=' . $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '&KeepThis=true&TB_iframe=true&height=300&width=400"><img src="' . $this->image_path . 'qedit.png" border="0"></a></td>';
			}
			foreach($this->arrayField as $key=>$field){

				$this->html .= $this->checkType($row,$key);
			}

			$this->html .= '</tr>';
		}

		$this->html .= '</tr>';
		$this->html .= '</table>';
		$this->html	.= '</div>';

		// Phần footer
		$this->html	.= "<div class='footer'>" . $this->footer() . "</div>";
		//khet thuc phan template
		$this->html .= template_bottom();

		return $this->html;
	}

	function showTableDetail($db, $db_child = "", $db_child2 = "", $foreign_key = "", $multi = 0, $type_search = 0)
	{
		//goi phan template
		$this->html .= template_top($this->title, $this->urlsearch($type_search), $this->html_ext());
		// khoi tao table
		$this->html .= '<div class="content"><table cellpadding="5" cellspacing="0" width="100%" class="table table-hover table-bordered">';

		//phan header

		$this->html .= '<tr class="warning">';
 
		$this->total_list 		= $multi;

		//trường STT
		if ($this->showstt) {
			$this->html .= '<td class="h" width="40" style="text-align: center;">STT</td>';
		}

		//phan checkbok all
		if ($this->delete_all) $this->html .= '<td width="50" class="h check"><input type="checkbox" id="check_all" onclick="checkall(' . $this->total_list . ')"></td>';

		if ($this->quickEdit) {
			//phan quick edit
			$this->html .= '<td class="h"><img src="' . $this->image_path . 'qedit.png" border="0"></td>';
		}

		foreach ($this->arrayLabel as $key => $lable) {

			$this->html .= '<td class="h">' . $lable . $this->urlsort($this->arrayField[$key]) . ' </td>';
		}

		$this->html .= '<td class="h"> Xóa </td>';

		$this->html .= '<td class="h" width=55> Chi tiết </td>';

		$this->html .= '</tr>';


		$i = 0;
		$count = 0;

		$page = getValue("page");
		if ($page < 1) $page = 1;

		if($db_child != ""){
			while ($row = mysqli_fetch_assoc($db->result)) {
				$i++;
				$count++;

				$info_db = $db_child . " AND " . $foreign_key . " = " . $row[$this->field_id];

				$workshift_detail_db = new db_query($info_db);

				$workshift_id = $row[$this->field_id];

				$delete_db = $db_child2 . " = " . $row[$this->field_id];

				$this->html .= '<tr id="tr_' . $row[$this->field_id] . '" class="tr_' . $row["wor_delete_flag"] . '">';

				//phan so thu tu
				if ($this->showstt) {
					$this->html .= '<td width=40 style="text-align:center"><span style="color:#142E62; font-weight:bold">' . ($i + (($page - 1) * $this->page_size)) . '</span></td>';
				}

				//phan checkbok cho tung record
				if ($this->delete_all)  $this->html .= '<td class="check" style="text-align: center;"><input type="checkbox" class="check" name="record_id[]" id="record_' . $i . '" value="' . $row[$this->field_id] . '"></td>';

				if ($this->quickEdit) {
					//phan quick edit
					$this->html .= '<td width=15 align="center"><a class="thickbox" rel="tooltip" title="' . translate_text("Do you want quick edit basic") . '" href="quickedit.php?record_id=' . $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '&KeepThis=true&TB_iframe=true&height=300&width=400"><img src="' . $this->image_path . 'qedit.png" border="0"></a></td>';
				}

				foreach ($this->arrayField as $key => $field) {

					$this->html .= $this->checkType($row, $key);
				}

				$this->html .= '<td width=10 align="center">
									<div class="delete-container">
										<div id="delete_' . $row[$this->field_id] . '" style="width: 25px; height:25px; margin-top: 1px; cursor: pointer"> 
											<img src="' . $this->image_path . 'delete.gif" alt="delete icon" style="width:16px; height: 16px"> 
										</div>
								';

				$this->html .= '<div id="black_'. $row[$this->field_id] .'" style="position: fixed; top: 0; right: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4); z-index: 10; display: none"></div> ';
					
				$this->html .= '<div id="deleteBox_' . $row[$this->field_id] . '" style="background-color: white; border-radius: 6px; width: 480px; height: 200px; position: absolute; top: 20%; right: 29%; z-index: 11; display: none"> 
									<div>
										<img src="' . $this->image_path . 'delete-icon2.jpg" alt="delete icon box" style="margin: 20px auto; width: 10%; height: auto">
									</div>
									<div style="font-size: 20px; font-weight: bold; color: rgb(90, 90, 90)"> Bạn có muốn xóa dữ liệu? </div>
									<form method="post" action="">
										<div style="margin-top: 23px">
											<button type="submit" id="deleteButton_' . $row[$this->field_id] . '" class="btn btn-danger" name="del_submit_' . $row[$this->field_id] . '" style="outline: none; width: 80px; margin-right: 5px"> Đồng ý </button>
											<button type="button" id="cancelButton_' . $row[$this->field_id] . '" class="btn btn-primary" style="outline: none; width: 80px"> Hủy </button>
										</div>
									</form>
								</div>';

				$this->html .= '<div id="deleteAlert" style="background-color:white; position: absolute; top: 0; right: 5%; border-radius: 6px; border: 2px solid rgb(57, 230, 0); box-shadow: 5px 5px 6px 2px rgba(0, 0, 0, 0.1); width:22%; height:70px;">
									<img src="' . $this->image_path . 'check-icon1.png" alt="check icon" style="width: 52px; height: 40px; display: inline-block; margin-top: -3px">
									<p style="color: rgb(90, 90, 90); font-size: 14px; font-weight: bold; margin-top: 25px; margin-right: 8%; display: inline-block"> Xóa thành công! </p>
								</div>';

				$this->html .= '</div>';

				$this->html .= '</td>';

				if(isset($_POST['del_submit_' . $row[$this->field_id] . '']))
				{
					$delete_flag = new db_execute($delete_db, 1);
					if ($delete_flag->row_affect > 0) {
						echo "<script type='text/javascript'> 
								location.reload();
							  </script>";
					} else {
						echo "<script type='text/javascript'> alert('Xóa không thành công!'); </script>";
					}
					unset($delete_flag);
				}


				$this->html .= '<script type="text/javascript">
									$(document).ready(function() {
										$("#delete_' . $row[$this->field_id] . '").click(function() {
											$("#black_' . $row[$this->field_id] . '").fadeIn("fast");
											$("#deleteBox_' . $row[$this->field_id] . '").fadeIn("fast");
										});

										$("#black_' . $row[$this->field_id] . '").click(function() {
											$("#black_' . $row[$this->field_id] . '").fadeOut("fast");
											$("#deleteBox_' . $row[$this->field_id] . '").fadeOut("fast");
										});

										$("#cancelButton_' . $row[$this->field_id] . '").click(function() {
											$("#black_' . $row[$this->field_id] . '").fadeOut("fast");
											$("#deleteBox_' . $row[$this->field_id] . '").fadeOut("fast");
										});

										var delAlert = $("#deleteAlert").fadeIn("fast");

										window.onload = function() {
											setTimeout(delAlert, 3000);
										}
									});
								</script>';

				$this->html .= '<td width=12 align="center">
									<div style="position: relative">
										<div id="btn_' . $workshift_id .'" style="width: 25px; height:25px; margin-top: 1px; cursor: pointer"> 
											<img src="' . $this->image_path . 'magnify-icon2.png" alt="magnifying glass icon" style="width:20px;height: 20px"> 
										</div> ';

				while ($show_detail = mysqli_fetch_assoc($workshift_detail_db->result)) {
					$this->html .= '<div id="info_' . $workshift_id . '" style="border: 1px solid silver; border-radius: 5px; background-color: rgb(255, 255, 204); width: 230px; height: auto; position: absolute; top: -83px; right: 50px; z-index: 10; display: none;">
										<table style="width: 90%; height: auto; margin: 11px 11px 11px 10px;">
											<tr>
												<td colspan="2" style="text-align: center; background-color: rgb(255, 255, 204); padding-bottom: 5px; font-weight: bold"> Chi tiết đi muộn </td>
											</tr>
											<tr>
												<td style="border: 1px solid silver; width: 60%; padding: 8px 0 8px 8px; background-color: rgb(255, 255, 204)"> Bắt đầu đi muộn: </td>
												<td style="border: 1px solid silver; padding-left: 5px; background-color: rgb(255, 255, 204)"> ' . $show_detail["lat_time_start"] . '</td>
											</tr>
											<tr>
												<td style="border: 1px solid silver; padding: 8px 0 8px 8px; background-color: rgb(255, 255, 204)"> Kết thúc đi muộn: </td>
												<td style="border: 1px solid silver; padding-left: 5px; background-color: rgb(255, 255, 204)"> ' . $show_detail["lat_time_finish"] . ' </td>
											</tr>
											<tr>
												<td style="border: 1px solid silver; padding: 8px 0 8px 8px; background-color: rgb(255, 255, 204)"> Mã phạt: </td>
												<td style="border: 1px solid silver; padding-left: 5px; background-color: rgb(255, 255, 204)"> ' . $show_detail["lat_idpunish"] . '</td>
											</tr>
											<tr>
												<td style="border: 1px solid silver; padding: 8px 0 8px 8px; background-color: rgb(255, 255, 204)"> Mức phạt: </td>
												<td style="border: 1px solid silver; padding-left: 5px; background-color: rgb(255, 255, 204)"> ' . $show_detail["lat_punisher"] . '</td>
											</tr>
										</table>

										<div style="border-top: 12px solid transparent; border-left: 25px solid rgb(255, 255, 204); border-bottom: 12px solid transparent; width:0; height: 0; position: absolute; top: 80px; right: -20px; z-index: 10"></div>
										<div style="border-top: 11px solid transparent; border-left: 22px solid silver; border-bottom: 11px solid transparent; width:0; height: 0; position: absolute; top: 81px; right: -22px; z-index: 9"></div>
									</div> 

									<div id="close_detail_' . $workshift_id . '" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 9; display: none;"></div>
									';

					$this->html .= '<script type="text/javascript">
										$(document).ready(function() {
											var s' . $workshift_id . ' = 0;

											$("#btn_' . $workshift_id . '").click(function() {
												if (s' . $workshift_id . ' == 0) {
													$("#info_' . $workshift_id . '").fadeIn("fast");
													$("#close_detail_' . $workshift_id . '").fadeIn("fast");
													s' . $workshift_id . '++;
												}
												else {
													$("#info_' . $workshift_id . '").fadeOut("fast");
													$("#close_detail_' . $workshift_id . '").fadeOut("fast");
													s' . $workshift_id . '--;
												}
											});

											$("#close_detail_' . $workshift_id . '").click(function() {
												$("#info_' . $workshift_id . '").fadeOut("fast");
												$("#close_detail_' . $workshift_id . '").fadeOut("fast");
												s' . $workshift_id . '--;
											});
										});

										var myDel = $("#tr_' . $row[$this->field_id] . '").attr("class");

										for (var ii = 0; ii <= ' . $i . '; ii++) {
											if (myDel = "tr_1") {
												$(".tr_1").remove();
											}
										} 

									</script>';
				}

	
				$this->html .= '</div>';
				$this->html .= '</td>';
				$this->html .= '</tr>';

			}

			$this->html .= '</table>';
		}

		$this->html	.= '</div>';

		// Phần footer
		$this->html	.= "<div class='footer'>" . $this->footer() . "</div>";
		//khet thuc phan template
		$this->html .= template_bottom();


		// $this->html = $this->html . $this->html_detail;

		return $this->html;
	}


	/*
	ham xu ly hien thi theo dang multi
	*/

	function showTableMulti($db){

		//goi phan template
		$this->html .= template_top($this->title,$this->urlsearch());

		// khoi tao table
		$this->html .= '<div class="content"><table cellpadding="0" cellspacing="0"  width="100%" class="table table-hover table-bordered">';

		//phan header

		$this->html .= '<tr class="header">';

		$this->html .= '<th width="30">STT</th>';

		$this->total_list .= count($db);

		//phan checkbok all
		$this->html .= '<th class="h check"><input type="checkbox" id="check_all" onclick="checkall(' . $this->total_list . ')"></th>';

		if($this->quickEdit){
			//phan quick edit
			$this->html .= '<th class="h"><img src="' . $this->image_path . 'qedit.png" border="0"></th>';
		}

		//phần hiển thị tiêu đề
		foreach($this->arrayLabel as $key=>$lable){
			$this->html .= '<th class="h">' . $lable . $this->urlsort($this->arrayField[$key]) . ' </th>';
		}

		$this->html .= '</tr>';

		$page = getValue("page");
		if($page<1) $page = 1;

		$i=0;
		if($db){
			foreach($db as $key=>$row){
				$i++;
				$this->html .= '<tr id="tr_' . $row[$this->field_id] . '" ' . (($i%2==0) ? 'bgcolor="#f7f7f7"' : '') . '>';

				//phan so thu tu
				$this->html .= '<td width=15 align="center"><span style="color:#142E62; font-weight:bold">' . ($i+(($page-1)*$this->page_size)) . '</span></td>';

				//phan checkbok cho tung record
				$this->html .= '<td class="check align_c"><input type="checkbox" class="check" name="record_id[]" id="record_' . $i . '" value="' . $row[$this->field_id] . '"></td>';

				if($this->quickEdit){
					//phan quick edit
					$this->html .= '<td width=15 align="center"><a class="thickbox" title="' . translate_text("Do you want quick edit basic") . '" href="quickedit.php?record_id=' . $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '&KeepThis=true&TB_iframe=true&height=300&width=400"><img src="' . $this->image_path . 'qedit.png" border="0"></a></td>';
				}
				foreach($this->arrayField as $key=>$field){

					$this->html .= $this->checkType($row, $key);
				}

				$this->html .= '</tr>';
			}
		}
		$this->html .= '</tr>';
		$this->html .= '</table>';

		// Phan footer
		$this->html .= '<div class="footer">' . $this->footer() . '</div>';

		//khet thuc phan template
		$this->html .= template_bottom();

		return $this->html;
	}
	/*

	Ham xu ly type hien thi
	xử lý các kiểu hiển thị trong listing
	row  : truyền array row gọi từ mysql_fetch_assoc ra
	key  : thứ tự trường add vào
	*/

	function checkType($row,$key){
		$level = "";
		if(isset($this->arrayFieldLevel[$this->arrayField[$key]])){
			for($i=0;$i<$row["level"];$i++){
				$level .= $this->arrayFieldLevel[$this->arrayField[$key]];
			}
		}
		switch($this->arrayType[$key]){

			//kiểu tiền tệ VNĐ
			case "vnd":
				return '<td ' . $this->arrayAttribute[$key] . ' style="text-align: right;"><span class="clickedit vnd" style="display:inline; color: #E43632;" id="' . $this->arrayField[$key] . ',' . $row[$this->field_id] . ',3">' .  formatCurrency($row[$this->arrayField[$key]]) . '</span></td>';
			break;

			//kiểu tiền tệ USD
			case "usd":
				return '<td ' . $this->arrayAttribute[$key] . ' style="text-align: right;"><span class="clickedit vnd" style="display:inline; color: #E43632;" id="' . $this->arrayField[$key] . ',' . $row[$this->field_id] . ',3">' .  $row[$this->arrayField[$key]] . '</span></td>';
			break;

			//kiểu ngày tháng
			case "date":
				return '<td class="input_text date" style="text-align: center;" ' . $this->arrayAttribute[$key] . '>' .  date("d/m/Y",$row[$this->arrayField[$key]]) . '</td>';
			break;

			//kiểu ngày tháng
			case "date_all":
				return '<td class="input_text date" align="center" ' . $this->arrayAttribute[$key] . '>' .  date("d/m/Y - H:i:s",$row[$this->arrayField[$key]]) . '</td>';
			break;

			//kiểu ngày tháng
			case "ip":
				return '<td class="date" style="text-align: center;" ' . $this->arrayAttribute[$key] . '>' .  long2ip($row[$this->arrayField[$key]]) . '</td>';
			break;

			//kiểu hình ảnh
			case "picture":
				if($row[$this->arrayField[$key]] != ''){
					global $fs_filepath;
					return '<td width="90" align="center" style="padding:1px;" ><a target="_blank" title="<img src=\'' . $fs_filepath . $row[$this->arrayField[$key]] . '\' border=\'0\'>" href="'. $fs_filepath . $row[$this->arrayField[$key]] .'"><img src="' . $fs_filepath . $row[$this->arrayField[$key]] . '" style="max-width: 80px;" border="0"></a></td>';
				}else{
					return '<td width="30">&nbsp;</td>';
				}
			break;

			//kiểu mãng dùng cho combobox có thể edit
			case "array":
				$field = $this->arrayField[$key];
				global $$field;
				$arrayList = $$field;
				$value = isset($arrayList[$row[$this->arrayField[$key]]]) ? $arrayList[$row[$this->arrayField[$key]]] : '';
				return '<td ' . $this->arrayAttribute[$key] . '  title="' . translate_text("Click sửa đổi sau đó chọn save") . '"><span class="editable_select_' . $this->arrayField[$key] . '" style="display:inline" id="select_2" name="' . $this->arrayField[$key] . ',' . $row[$this->field_id] . ',0">' . str_replace("-","",$value)  . '</span></td>';
			break;

			//kiểu mãng chỉ hiển thị không edit được
			case "arraytext":
				$field = $this->arrayField[$key];
				global $$field;
				$arrayList = $$field;
				$value = isset($arrayList[$row[$this->arrayField[$key]]]) ? $arrayList[$row[$this->arrayField[$key]]] : '';
				return '<td ' . $this->arrayAttribute[$key] . '>' . str_replace("-","",$value)  . '</td>';
			break;

			//kiểu copy bản ghi
			case "copy":
				return '<td width="10" style="text-align: center;"><a title="' . translate_text("Nhân bản thêm một bản ghi mới") . '" href="copy.php?record_id=' .  $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '"><img src="' . $this->image_path . 'copy.gif" border="0"></a></td>';
			break;

			//kiểu check box giá trị là 0 hoặc 1
			case "checkbox":
				return '<td width="10"  style="text-align: center;"><a onclick="update_check(this); return false" href="listing.php?field=' . $this->arrayField[$key] . '&checkbox=1&record_id=' .  $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '"><img src="' . $this->image_path . 'check_' . $row[$this->arrayField[$key]] . '.gif" border="0"></a></td>';
			break;

			//kiểu hiển thị nút edit
			case "edit_add":
				return '<td width="10" style="text-align: center;"><a title="' . translate_text("Bạn muốn sửa đổi bản ghi") . '" href="add.php?record_id=' .  $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '"><img src="' . $this->image_path . 'edit.png" border="0"></a></td>';
			break;

			//kiểu hiển thị nút edit
			case "edit":
				return '<td width="10" style="text-align: center;"><a title="' . translate_text("Bạn muốn sửa đổi bản ghi") . '" href="edit.php?record_id=' .  $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '"><img src="' . $this->image_path . 'edit.png" border="0"></a></td>';
			break;

			//kiểu hiển thị select color
			case "select_color":
				return '<td width="10" style="text-align: center;"><a class="btn btn-xs btn-danger" title="' . translate_text("Chọn màu nhấn") . '" onclick="windowPrompt({ href:\'select_color.php?record_id='. $row[$this->field_id] .'\', showBottom: true, iframe: true, width: 500, height: 300 });">Chọn màu nhấn</a></td>';
			break;

			//kểu hiện thị nút xóa
			case "delete":
				if($this->delete){
					return '<td width="10" style="text-align: center;"><a class="delete" href="#" onclick="if (confirm(\''  . str_replace("'","\'",translate_text("Bạn muốn xóa bản ghi?") . ': ' . $row[$this->field_name])  . '\')){ deleteone(' . $row[$this->field_id] . '); }"><img src="' . $this->image_path . 'delete.gif" border="0"></a></td>';
				}else{
					return '';
				}
			break;
         //Kiểu view source widget
			case "wgt_source":
            return '<td width="80" align="center"><a  href="../widget/show_source.php?record_id=' .  $row[$this->field_id] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '&height=300&width=600"  rel="tooltip" title="' . translate_text("Click xem mã nhúng") . '" class="thickbox"><img src="' . $this->image_path . 'view.gif" border="0"></a></td>';
         break;

			//kiểu hiển thị text có sửa đổi
			case "string":
				return '<td ' . $this->arrayAttribute[$key] . ' title="' . translate_text("Click vào để sửa đổi sau đó enter để lưu lại") . '">' . $level . '<span class="clickedit" style="display:inline" id="' . $this->arrayField[$key] . ',' . $row[$this->field_id] . ',0">' .  $row[$this->arrayField[$key]] . '</span></td>';
			break;

			//kiểu hiện thị text không sửa đổi
			case "text":
				return '<td ' . $this->arrayAttribute[$key] . '>'  .  $row[$this->arrayField[$key]] . '</td>';
			break;

			//kiểu hiện thị color không sửa đổi
			case "color":
				return '<td ' . $this->arrayAttribute[$key] . '><span style="dipslay: inline-block; padding: 5px; background-color: #' . $row[$this->arrayField[$key]] .'">'  .  $row[$this->arrayField[$key]] . '</span></td>';
			break;

			//kiểu hiển thị số có sửa đổi
			case "number":
				return '<td style="text-align:center; font-weight:bold;" ' . $this->arrayAttribute[$key] . ' title="' . translate_text("Click vào để sửa đổi sau đó enter để lưu lại") . '" width="10%" nowrap="nowrap">' . $level . '<span class="clickedit" id="' . $this->arrayField[$key] . ',' . $row[$this->field_id] . ',0">' . number_format($row[$this->arrayField[$key]], 0, ",", ".") . '</span></td>';
			break;

			//kiểu hiển thị số ko sửa đổi
			case "numbernotedit":
				return '<td class="align_c" ' . $this->arrayAttribute[$key] . ' nowrap="nowrap">' . number_format($row[$this->arrayField[$key]], 0, ",", ".") . '</td>';
			break;

			//kiểu hiện nút reset
			case "resetpass":
				return '<td width="10"  align="center">
                            <a href="javascript:;" title="' . translate_text("Reset Password") . '" onclick="windowPrompt({ href:\'reset_password.php?record_id='. $row[$this->field_id] .'\', showBottom: true, iframe: true, width: 500, height: 300 });">
                                <img style="height:20px" src="' . $this->image_path . 'reset_password.png" border="0">
                            </a>
				        </td>';
			break;

			//kểu hiện thị nút add danh mục
			case "addCategory":
				return '<td width="10"  align="center"><a class="thickbox noborder" href="add_category.php?record_id=' .  $row[$this->field_id] . '&TB_iframe=true&amp;height=350&amp;width=800"><img src="' . $this->image_path . 'add.gif" border="0"></a></td>';
			break;

			case "resetcache":
				return '<td width="10" class="align_c"><input type="button" class="btn btn-mini" onclick="resetcache('. $row[$this->field_id] .');" value="Reset"></td>';
			break;

			case "download_cv":
				return '<td width="10" style="text-align: center;"><a title="' . translate_text("Download CV") . '" href="../../../data/cv/'.  $row[$this->arrayField[$key]] .'"><img src="' . $this->image_path . 'edit.png" border="0"></a></td>';
			break;

			//dạng mặc định
			default:
				return '<td ' . $this->arrayAttribute[$key] . '>' .  $row[$this->arrayField[$key]] . '</td>';
			break;
		}
	}

	/*
	ham format kieu so
	*/
	function formatNumber($number){
		$number = number_format(round($number/1000)*1000,0,"",".");
		return $number;
	}

	/*
	phan header javascript
	*/

	function headerScript(){
		$this->scriptText .= '<script type="text/javascript">';
		//phan script edit nhanh text box
		$this->scriptText .= '$(function() {

									  $(".clickedit").editable("listing.php?ajaxedit=1", {
											indicator : "<img src=\'../../resource/images/grid/indicator.gif\'>",
											tooltip   : "' . translate_text("Click để thay đổi...") . '",
											style  : "inherit",
											height: "25px",
											cssclass : "formquickedit",
									  });
									});
									';


		//phan javascript hover vao cac tr
		$this->scriptText .= "$( function(){
											var bg = '';
											$('table#listing tr').hover( function(){
												bg = $(this).css('background-color');
												$(this).css('background-color', '#FFFFCC');
											},
											function(){
												$(this).css('background-color', bg);
											});

									});";
		$this->scriptText .= '</script>';
		$this->scriptText .= '<script language="javascript" src="../../resource/js/grid.js"></script>';

		return $this->scriptText;

	}

	/*
	ham tao ra nut sap xep
	field : tên trường
	*/
	function urlsort($field){
		$str 	= '';

		if(in_array($field,$this->arraySort)){

			$url 			= getURL(0,1,1,1,"sort|sortname");
			$sort 		= getValue("sort","str","GET","");
			$sortname 	= getValue("sortname","str","GET","");
			$img			= 'sort.gif';
			if($sortname!=$field) $sort = "";
			switch($sort){
				case "asc":
					$url 	= $url . "&sort=desc";
					$img	= 'sort-asc.gif';
				break;
				case "desc":
					$url 	= $url . "&sort=asc";
					$img	= 'sort-desc.gif';
				break;
				default:
					$url 	= $url . "&sort=asc";
					$img	= 'sort.gif';
				break;
			}

			$url 	= $url . "&sortname=" . $field;

			$str = '&nbsp;<span><a href="' . $url . '" title="' . translate_text("Sort A->Z or Z->A") . '" onclick="loadpage(this); return false" ><img src="' . $this->image_path . $img . '" align="absmiddle" border="0"></a></span>';

		}

		return $str;
	}

	/*
	ham tao cau lanh sql sort
	hàm sinh ra câu lênh query sort tương ứng
	*/

	function sqlSort(){
		$sort 		= getValue("sort","str","GET","");
		$field	 	= getValue("sortname","str","GET","");
		$str 			= '';
		if(in_array($field,$this->arraySort) && ($sort == "asc" || $sort == "desc")){
			$str 		= $field . ' ' . $sort . ',';
		}
		return $str;
	}
	/*
	ham add them cac truong search
	name : tiêu đề
	field : tên trường
	type : kiểu search
	value : giá trị nếu kiểu array thì truyền vào một array
	default: giá trị mặc định
	$count_date = 0 mặc định, nếu ko thì tính theo số ngày
	*/
	function addSearch($name,$field,$type,$value = '',$default="",$count_date = 0){
		$str = '';
		switch($type){
			//kiểu array
			case "array":
				$str .= '<select name="' . $field . '" id="' . $field . '" class="form-control">';
					foreach($value as $id=>$text){
						$str .= '<option value="' . $id . '" ' . (($default==$id) ? 'selected' : '') . '>' . $text . '</option>';
					}
				$str .= '</select>';
			break;

			//kiểu ngày tháng
			case "date":
				if($count_date != 0){
					$star_time = time() - 60*60*24*$count_date;
					$star_time = convertDateTime(date('d/m/Y', $star_time), "00:00:00");
					$star_time = date('d/m/Y', $star_time);

					$value = getValue($field,"str","GET",$star_time);
					$str .= '<input type="text"  class="input_text date" name="' . $field . '" id="' . $field . '" onKeyPress="displayDatePicker(\'' . $field . '\', this);" onClick="displayDatePicker(\'' . $field . '\', this);" onfocus="if(this.value==\'' . translate_text("Enter date") . '\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\'' . translate_text("Enter date")  . '\'" value="' . $value . '">';

				}else{
					$value = getValue($field,"str","GET","dd/mm/yyyy");
					$str .= '<input type="text"  class="input_text date" name="' . $field . '" id="' . $field . '" onKeyPress="displayDatePicker(\'' . $field . '\', this);" onClick="displayDatePicker(\'' . $field . '\', this);" onfocus="if(this.value==\'' . translate_text("Enter date") . '\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\'' . translate_text("Enter date")  . '\'" value="' . $value . '">';
				}
			break;

			//kiểu text box
			case "text":
				$value = getValue($field,"str","GET",translate_text($name));
				$str .= '<input type="text"  class="input_text" name="' . $field . '" id="' . $field . '"  onfocus="if(this.value==\'' . translate_text($name) . '\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\'' . translate_text($name)  . '\'" value="' . $value . '">';
			break;
		}
		$this->arrayAddSearch[] = array($str,$field,$name);
	}

	function addHTML($html){
		$this->addHTML[]	= trim($html);
	}

	/*
	ham tao form search
	$type_search : 1 :Button search o dau, mac dinh la o cuoi
	*/
	function urlsearch($type_search = 0){
		$str = '';
		$str = '<form action="' . $_SERVER['SCRIPT_NAME'] . '" methor="get" name="form_search" onsubmit="check_form_submit(this); return false">';
		$str .= '<input type="hidden" name="search" id="search" value="1" />';
		$str .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';

		// Show nút search ở đầu
		if($type_search == 1){
			$str .= '<td>&nbsp;<input type="submit" class="btn btn-sm btn-info" value="' . translate_text("Tìm kiếm") . '"></td>';
		}

		foreach($this->arraySearch as $key=>$field){
			switch($this->arrayType[$key]){

				case "string":
				case "text":
					$value = getValue($field,"str","GET", $this->arrayLabel[$key]);
					$str .= '<td class="text">' . $this->arrayLabel[$key] . '</td><td><input type="text" class="form-control" ' . $this->arrayAttribute[$key] . ' name="' . $field . '" id="' . $field . '" onfocus="if(this.value==\'' . $this->arrayLabel[$key] . '\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\'' . $this->arrayLabel[$key] . '\'" value="' . $value . '"></td>';
				break;
				case "numbernotedit":
					$value = getValue($field,"str","GET",$this->arrayLabel[$key]);
					$str .= '<td class="text">' . $this->arrayLabel[$key] . '</td><td><input type="text" class="form-control" ' . $this->arrayAttribute[$key] . ' name="' . $field . '" id="' . $field . '" onfocus="if(this.value==\'' . $this->arrayLabel[$key] . '\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\'' . $this->arrayLabel[$key] . '\'" value="' . $value . '"></td>';
				break;
				case "date":
					$value = getValue($field,"str","GET","dd/mm/yyyy");
					$str .= '<td class="text">' . $this->arrayLabel[$key] . '</td><td>&nbsp;<input type="text"  class="form-control date" ' . $this->arrayAttribute[$key] . ' name="' . $field . '" id="' . $field . '"  onKeyPress="displayDatePicker(\'' . $field . '\', this);" onClick="displayDatePicker(\'' . $field . '\', this);" onfocus="if(this.value==\'' . translate_text("Enter") . ' ' . $this->arrayLabel[$key] . '\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\'' . translate_text("Enter") . ' ' . $this->arrayLabel[$key] . '\'" value="' . $value . '"></td>';
				break;
				case "array":
				case "arraytext":
					$field = $this->arrayField[$key];
					global $$field;
					$arrayList = $$field;
					$str 			.= '<td class="text">' . $this->arrayLabel[$key] . '</td><td><select class="form-control" name="' . $field . '" id="' . $field . '" ' . $this->arrayAttribute[$key] . '>';
					$str 			.= '<option value="-1">' . $this->arrayLabel[$key] . '</option>';
					$selected 		= getValue($field,"str","GET",-1);
					foreach($arrayList as $key=>$value){
						$str 		.= '<option value="' . $key . '" ' . (($selected==$key) ? 'selected' : '') . '>' . $value . '</option>';
					}
					$str .= '</select></td>';
				break;

			}
		}

		foreach($this->arrayAddSearch as $key=>$value){
			if($value[2] != ""){
				$str .= "<td>&nbsp;<b>";
				$str .= $value[2];
				$str .= "</b>&nbsp;&nbsp;</td>";
			}

			$str .= "<td>";
			$str .= $value[0];
			$str .= "</td>";
		}
		// Show nút search ở cuối
		if($type_search != 1){
			$str .= '<td>&nbsp;<input type="submit" class="btn btn-sm btn-info" value="' . translate_text("Tìm kiếm") . '"></td>';
		}

			$str .= '</tr></table>';
			$str .= '</form>';

			//phần check javascript cho form tìm kiếm
			$str .= '<script type="text/javascript">';
			$str .= 'function check_form_submit(obj){';
			foreach($this->arraySearch as $key=>$field){
				switch($this->arrayType[$key]){
					case "string":
						$str .= 'if(document.getElementById("' . $field . '").value == \'' . translate_text("Enter") . ' ' . $this->arrayLabel[$key] . '\'){document.getElementById("' . $field . '").value = \'\'}';
					break;
				}
			}
			$str .= 'document.form_search.submit(); ';
			$str .= '};';
			$str .= '</script>';

		return $str;
	}

	function html_ext(){
		$returnHTML	= "";
		foreach($this->addHTML as $html){
			$returnHTML	.= $html;
		}

		return $returnHTML;
	}

	/*
	ham tao ra cau lenh sql search
	*/
	function sqlSearch(){

		$search		= getValue("search","int","GET",0);
		$str 			= '';
		if($search == 1){

			foreach($this->arraySearch as $key=>$field){

				$keyword		= getValue($field,"str","GET","");
				if($keyword == $this->arrayLabel[$key]) $keyword = "";
				$keyword		= str_replace(" ","%",$keyword);
				$keyword		= str_replace("\'","'",$keyword);
				$keyword		= str_replace("'","''",$keyword);
				switch($this->arrayType[$key]){
					case "string":
					case "text":
						if(trim($keyword)!='') $str 		.= " AND " . $field . " LIKE '%" . $keyword . "%'";
					break;
					case "numbernotedit":
						if(intval($keyword)> 0) $str 		.= " AND " . $field . " = " . $keyword;
					break;
					case "array":
					case "arraytext":
						if(intval($keyword)> -1) $str 		.= " AND " . $field . "=" . intval($keyword) . "";
					break;
				}
			}
		}
		return $str;
	}

	//ham xu ly phan footer

	function footer(){

		$str = '<table cellpadding="5" cellspacing="0" width="100%" class="page_break"><tr>';

		if($this->delete_all){

			$str .= '<td width="150">';
			$str .= '<button class="btn btn-sm btn-danger" onclick="if (confirm(\''  . str_replace("'","\'",translate_text("Bạn có chắc chắn muốn xóa những bản ghi đã chọn ?"))  . '\')){ deleteall(' . $this->total_list . '); }">' . translate_text("Xóa bản ghi đã chọn") . '</button>';
			$str .= '</td>';
			$str .= '<td width="150">';
			$str .= '' . translate_text("Tổng số bản ghi") . ' : ';
			$str .= '<span id="total_footer">' . formatCurrency($this->total_record). '</span>';
			$str .= '</td>';
      }
		$str .= '<td>';
		$str .= $this->generate_page();
		$str .= '</td>';
		$str .= '</tr></table>';
		return $str;

	}

	//ham phan trang

	function generate_page(){
		$str = '';
		if($this->total_record>$this->page_size){

			$total_page 	= $this->total_record/$this->page_size;
			$page			   = getValue("page","int","GET",1);
			if($page<1) $page = 1;
			$str 				.= '<a href="' . getURL(0,1,1,1,"page") . '&page=1"><img src="' . $this->image_path . 'first.gif" border="0" align="absmiddle" /></a>';
			if($page>1) $str 	.= '<a href="' . getURL(0,1,1,1,"page") . '&page=' . ($page-1) .'" onclick="loadpage(this); return false;"><img src="' . $this->image_path . 'prev.gif" border="0" align="absmiddle" /></a>';

			$start = $page-5;
			if($start<1) $start = 1;

			$end = $page+5;
			if($page<5) $end = $end+(5-$page);

			if($end > $total_page) $end=intval($total_page);
			if($end < $total_page) $end++;

			for($i=$start;$i<=$end;$i++){
				$str 			.= '<a href="' . getURL(0,1,1,1,"page") . '&page=' . $i . '">' . (($i==$page) ? '<span class="page_current">[' . $i . ']</span>' : '<span class="page">' . $i . '</span>') . '</a>';
			}

			if($page<$total_page) $str 	.= '<a href="' . getURL(0,1,1,1,"page") . '&page=' . ($page+1) .'"><img src="' . $this->image_path . 'next.gif" border="0" align="absmiddle" /></a>';
			$str 				.= '<a href="' . getURL(0,1,1,1,"page") . '&page=' . $total_page . '"><img src="' . $this->image_path . 'last.gif" border="0" align="absmiddle" /></a>';

		}

		return $str;
	}

	//ham tao linmit

	function limit($total_record){
		$this->total_record = $total_record;
		$page			   = getValue("page","int","GET",1);
		if($page<1) $page = 1;
		$str = "LIMIT " . ($page-1) * $this->page_size . "," . $this->page_size;
		return $str;
	}


	function start_tr($i, $record_id, $add_html = "", $bg = 0){
		$page = getValue("page");
		$class_color	=	'';
		if($bg == 1){
			$class_color	=	'bg_color';
		}
		if($page<1) $page = 1;

		$str = '<tbody class="'. $class_color .'" id="tr_' . $record_id . '">
					<tr ' . (($i%2==0) ? 'bgcolor="#f7f7f7"' : '') . '>';
		$str .= $this->showid($i, $page);
		$str .= $this->showCheck($i, $record_id);
		return $str;

	}


	function showHeader($total_list){
		//goi phan template
		$str = template_top($this->title,$this->urlsearch());
		if($this->quickEdit){
			//phan quick edit
			$str .= '<form action="quickedit.php?url=' . base64_encode($_SERVER['REQUEST_URI']) . '" method="post" enctype="multipart/form-data" name="listing">
						<input type="hidden" name="iQuick" value="update">';
		}
		// khoi tao table
		$str .= '<table id="listing" cellpadding="5" cellspacing="0" border="1" bordercolor="' . $this->fs_border . '" width="100%" class="table">';

		//phan header

		$str .= '</tr>';

		//tru?ng ID
		$str .= '<th class="h" width="30">ID</th>';

		//phan checkbok all
		if($this->delete_all) $str .= '<th class="h check"><input type="checkbox" id="check_all" onclick="checkall(' . $total_list . ')"></th>';

		if($this->quickEdit){
			//phan quick edit
			$str .= '<th class="h"><img src="' . $this->image_path . 'save.png" onclick="document.listing.submit()" style="cursor: pointer;" border="0"></th>';
		}

		foreach($this->arrayLabel as $key=>$lable){

			$str .= '<th class="h">' . $lable . $this->urlsort($this->arrayField[$key]) . ' </th>';

		}

		$str .= '</tr>';

		return $str;
	}

	//ham sua nhanh bang ajax

	function ajaxedit($fs_table){

		$this->edit_ajax = true;

		//nếu truong hợp checkbox thì chỉ thay đổi giá trị 0 và 1 thôi

		$checkbox 	= getValue("checkbox","int","GET",0);
		if($checkbox==1){
			$record_id 	= getValue("record_id","int","GET",0);
			$field 		= getValue("field","str","GET","dfsfdsfdddddddddddddddd");
			if(trim($field) != '' && in_array($field,$this->arrayField)){
				$db_query = new db_query("SELECT " . $field . " FROM " . $fs_table . " WHERE " . $this->field_id . "=" . $record_id);
				if($row = mysqli_fetch_assoc($db_query->result)){
					$value = ($row[$field]==1) ? 0 : 1;
					$db_update	= new db_execute("UPDATE " . $fs_table . " SET " . $field . " = " . $value . " WHERE " . $this->field_id . "=" . $record_id);
					unset($db_update);
					echo '<img src="' . $this->image_path . 'check_' . $value . '.gif" border="0">';
				}
				unset($db_query);
			}
			exit();
		}
		//phần sửa đổi giá trị  từng trường
		$ajaxedit 	= getValue("ajaxedit","int","GET",0);
		$id 	 		= getValue("id","str","POST","");
		$value 	 	= getValue("value","str","POST","");
		$array 	 	= trim(getValue("array","str","POST",""));

		if($ajaxedit == 1){

			$arr 		= explode(",",$id);
			$id  		= isset($arr[1]) ? intval($arr[1]) : 0;
			$field  	= isset($arr[0]) ? strval($arr[0]) : '';
			$type  	= isset($arr[2]) ? intval($arr[2]) : 0;
			if($type == 3) $_POST["value"] = str_replace(array("."),"",$value);

			//print_r($_POST);
			if($id != 0 && in_array($field,$this->arrayField)){

				$myform = new generate_form();
				$myform->removeHTML(0);
				$myform->add($field,"value",$type,0,"",0,"",0,"");

				$myform->addTable($fs_table);
				$errorMsg = $myform->checkdata();

				if($errorMsg == ""){
					$db_ex = new db_execute($myform->generate_update_SQL($this->field_id,$id));
				}


			}

			if($array!=''){
				if(in_array($array,$this->arrayField)){
					global $$array;
					$arr = $$array;
					$value = isset($arr[$value]) ? $arr[$value] : 'error';
				}
			}
			echo $value;
			exit();
		}
	}
}
?>
