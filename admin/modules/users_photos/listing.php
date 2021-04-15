<?
require_once("inc_security.php");
//Khai báo biến khi hiển thị danh sách
$fs_title = "Duyệt Ảnh";
$fs_action = "listing.php" . getURL(0, 0, 0, 1, "record_id");
$fs_redirect = "listing.php" . getURL(0, 0, 0, 1, "record_id");
$fs_errorMsg = "";

$keyword = getValue("keyword", "str", "GET", "");
$position = getValue("position", "str", "GET", "");


$sqlWhere = "";

if ($keyword != "") {
    $sqlWhere .= " AND name LIKE '%" . $keyword . "%'";
}

//Tìm theo keyword
if ($position != "") {
    $sqlWhere .= " AND position LIKE '%" . $position . "%'";
}

//Sort data
$sort = getValue("sort");
switch ($sort) {
    default:
        $sqlOrderBy = "id DESC";
        break;
}


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

$db_count = new db_query("SELECT COUNT(*) AS count
                          FROM members
                          WHERE 1 " . $sqlWhere);

//	LEFT JOIN users ON(uso_user_id = use_id)
$listing_count = mysqli_fetch_assoc($db_count->result);
$total_record = $listing_count["count"];
$current_page = getValue("page", "int", "GET", 1);
if ($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if ($current_page > $num_of_page) $current_page = $num_of_page;
if ($current_page < 1) $current_page = 1;
unset($db_count);
//End get page break params

$db_listing = new db_query("SELECT *
                            FROM members
                            WHERE 1 " . $sqlWhere . "
                            ORDER BY " . $sqlOrderBy . "
                            LIMIT " . ($current_page - 1) * $page_size . "," . $page_size);
$num_row = mysqli_num_rows($db_listing->result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="../../resource/css/mycss.css" type="text/css">
    <script language="javascript" src="../../resource/js/grid.js"></script>
</head>

<body class="bg" style="font-size: 11px !important;" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
    <div id="show"></div>
    <? /*---------Body------------*/ ?>
    <div class="listing">
        <div class="header">
            <h3>Duyệt ảnh người dùng</h3>

            <div class="search" style="width: 99.4%">
                <form action="listing.php" methor="get" name="form_search" onsubmit="check_form_submit(this); return false">
                    <input type="hidden" name="search" id="search" value="1">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr>
                                <td class="text">Họ và Tên</td>
                                <td><input type="text" class="form-control" name="keyword" id="keyword" value="<?= $keyword ?>" placeholder="Họ và Tên" style="width: 200px" /></td>
                                <td class="text">Chức vụ</td>
                                <td><input type="text" class="form-control" name="position" id="position" value="<?= $position ?>" placeholder="Chức vụ" style="width: 200px" /></td>
                                <td>&nbsp;<input type="submit" class="btn btn-sm btn-info" value="Tìm kiếm"></td>
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
        </div>

        <div class="content">
            <div class="table-container">
                <div style="clear: both;"></div>
                <table cellpadding="5" cellspacing="0" class="table table-hover table-bordered table-sticky" width="100%">
                    <tr class="warning stick">
                        <td class="h" width="40" style="text-align: center">STT</td>
                        <!--                    <td width="50" class="h check">-->
                        <!--                        <input type="checkbox" id="check_all" onclick="checkall(-->
                        <?//= $num_row ?>
                        <!--)">-->
                        <!--                    </td>-->
                        <td class="h">Ảnh</td>
                        <td class="h">Họ và Tên</td>
                        <td class="h">Chức vụ</td>
                        <td class="h">Ngày tạo</td>
                        <td class="h" width="100">Trạng thái</td>
                    </tr>
                    <?
                //Đếm số thứ tự
                $No = ($current_page - 1) * $page_size;
                while ($listing = mysqli_fetch_assoc($db_listing->result)) {
                    $No++;
                    ?>
                    <tr id="tr_<?= $listing["id"] ?>" class="table-color1">
                        <td width="40" style="text-align:center"><span style="color:#142E62; font-weight:bold"><?= $No ?></span></td>
                        <!--                        <td class="check" style="text-align: center;"><input type="checkbox" class="check"-->
                        <!--                                                                             name="record_id[]" id="record_-->
                        <?//= $No ?>
                        <!--"-->
                        <!--                                                                             value="-->
                        <?//= $listing["use_id"] ?>
                        <!--"></td>-->
                        <td>
                            <?php
                            if ($listing["avatar"] != "") {
                                echo "<img src='" . $listing["avatar"] . "' alt='ảnh đại diện'>";
                            } else {
                                echo " ";
                            }
                            ?>
                        </td>
                        <td><?= $listing["name"] ?></td>
                        <td><?= $listing["position"] ?></td>
                        <td>
                            <?= $listing["created_date"] ?>
                        </td>
            </div>

            <td style="vertical-align: middle; text-align: center">
                <?
                    if ($listing['avatar'] != "") {
                        echo '<span class="label label-success">Đã duyệt</span>';
                    } else {
                        echo '<span class="label label-warning">Chưa duyệt</span>';
                    }
                ?>

                <?
                    if ($listing['avatar'] == "") {
                ?>
                <a href="detail.php?record_id=<?= $listing['id'] ?>" class="btn btn-xs btn-primary" style="margin-top: 10px">
                    <i class="fa fa-check" aria-hidden="true"></i> Duyệt ảnh
                </a>
                <?
                    }else{
                ?>
                <a href="detail.php?record_id=<?= $listing['id'] ?>" class="btn btn-xs btn-primary" style="margin-top: 10px">
                    <i class="fa fa-eye" aria-hidden="true"></i> Xem ảnh
                </a>
                <?
                    }
                ?>
            </td>
            </tr>
            <? } ?>
            </table>
        </div>
    </div>

    <div class="footer">
        <table cellpadding="5" cellspacing="0" width="100%" class="page_break">
            <tbody>
                <tr>
                    <!--                <td width="150">-->
                    <!--                    <button class="btn btn-sm btn-primary"-->
                    <!--                            onclick="if (confirm('Bạn có chắc chắn muốn duyệt ảnh cho những người dùng đã chọn ?')){ approveAll(-->
                    <?//= $total_record ?>
                    <!--); }">-->
                    <!--                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Duyệt tất cả-->
                    <!--                    </button>-->
                    <!--                </td>-->
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
    </div>

    <? /*---------Body------------*/ ?>
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
</style>