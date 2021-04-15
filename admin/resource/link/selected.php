<?
include("inc_security.php");
$class_menu			= new menu();
//$menu->show_count	= 1; //tính count sản phẩm
$listAll				= $class_menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "1", "cat_id,cat_name,cat_type", "cat_type ASC,cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($class_menu);

$fs_title   = "Tạo link";
$fs_action	= getURL();

// Object sẽ nhận link trả về khi create
$object		= getValue("object", "str", "GET", "");
$iCat			= getValue("iCat");

// Xác định module khi user đã chọn category
$db_module	= new db_query("SELECT cat_type FROM categories_multi WHERE cat_id = " . $iCat . " AND lang_id = " . $lang_id);
$module		= ($row = mysqli_fetch_assoc($db_module->result)) ? $row["cat_type"] : "";
$db_module->close();
unset($db_module);

// Generate query string to data
$array_data["news"]			= array("news_multi", "new_id", "new_category_id", "new_title", "new_date");
$array_data["static"]		= array("statics", "sta_id", "sta_category_id", "sta_title", "sta_date");
$array_data["product"]		= array("products", "pro_id", "pro_category_id", "pro_name", "pro_date");
foreach($array_data as $key => $value){

	if($module == $key){
		$sql_count	= "SELECT COUNT(*) AS count
							FROM categories_multi, " . $value[0] . "
							WHERE cat_id = " . $value[2] . " AND cat_type = '" . $key . "' AND cat_id = " . $iCat;
		$sql_data	= "SELECT cat_name AS nCat, " . $value[1] . " AS iData, " . $value[3] . " AS nTitle, " . $value[4] . " AS iDate
							FROM categories_multi, " . $value[0] . "
							WHERE cat_id = " . $value[2] . " AND cat_type = '" . $key . "' AND cat_id = " . $iCat;
		$arrayData	= array(0 => $value[1], 1 => $value[3], 2 => $value[4]);
		break;
	}
}
?>
<html>
<head>
<title><?=$fs_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css" media="all">@import "<?=$fs_stype_css?>";</style>
<link href="../../resource/css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../../resource/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
//---------------------------- Create link to Category -----------------------------------
$db_category 	= new db_query("SELECT cat_id AS iCat, cat_name AS nTitle, cat_type FROM categories_multi WHERE cat_id = " . $iCat);
$row				= mysqli_fetch_assoc($db_category->result);
if($row['cat_type'] == 'product'){
	$link_category	= ($iCat == 0) ? "" : createlink("product", array("nTitle" =>  $row['nTitle'] , "iData" =>  $row['iCat']));
}elseif($row['cat_type'] == 'news'){
	$link_category	= ($iCat == 0) ? "" : createlink("news", array("nTitle" =>  $row['nTitle']));
}else{
	$link_category	= ($iCat == 0) ? "" : createlink("category", array("nTitle" =>  $row['nTitle']));
}
unset($db_category);

$form = new form();
$form->create_form("create_link", $fs_action, "get", "multipart/form-data");
$form->create_table('', '', 'style="width: 98%;"');
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<tr>
	<td class="form_name"><font class="form_asterisk">* </font>Category :</td>
	<td class="form_text">
		<select class="form" id="iCat" name="iCat" onChange="change_category();">
			<option value="0">--[Chọn category]--</option>
			<?
			$cat_type = "";
			for($i = 0; $i < count($listAll); $i++){
				if($cat_type != $listAll[$i]["cat_type"]){
					$cat_type = $listAll[$i]["cat_type"];
					?>
					<optgroup label="<?=ucwords($listAll[$i]["cat_type"])?>"></optgroup>
					<?
				}
				?>
				<option value="<?=$listAll[$i]["cat_id"]?>"<? if($listAll[$i]["cat_id"] == $iCat) echo ' selected="selected"';?>><? for($j=0;$j<$listAll[$i]["level"];$j++) echo "--"; ?> <?=$listAll[$i]["cat_name"]?> </option>
				<?
			}
			?>
		</select>
	</td>
</tr>
<?=$form->text("Link tới category", "link_category", "link_category", $link_category, "Link tới category", 0, 250, "", 1000, "", 'disabled="disabled"', "")?>
<?=$form->button("button", "create_link_category", "create_link_category", "Tạo link", "Tạo link tới category", '" onClick="link_to_category()"', "");?>
<?=$form->hidden("object", "object", $object, "");?>
<?
$form->close_table();
$form->close_form();
unset($form);

