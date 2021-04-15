<?php
require_once("inc_security.php");
require_once("Excel.php");

$fs_title    = "Checkin";
$fs_action   = "listing.php" . getURL(0, 0, 0, 1, "record_id");
$fs_redirect = "listing.php" . getURL(0, 0, 0, 1, "record_id");
$fs_errorMsg = "";
$mydate      = getdate(date(time()));
$month       = 7;
$year        = 2020;

$id = getValue("id", "str", "GET", "");
// echo $id;
$member_id = getValue("member_id", "int", "GET", "");
$name = getValue("name", "str", "GET", "");
$start_date = getValue("start_date", "str", "GET", "");
$finish_date = getvalue("finish_date", "str", "GET", "");
$total_time = getValue("total_time", "str", "GET", "");
$NoData = "";
$idCheckin = "";
$idCheckout = "";

//Get page break params
$page_size = 30;
$page_prefix = "Trang: ";
$normal_class = "page";
$selected_class = "page_current";
$previous = '<img align="absmiddle" border="0" src="../../resource/images/grid/prev.gif">';
$next = '<img align="absmiddle" border="0" src="../../resource/images/grid/next.gif">';
$first = '<img align="absmiddle" border="0" src="../../resource/images/grid/first.gif">';
$last = '<img align="absmiddle" border="0" src="../../resource/images/grid/last.gif">';
$break_type = 1; //"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
$url = getURL(0, 0, 1, 1, "page");

//checkin query
$sqlWhere = "";
$sqlWhereTotaltimeCheckin = "";
$sqlWhereTotaltimeCheckout = "";
$sqlQuery_checkin_select = " SELECT member_checkin.id,member_id, members.name, members.avatar, member_checkin.image, member_checkin.checkin_time
                            FROM member_checkin, members ";
$sqlQuery_checkin_where  = " WHERE MONTH(member_checkin.checkin_time)= 7 AND YEAR(member_checkin.checkin_time) = 2020
                                AND member_checkin.member_id = members.id
                                AND members.active = 1 AND member_checkin.active = 1 ";
$sqlQuery_checkin_groupby = " GROUP BY DATE(member_checkin.checkin_time), member_id ";

//checkout query
$sqlQuery_checkout_select = " SELECT member_checkin.id, member_checkin.member_id, members.name, member_checkin.checkin_time as checkout_time 
                             FROM member_checkin, members ";
