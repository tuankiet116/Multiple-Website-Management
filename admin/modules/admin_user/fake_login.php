<?php
include("inc_security.php");

// Không phải supperAdmin thì deny luôn
if ($is_admin != 1) {
    redirect($fs_denypath);
    die();
}

// Id của admin cần fake login
$admin_fake = getValue("admin_id", "int", "GET", 0);

$db_query = new db_query("SELECT * FROM admin_user WHERE adm_id = " . $admin_fake);
if ($row = mysqli_fetch_assoc($db_query->result)) {
    $_SESSION["Logged"] = 1;
    $_SESSION["logged"] = 1;
    $_SESSION["user_id"] = $admin_fake;
    $_SESSION["userlogin"] = $row['adm_loginname'];
    $_SESSION["password"] = $row['adm_password'];
    $_SESSION["isAdmin"] = 0;
    $_SESSION["lang_id"] = $row["lang_id"];
    $_SESSION["lang_id"] = get_curent_language();
    $_SESSION["lang_path"] = get_curent_path();

    echo '<script type="text/javascript">window.parent.location.href="../../";</script>';

} else {

    die("Không tìm thấy dữ liệu");

}
unset($db_query);
?>