//---------------------------- Create link to data -----------------------------------
if(isset($arrayData)){
	//Search data
	$id			= getValue("id");
	$keyword		= getValue("keyword", "str", "GET", "", 1);
	$sqlWhere	= "";
	//Tìm theo ID
	if($id > 0)			$sqlWhere .= " AND " . $arrayData[0] . " = " . $id . " ";
	//Tìm theo keyword
	if($keyword != "")$sqlWhere .= " AND (" . $arrayData[1] . " LIKE '%" . $keyword . "%') ";

	//Sort data
	$sort	= getValue("sort");
	switch($sort){
		case 1: $sqlOrderBy = $arrayData[0] . " ASC"; break;
		case 2: $sqlOrderBy = $arrayData[0] . " DESC"; break;
		case 3: $sqlOrderBy = $arrayData[1] . " ASC"; break;
		case 4: $sqlOrderBy = $arrayData[1] . " DESC"; break;
		case 5: $sqlOrderBy = $arrayData[2] . " ASC"; break;
		case 6: $sqlOrderBy = $arrayData[2] . " DESC"; break;
		default:$sqlOrderBy = $arrayData[0] . " DESC"; break;
	}

	//Get page break params
	$page_size		= 5;
	$page_prefix	= "Trang: ";
	$normal_class	= "page";
	$selected_class= "page_current";
	$previous		= "<";
	$next				= ">";
	$first			= "<<";
	$last				= ">>";
	$break_type		= 1;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
	$url				= getURL(0,0,1,1,"page");
	$db_count		= new db_query($sql_count . $sqlWhere);
	$listing_count	= mysqli_fetch_assoc($db_count->result);
	$total_record	= $listing_count["count"];
	$current_page	= getValue("page", "int", "GET", 1);
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	if($current_page > $num_of_page) $current_page = $num_of_page;
	if($current_page < 1) $current_page = 1;
	$db_count->close();
	unset($db_count);
	//End get page break params
	$db_listing	= new db_query($sql_data . $sqlWhere . " ORDER BY " . $sqlOrderBy . " LIMIT " . ($current_page - 1) * $page_size . ", " . $page_size);
	?>
	<div class="listing">
		<div class="header">
			<div class="search">
				<table class="table table_border_none" style="margin-bottom: 0px;">
					<form name="search" action="<?=getURL(0,0,1,0)?>" method="get">
						<tr>
							<td class="textBold" nowrap="nowrap" align="right">
								ID: <input title="ID" type="text" class="form-control" id="id" name="id" value="<?=$id?>" maxlength="11" style="width:50px">&nbsp;
								Từ khóa: <input title="Từ khóa" type="text" class="form-control" id="keyword" name="keyword" value="<?=$keyword?>" maxlength="255" style="width:100px">&nbsp;
								<input type="hidden" name="sort" value="<?=$sort?>" />
								<input type="hidden" name="object" value="<?=$object?>" />
								<input type="hidden" name="iCat" value="<?=$iCat?>" />
							</td>
							<td align="right"><input title="Tìm kiếm" type="submit" class="btn btn-xs btn-info" value="Tìm kiếm" border="0"></td>
						</tr>
					</form>
				</table>
			</div>
		</div>
	</div>
	<? //End page break and search data?>
	<table class="table table-bordered">
		<tr class="textBold">
			<td>Stt.</td>
			<td nowrap="nowrap" align="center">
				<div>
					ID <?=generate_sort("asc", 1, $sort, $fs_imagepath)?>
					<?=generate_sort("desc", 2, $sort, $fs_imagepath)?>
				</div>
			</td>
			<td align="center">
				<div>
					Tên/ Tiêu đề <?=generate_sort("asc", 3, $sort, $fs_imagepath)?>
					<?=generate_sort("desc", 4, $sort, $fs_imagepath)?>
				</div>
			</td>
			<td nowrap="nowrap" align="center">
				<div>
					Ngày cập nhật
					<?=generate_sort("asc", 5, $sort, $fs_imagepath)?>
					<?=generate_sort("desc", 6, $sort, $fs_imagepath)?>
				</div>
			</td>
			<td align="center">Tạo link</td>
		</tr>
		<?
		// Đếm số thứ tự
		$No = ($current_page - 1) * $page_size;
		while($listing = mysqli_fetch_assoc($db_listing->result)){
			$No++;
			$link 	= createlink(strtolower($module), array("nCat" => $listing["nCat"], "nTitle" => $listing["nTitle"], "iCat" => $iCat, "iData" => $listing["iData"]));
			?>
			<tr id="tr_<?=$No?>">
				<td class="No"><?=$No?></td>
				<td align="center" class="text_normal_bold">
					<?=$listing["iData"]?>
				</td>
				<td>
					<div>Tên: <a style="text-decoration:none" href="<?=$link?>" target="_blank"><?=$listing["nTitle"]?></a></div>
					<div id="link_<?=$listing["iData"]?>">Link: <?=$link?></div>
				</td>
				<td align="center">
					<div><?=(isset($listing["iDate"]) ? date("d/m/Y", $listing["iDate"]) : "No update !")?></div>
					<div style="color:#666666; font-size:10px"><?=(isset($listing["iDate"])) ? date("H:i A", $listing["iDate"]) : '';?></div>
				</td>
				<td align="center"><input type="button" class="btn btn-xs btn-danger" value="Tạo link" onClick="link_to_data('<?=$link?>')" /></td>
			</tr>
			<?
		}
		?>
	</table>
	<? if($total_record > $page_size){?>
	<table width="98%" cellpadding="2" cellspacing="2">
		<tr>
			<td class="textBold"><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
			<td class="textBold" align="right"><a title="Go to top" accesskey="T" class="top" href="#">Lên trên<img align="absmiddle" border="0" hspace="5" src="<?=$fs_imagepath?>top.gif"></a></td>
		</tr>
	</table>
	<? }?>
	<?
	$db_listing->close();
	unset($db_listing);
	?>
<?
}// End if(isset($arrayData))
?>

</body>
</html>
<script language="javascript">
function change_category(){
	frm = document.create_link;
	frm.submit();
}
function change_file(filename){
	document.getElementById("link_category").value = '<?=$fs_preview?>'+filename;
}
function link_to_category(){
	window.parent.document.getElementById("<?=$object?>").value = document.getElementById("link_category").value;
	//closeWindowPrompt();
	self.parent.closeWindowPrompt();
}

function link_to_data(str_link){
	window.parent.document.getElementById("<?=$object?>").value = str_link;
	self.parent.closeWindowPrompt();
}
</script>