$sqlQuery_checkout_where  = " WHERE member_checkin.member_id = members.id	
                                AND member_checkin.id IN (SELECT MAX(member_checkin.id) 
                                                            FROM member_checkin, members"
    . $sqlQuery_checkin_where .
    " GROUP BY DATE(checkin_time), member_id) ";

//Searching

if (isset($member_id) && is_numeric($member_id) && $member_id > 0) {  
    $sqlWhere .= " AND member_id =" . $member_id;
}
if (isset($name) && $name != "") {
    $sqlWhere .= " AND members.name LIKE '%" . $name . "%'";
}
if ($start_date != "" && $finish_date == "") {
    ?>

    <div id="finish-alert">
        <span class="glyphicon glyphicon-exclamation-sign" style="color: rgb(255, 153, 0); margin-right: 3px; font-size:15px"></span>
        Vui lòng nhập Ngày kết thúc.
        <span class="arrow-up"></span>
        <span id="finish-remove" class="glyphicon glyphicon-remove"></span>
    </div>

    <?
}
if ($start_date == "" && $finish_date != "") {
    ?>

    <div id="start-alert">
        <span class="glyphicon glyphicon-exclamation-sign" style="color: rgb(255, 153, 0); margin-right: 3px; font-size:15px"></span>
        Vui lòng nhập Ngày bắt đầu.
        <span class="arrow-up"></span>
        <span id="start-remove" class="glyphicon glyphicon-remove"></span>
    </div>

    <?
}
if (isset($start_date) && isset($finish_date)) {
    if (strtotime($start_date) && strtotime($finish_date)) {
        $sqlQuery_checkin_where  = " WHERE member_checkin.checkin_time BETWEEN '" . $start_date . " 00:00:00' 
                                        AND '" . $finish_date . " 23:59:59'
                                        AND member_checkin.member_id = members.id
                                        AND members.active = 1 AND member_checkin.active = 1";
        $sqlQuery_checkout_where  = " WHERE member_checkin.member_id = members.id	
                                AND member_checkin.id IN (SELECT MAX(member_checkin.id) 
                                                            FROM member_checkin, members"
            . $sqlQuery_checkin_where .
            " GROUP BY DATE(checkin_time), member_id) ";
    }
}

if(isset($total_time) && $total_time != 0){
    $sqlQuery_checkin  = $sqlQuery_checkin_select  .$sqlQuery_checkin_where  .$sqlWhere .$sqlQuery_checkin_groupby;
    $sqlQuery_checkout = $sqlQuery_checkout_select .$sqlQuery_checkout_where .$sqlWhere;

    $db_listing = new db_query($sqlQuery_checkin);
    $db_checkout = new db_query($sqlQuery_checkout);

    while ($list_checkin = mysqli_fetch_assoc($db_listing->result)) {
        $list_checkout = mysqli_fetch_array($db_checkout->result);

        $startTime = new DateTime($list_checkin["checkin_time"]);
        $finishTime = new DateTime($list_checkout["checkout_time"]);
        $diff = $finishTime->diff($startTime);

        if(($diff->format("%s") + $diff->format("%i")*60 + $diff->format("%h")*60*60) >= ($total_time*60*60)
            && ($diff->format("%s") + $diff->format("%i")*60 + $diff->format("%h")*60*60) <=(($total_time+1)*60*60)){
            if($idCheckin == "" && $idCheckout == ""){
                $idCheckin  .= $list_checkin["id"];
                $idCheckout .= $list_checkout["id"];
            }
            else{
                $idCheckin  .= "," . $list_checkin["id"];
                $idCheckout .= "," . $list_checkout["id"];
            }
        }
    }
    $sqlWhereTotaltimeCheckin .= " AND member_checkin.id IN (".$idCheckin.")";
    $sqlWhereTotaltimeCheckout .= " AND member_checkin.id IN (".$idCheckout.")";
}

$db_count = new db_query($sqlQuery_checkin_select  .$sqlQuery_checkin_where  .$sqlWhere .$sqlWhereTotaltimeCheckin .$sqlQuery_checkin_groupby );

$total_record = 0;
while ($listing_count = mysqli_fetch_assoc($db_count->result)) {
    $total_record++;
}
$current_page = getValue("page", "int", "GET", 1);
if ($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if ($current_page > $num_of_page) $current_page = $num_of_page;
if ($current_page < 1) $current_page = 1;
unset($db_count);

$sqlQuery_checkin_limit = " LIMIT " . ($current_page - 1) * $page_size . "," . $page_size;

$sqlQuery_checkout_limit = " LIMIT " . ($current_page - 1) * $page_size . "," . $page_size;

$sqlQuery_checkin  = $sqlQuery_checkin_select  .$sqlQuery_checkin_where  .$sqlWhere .$sqlWhereTotaltimeCheckin  .$sqlQuery_checkin_groupby .$sqlQuery_checkin_limit;
$sqlQuery_checkout = $sqlQuery_checkout_select .$sqlQuery_checkout_where .$sqlWhere .$sqlWhereTotaltimeCheckout .$sqlQuery_checkout_limit;

$db_listing = new db_query($sqlQuery_checkin);
$db_checkout = new db_query($sqlQuery_checkout);


if ($NoData == "") {
    $db_listing = new db_query($sqlQuery_checkin);
    $db_checkout = new db_query($sqlQuery_checkout);
}
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="../../resource/css/mycss.css">
    <script language="javascript" src="../../resource/js/grid.js"></script>
</head>

<body class="bg" style="font-size: 11px !important;" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
    <div id="show"></div>
    <? /*---------Body------------*/ ?>
    <div class="listing">
        <div class="header">
            <h3>Danh sách Checkin</h3>

            <div class="search" style="width: 99.4%">
                <form action="listing.php" method="get" name="form_search" onsubmit="check_form_submit(this); return false">
                    <input type="hidden" name="search" id="search" value="1">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%">
                        <tbody>
                            <tr>
                                <td class="text">Mã nhân viên</td>
                                <td><input type="number" class="form-control" name="member_id" id="member_id" value="<?= $member_id ?>" placeholder="Mã nhân viên" style="width: 200px" /></td>
                                <td class="text">Họ và tên</td>
                                <td><input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" placeholder="Họ và tên" style="width: 200px" /></td>
                                <td class="text">Tổng Thời Gian</td>
                                <td><input type="number" id="time-total" class="form-control" name="total_time" value="<?= $total_time ?>" placeholder="Tổng thời gian" style="width: 200px" /></td>
                            </tr>
                            <tr>
                                <td class="text">Ngày bắt đầu</td>
                                <td><input type="date" class="form-control" name="start_date" id="checkin_time" value="<?= $start_date ?>" placeholder="Thời gian checkin" style="width: 200px" /></td>
                                <td class="text">Ngày kết thúc</td>
                                <td><input type="date" class="form-control" name="finish_date" id="checkout_time" value="<?= $finish_date ?>" placeholder="Thời gian checkout" style="width: 200px" /></td>
                                <td>
                                    <button type="submit" id="search" class="btn btn-sm btn-info" style="float:right; width: 80px; outline:none"> 
                                        <i class="fas fa-search"></i>
                                        Tìm kiếm 
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" style="outline:none" onclick="searchBtn()"> 
                                        <i class="fas fa-redo-alt"></i>
                                        Làm mới 
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                <script type="text/javascript">
                    function check_form_submit(obj) {
                        document.form_search.submit();
                    };
                </script>
            </div>

            <div style="padding: 0px 0px 5px 5px; margin-top: 6px; margin-bottom: -5px">
                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#form_export"><i class="fa fa-file-excel-o"></i> Xuất Excel Danh sách Checkin</button>
            </div>
        </div>

        <div class="content">
            <div class="table-container2">
                <div style="clear: both;"></div>
                <table cellpadding="5" cellspacing="0" class="table table-hover table-bordered table-sticky table-color2" width="100%">
                    <tr class="warning stick">
                        <td class="h" width="40" style="text-align: center">STT</td>
                        <!--                    <td width="50" class="h check">-->
                        <!--                        <input type="checkbox" id="check_all" onclick="checkall(-->
                        <?//= $num_row ?>
                        <!--)">-->
                        <!--                    </td>-->
                        <td class="h">Mã nhân viên</td>
                        <td class="h">Họ và Tên</td>
                        <td class="h">Avatar</td>
                        <td class="h">Image</td>
                        <td class="h">Thời gian Checkin</td>
                        <td class="h">Thời gian Checkout</td>
                        <td class="h">Tổng thời gian</td>
                    </tr>
                    <?
                //Đếm số thứ tự
                $No = ($current_page - 1) * $page_size;
                
                if(isset($NoData) && $NoData != "" ){
                    ?>
                    <tr>
                        <td cols></td>
                    </tr>
                    <?
                }
                else{
                    while ($listing = mysqli_fetch_assoc($db_listing->result)) {
                        $list_checkout = mysqli_fetch_array($db_checkout->result);

                        $startTime = new DateTime($listing["checkin_time"]);
                        $finishTime = new DateTime($list_checkout["checkout_time"]);
                        $diff = $finishTime->diff($startTime);

                        $No++;
                        ?>
                        <tr id="tr_<?= $listing["id"] ?>">
                            <td width="40" style="text-align:center"><span style="color:#142E62; font-weight:bold"><?= $No ?></span></td>
                            <td>
                                <? echo $listing["member_id"] ?>
                            </td>
                            <td>
                                <? echo $listing["name"] ?>
                            </td>
                            <td>
                                <div class="avatar-img">
                                    <img src="<? echo $listing["avatar"] ?>" alt="avatar">
                                </div>
                            </td>
                            <td>
                                <img src="<? echo $listing["image"] ?>" alt="image">
                            </td>
                            <td>
                                <? echo $listing["checkin_time"] ?>
                            </td>
                            <td><? echo $list_checkout["checkout_time"] ?></td>
                            <td><?
                                print($diff->format("%H:%I:%S"));
                                ?></td>
                        </tr>
                        <?
                     }
                } ?>
                </table>
            </div>
        </div>

        <div class="footer" style="width: 99.4%">
            <table cellpadding="5" cellspacing="0" width="100%" class="page_break">
                <tbody>
                    <tr>
                        <td width="150">Tổng số bản ghi : <span id="total_footer"><?= formatCurrency($total_record) ?></span>
                        </td>
                        <td>
                            <?
                                if ($total_record > $page_size) {
                                    echo generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type, 0, 15);
                                }

                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <? 
            if ($total_record == 0)
            {
                echo "<div class='no-data'> 
                        <img src='../../../images/no-data2.png' alt='data not found'>
                        <p> Không tìm thấy dữ liệu</p>
                     </div>";
            }
        ?>

    </div>

    <? /*---------Body------------*/ ?>

    <div id="form_export" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="listing.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-file-excel-o"></i> Xuất Excel Chấm Công Nhân Viên</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sell">Chọn năm</label>
                            <div id="listFaculties">
                                <select class="form-control" title="Chọn Năm" id="year_id" name="year_id">
                                    <option value="">- Chọn Năm -</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sell">Chọn tháng</label>
                            <div id="listMonth">
                                <select class="form-control" title="Chọn Tháng" id="month_id" name="month_id" required onchange="month()">
                                    <option value="">- Chọn Tháng -</option>
                                    <option value="1"> Tháng 1 </option>
                                    <option value="2"> Tháng 2 </option>
                                    <option value="3"> Tháng 3 </option>
                                    <option value="4"> Tháng 4 </option>
                                    <option value="5"> Tháng 5 </option>
                                    <option value="6"> Tháng 6 </option>
                                    <option value="7"> Tháng 7 </option>
                                    <option value="8"> Tháng 8 </option>
                                    <option value="9"> Tháng 9 </option>
                                    <option value="10"> Tháng 10 </option>
                                    <option value="11"> Tháng 11 </option>
                                    <option value="12"> Tháng 12 </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div id="loading">
                            <div class="loader"></div>
                        </div>
                        <input type="hidden" id="action" name="action" value="export"/>
                        <div id="excel-button">
                            <button id="export_excel" type="submit" name="export_btn" class="btn btn-primary" style="outline: none" disabled onclick="loadBtn()"><i class="fa fa-file-excel-o"></i> Xuất Excel</button>
                            <div id="blur"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function approveAll(total) {
        var total_footer = document.getElementById("total_footer").innerHTML;
        var listid = '0';
        var selected = false;
        for (i = 1; i <= total; i++) {
            if (document.getElementById("record_" + i).checked == true) {
                id = document.getElementById("record_" + i).value;
                listid += ',' + id;
                total_footer = total_footer - 1;
                selected = true;
            }
        }

        if (selected === true) {
            $.ajax({
                type: "POST",
                url: "update_status.php",
                data: "record_id=" + listid,
                success: function(data) {
                    alert(data.msg);
                    if (parseInt(data.status) == 1) {
                        for (i = 1; i <= total; i++) {
                            if (document.getElementById("record_" + i).checked == true) {
                                id = document.getElementById("record_" + i).value;
                                $("#tr_" + id + " td:last").html('<span class="label label-success">Đã duyệt</span>');
                            }
                        }
                    }
                },
                dataType: "json"
            });
        }
    }

    $(document).ready(function() {
        var start_year = 1900;
        var end = new Date().getFullYear();
        var options = "";

        for (var year = start_year; year <= end; year++) {
            options += "<option value='" + year + "'>" + year + "</option>";
        }
        document.getElementById("year_id").innerHTML = options;

        (function() {
            var default_select = (document.getElementById("year_id").value = end);
        })();

        var time = 1;
        if (time == 1) {
            $("#time-total").attr('type', 'time');
        }

        var blank = "../../../images/blank-photo.png";
        if ( $(".avatar-img img").attr('src') == '')
        {
            $(".avatar-img img").attr('src', blank );
        }
    });

    const finish = document.getElementById("finish-alert");
    const finish_remove = document.getElementById("finish-remove");

    finish_remove.addEventListener("click", () => (finish.style.opacity = "0"));
    finish.addEventListener("transitionend", () => finish.remove());

    setTimeout(() => {
        const finish_alert = document.getElementById("finish-alert");
        finish_alert.style.opacity = "0";
        finish_alert.addEventListener("transitionend", () => finish_alert.remove());
    }, 3000);

    const start = document.getElementById("start-alert");
    const start_remove = document.getElementById("start-remove");
    
    start_remove.addEventListener("click", () => (start.style.opacity = "0"));
    start.addEventListener("transitionend", () => start.remove());

    setTimeout(() => {
        const start_alert = document.getElementById("start-alert");
        start_alert.style.opacity = "0";
        start_alert.addEventListener("transitionend", start_alert.remove());
    }, 3000);

    function searchBtn() {
        document.getElementById("member_id").value = "0";
        document.getElementById("name").value = "";
        document.getElementById("time-total").value = "";
        document.getElementById("checkin_time").value = "";
        document.getElementById("checkout_time").value = "";
    }

    function month() {
        var month_select = document.getElementById("month_id");
        var button_select = document.getElementById("export_excel");

        button_select.disabled = !month_select.value;
    }

    function loadBtn() {
        var loading = document.getElementById("loading");
        var block = document.getElementById("blur");
        var export_button = document.getElementById("export_excel");
        loading.style.display = "block"; 
        block.style.display = "block";
        // export_button.disabled = true;

        setTimeout(function(){
            loading.style.display = "none";
            block.style.display = "none";
            // export_button.disabled = false;
        }, 5000);
    }
    
</script>

<style type="text/css">
    .page {
        padding: 2px;
        font-weight: bold;
        color: #333333;
    }

    .page_current {
        padding: 2px;
        font-weight: bold;
        color: red;
    }

    input[type=time]::-webkit-datetime-edit-text {
        padding: 2px 5px;
    }

    #form_export .form-control,
    #form_import .form-control {
        width: 100% !important;
        height: 30px;
        line-height: 30px;
    }
</style>