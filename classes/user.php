<?

class user
{
    var $logged = 0;
    var $u_id = -1;
    var $use_idnumber = "";
    var $password = "";
    var $use_type = 0;
    var $use_name = "";
    var $use_code = "";
    var $use_avatar = "";
    var $use_gender = "";
    var $array_info_user = array();
    var $server_name = "localhost";

    /*
    init class
    login_name : ten truy cap
    password  : password (no hash)
    */
    function __construct($login_name = "", $password = "")
    {
        $login_name = replaceMQ($login_name);
        $password = replaceMQ($password);
        $checkcookie = 0;
        $this->logged = 0;

        if ($login_name == "") {
            if (isset($_COOKIE["login_name"])) $login_name = $_COOKIE["login_name"];
        }
        if ($password == "") {
            if (isset($_COOKIE["PHPSESS1D"])) $password = $_COOKIE["PHPSESS1D"];
            $checkcookie = 1;
        }

        if ($login_name == "" && $password == "") return;

        $sql_where = " AND (use_code_md5 = '" . md5($login_name) . "' OR use_idnumber_md5='" . md5($login_name) . "')";

        $db_user = new db_query("SELECT *
                                FROM users_login, members
                                WHERE use_active = 1 AND users_login.use_memid = members.id " . $sql_where);

        if ($row = mysqli_fetch_assoc($db_user->result)) {
            if ($checkcookie == 0) $password = md5($password . $row["use_salt"]);
            if ($password == $row["use_password"]) {
                $this->logged = 1;
                $this->u_id = intval($row["use_id"]);
                $this->password = $password;
                $this->use_name = $row["name"];
                $this->use_code = $row["use_code"];
                $this->use_gender = $row["use_gender"];
                $this->use_idnumber = $row["use_idnumber"];
                $this->use_type = $row["use_type"];
                $this->use_avatar = $row["avatar"];
                $this->array_info_user = $row; // Array chứa toàn bộ thông tin user
            }
        }
        unset($db_user);
    }

    /*
    save to cookie  
    time : thoi gian save cookie, neu = 0 thi` save o cua so hien ha`nh
    */
    function savecookie($time = 0)
    {
        if ($this->logged != 1) return false;

        if ($time > 0) {
            setcookie("login_name", $this->use_idnumber, time() + $time, "/", $this->server_name, null, 1);
            setcookie("PHPSESS1D", $this->password, time() + $time, "/", $this->server_name, null, 1);

            setcookie("login_name", $this->use_idnumber, time() + $time, "/", "", null, 1);
            setcookie("PHPSESS1D", $this->password, time() + $time, "/", "", null, 1);
        } else {

            //Set cookie cho domain bằng rỗng để chống lưu cookie save
            setcookie("login_name", "", time() - 365 * 24 * 60 * 60, "/", $this->server_name, null, 1);
            setcookie("PHPSESS1D", "", time() - 365 * 24 * 60 * 60, "/", $this->server_name, null, 1);

            setcookie("login_name", $this->use_idnumber, null, "/", "", null, 1);
            setcookie("PHPSESS1D", $this->password, null, "/", "", null, 1);

        }
    }

    /*
    Logout account
    */
    function logout()
    {

        //Clear saved cookie (if time > 0)
        setcookie("login_name", "", time() - 365 * 24 * 60 * 60, "/", $this->server_name, null, 1);
        setcookie("PHPSESS1D", "", time() - 365 * 24 * 60 * 60, "/", $this->server_name, null, 1);

        //Clear temporary cookie (if time==0)
        setcookie("login_name", "", null, "/", "", null, 1);
        setcookie("PHPSESS1D", "", null, "/", "", null, 1);

        $_COOKIE["login_name"] = "";
        $_COOKIE["PHPSESS1D"] = "";

        $this->logged = 0;

    }

    /*
    Remove quote
    */
    function removequote($str)
    {
        $temp = str_replace("\'", "'", $str);
        $temp = str_replace("'", "''", $temp);
        return $temp;
    }

    /*
    check_data : kiem tra xem data co phai thuoc user_id khong (check trong luc fetch_array)
    user_id : gia tri user id để so sánh
    */
    function check_data($user_id)
    {
        if ($this->logged != 1) return 0;
        if ($this->u_id != $user_id) return 0;
        return 1;
    }
}

?>