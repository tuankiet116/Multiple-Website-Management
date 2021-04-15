<?
/*
Lưu ý rất quan trọng, đối với hđh 64bit - ip2long từ 0 -> 4,1 tỉ
							 đối với hđh 32bit - ip2long từ -2,1 tỉ -> 2,1 tỉ
Do vậy bảng IP ở OS 64bit phải sử dụng unsigned integer
*/

class denyconnect{
	//Timeout tính bằng s
	var $timeout = 10;
	//Tổng số connect cho phép trong tgian timeout
	var $total_connect 		= 17;
	var $deny_ip 		 		= "";
	var $max_allow_connect	= 35;
	var $reach_ban_limit		= 45;
	/*
	Khởi tạo class
	$total_connect : Max connect cho phép mặc định là 0
	*/
	function __construct($total_connect=0){
		//Kiểm tra total_connect nếu > 0 gán vào biến global
		if ($total_connect > 0) $this->total_connect = $total_connect;

		//Nếu ip được tin tưởng => return
		//Thiết lập deny IP
		$this->deny_ip		= $_SERVER['REMOTE_ADDR'];

		//Convert sang dang Long
		$deny_ip_long		= intval(@ip2long($this->deny_ip));

		//Ưu tiên 1 số IP bên ngoài 2 IP Proxy của FPT
		//if ($this->deny_ip == "210.245.31.7" || $this->deny_ip == "210.245.31.15") $this->total_connect = 22;

		if(defined("IP_IS_TRUSTED")){
			return;
		}


		//Danh sách các IP tin tưởng, Googbot, Yahoobot, Bingbot, Facebook ...
		$array_trust_ip = array("66.249.",
										"67.195.",
										"72.30.",
										"72.30.",
										"65.55.",
										"66.220.",
										"66.220.",
										"74.6.",
										"157.56.",
										"157.55.",
										"95.108.",
										"113.52.",
										"123.30.",
										);

		$check_ip = 1;
		//Kiểm tra xem IP có nằm trong danh sách tin tưởng không?
		foreach ($array_trust_ip as $m_key => $m_value){
			if (strpos($this->deny_ip, $m_value) === 0){
				$check_ip = 0;
				break;
			}
		}


		/*
		$array_ip = array("1.5",
								"58.",
								"61.28.",
								"65.110.",
								"69.13.",
								"99.",
								"112.",
								"113.",
								"115.",
								"116.",
								"117.",
								"118.",
								"119.",
								"120.",
								"122.",
								"123.",
								"124.",
								"125.",
								"126.",
								"127.",
								"134.159.",
								"169.211.",
								"172.",
								"183.",
								"192.",
								"195.",
								"196.",
								"197.",
								"198.",
								"199.",
								"200.",
								"201.",
								"202.",
								"203.77.",
								"203.99.",
								"203.113.",
								"203.119.",
								"203.128.",
								"203.160.",
								"203.161.",
								"203.162.",
								"203.170.",
								"203.171.",
								"203.176.",
								"203.189.",
								"203.190.",
								"203.191.",
								"203.201.",
								"203.210.",
								"204.",
								"205.",
								"206.",
								"210.",
								"218.100.",
								"218.186.",
								"219.",
								"220.",
								"221.",
								"222.",
								"223.",
								);

		$check_ip = 0;
		//Kiểm tra xem IP có nằm trong khoảng kiểm soát hay ko?
		foreach ($array_ip as $m_key=>$m_value){
			//if (strpos($this->deny_ip,$m_value)!==false){
			if (strpos($this->deny_ip, $m_value) === 0){
				$check_ip = 1;
				break;
			}
		}
		*/

		//echo $check_ip;
		//Nếu IP nằm trong khoảng kiểm soát
		if ($check_ip == 1){
			//Kiêm tra xem có bị ban vĩnh viễn ko?
			if(file_exists("../ipbanned/" . $deny_ip_long . ".cfn")){
				echo "Ch&#224;o b&#7841;n, hi&#7879;n t&#7841;i ch&#250;ng t&#244;i &#273;ang ti&#7871;n h&#224;nh n&#226;ng c&#7845;p Server. <br>";
				echo "Xin b&#7841;n vui l&#242;ng quay l&#7841;i sau v&#224;i ti&#7871;ng n&#7919;a  !";
				//Save vào log file
				$filename = "../ipstore/ipdenyconnect.cfn";
				$handle = @fopen($filename, 'a');

				if (!$handle) exit();

				fwrite($handle, date("d/m/Y h:i:s A") . " - Banned /" . $this->reach_ban_limit . " - " . $this->deny_ip . " " . $_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . " " . @$_SERVER['HTTP_USER_AGENT'] . "\n");
				fclose($handle);

				exit();
			}

			//Thiết lập table để lưu thông tin về IP
			$table_ip_denyconnect = "ip_denyconnect_" . (abs($deny_ip_long) % 10);

			$today = getdate();
			$total_count = 0;

			//Đếm tổng số connect trong khoảng tgian timeout
			$db_count = new db_query("SELECT COUNT(*) AS count
											  FROM " . $table_ip_denyconnect . " USE INDEX (ip)
											  WHERE ip = " . $deny_ip_long . " AND time >= " . ($today[0] - $this->timeout),
											  __FILE__, "", 1);
			if ($row = mysql_fetch_array($db_count->result)){
				$total_count = $row["count"];
			}

			//Nếu vượt qua ngưỡng cho phép time sẽ + thêm 1min nữa để ban vĩnh viễn trong 1min tới
			if ($total_count >= $this->max_allow_connect) $today[0] = $today[0] + 60;

			//Nếu đạt mức ban thì ghi ra file để ban vĩnh viễn
			if ($total_count >= $this->reach_ban_limit){
				$filename = "../ipbanned/" . $deny_ip_long . ".cfn";
				$handle = @fopen($filename, 'a');
				if (!$handle) exit();
				fwrite($handle, "Ban");
				fclose($handle);
			}

			//insert IP vao database
			$db_insert = new db_execute("INSERT INTO " . $table_ip_denyconnect . " VALUES(" . $deny_ip_long . "," . $today[0] . ")", 1);

			//Kiểm tra total_count nếu >= ngưỡng cho phép thì deny luôn
			if ($total_count >= $this->total_connect){
				//Đưa ra thông báo lỗi
				echo "Xin ch&#224;o, hi&#7879;n t&#7841;i b&#7841;n &#273;ang truy c&#7853;p Website " . @$_SERVER["SERVER_NAME"] . " v&#7899;i t&#7889;c &#273;&#7897; qu&#225; nhanh :). <br>";
				echo "Xin b&#7841;n vui l&#242;ng ch&#7901; 30s n&#7919;a r&#7891;i &#7845;n <b>F5</b> &#273;&#7875; ti&#7871;p truy c&#7853;p Website, ch&#250;ng t&#244;i xin ch&#226;n th&#224;nh c&#7843;m &#417;n !";
				//Save vào log file
				$filename = "../log/ipdenyconnect.cfn";
				$handle = @fopen($filename, 'a');

				if (!$handle) exit();

				fwrite($handle, date("d/m/Y h:i:s A") . " - " . $total_count . "/" . $this->total_connect . " - " . $this->deny_ip . " " . $_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . " " . @$_SERVER['HTTP_USER_AGENT'] . "\n");
				fclose($handle);

				exit();
			}

			unset($db_insert);
			unset($db_count);
		}

	}

}

?>