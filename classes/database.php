<?php
require_once("config_database.php");

$ipstore_dir = str_replace("classes", "ipstore", dirname(__FILE__));
define("DIR_IPSTORE",$ipstore_dir . "/");

/**
 * Class db_init
 */
class db_init
{
	var $server;
	var $username;
	var $password;
	var $database;
	
	var $secondary_server;
	var $secondary_username;
	var $secondary_password;
	var $secondary_database;
	
	var $slave_server;
	var $slave_username;
	var $slave_password;
	
	/**
	 * File error mà lớn hơn 3k (~ 120 kết nối lỗi) -> loại khỏi node
	 */
	var $max_error_slave_size = 3000;
	
	/**
	 * db_init constructor.
	 */
	function __construct()
	{
		$this->database = DATABASE_NAME;
		$this->server   = DATABASE_HOST;
		$this->username = DATABASE_USERNAME;
		$this->password = DATABASE_PASSWORD;
		
		
		$this->slave_server = $this->getSlaveServer($this->server);
		$this->slave_username = SLAVE_DATABASE_USERNAME;
		$this->slave_password = SLAVE_DATABASE_PASSWORD;
	}
	
	/**
	 * Lấy slave server
	 */
	function getSlaveServer($default_server = "localhost")
	{
		
		/**
		 * Nếu đã có server trong Const rồi thì return luôn
		 */
		if (defined("SLAVE_SERVER_IP")) return SLAVE_SERVER_IP;
		
		$array_server = SLAVE_DATABASE_HOST;
		
		/**
		 * Mảng chứa list Slave DB: IP server => Weight
		 * VD:
		 * $array_server = array(
		 * "192.168.1.84"    => 2,
		 * "192.168.1.124"   => 2,
		 * "192.168.1.11"    => 2,
		 * "192.168.1.121"   => 1,
		 * "192.168.1.120"   => 1,
		 * "192.168.1.40"    => 1
		 * );
		 */
		
		/**
		 * Disable Server
		 */
		$disable_ip = "";
		
		/**
		 * Loop array để tạo array mới, dàn đều weight thành những phần tử để lấy random
		 */
		$total_weight     = 0;
		$new_array_server = array();
		
		/**
		 * Lặp để lấy list Slave server khả dụng
		 */
		foreach ($array_server as $m_key => $m_value) {
			/**
			 * Nếu server khác server disable và file error nhỏ hơn max_error_slave_size
			 */
			if ($m_key != $disable_ip && intval(@filesize(DIR_IPSTORE . $m_key . "_error.cfn")) < $this->max_error_slave_size) {
				for ($i = 0; $i < $m_value; $i++) {
					$total_weight++;
					$new_array_server[$total_weight] = $m_key;
				}
			}
		}
		
		/**
		 * Nếu ko có server nào thì trả về server default
		 */
		if ($total_weight < 1) return $default_server;
		
		/**
		 * Bắt đầu lấy random
		 */
		$my_slave_server = rand(1, $total_weight);
		
		/**
		 * Trả về server
		 */
		if (isset($new_array_server[$my_slave_server])) {
			/**
			 * Nếu chưa có Const SLAVE_SERVER_IP thì gán bằng const
			 */
			if (!defined("SLAVE_SERVER_IP")) define("SLAVE_SERVER_IP", $new_array_server[$my_slave_server]);
			return $new_array_server[$my_slave_server];
			
		} else return $default_server;
		
	}
	
	function __destruct()
	{
		unset($this->database);
		
		unset($this->server);
		unset($this->username);
		unset($this->password);
		
		unset($this->slave_server);
		unset($this->slave_username);
		unset($this->slave_password);
		
	}
}

/**
 * Class db_query
 */
class db_query
{
	
	var       $result;
	var       $links;
	protected $use_slave;
	
	/**
	 * db_query constructor.
	 * Khởi tạo class gồm 2 tham số
	 * @param $query: Câu query
	 * @param string $use_slave: Có sử dụng slave hay ko (mặc định là rỗng)
	 */
	function __construct($query, $use_slave = "")
	{
		
		$this->use_slave    = $use_slave;
		$dbinit             = new db_init();
		$connect_successful = false;
		//echo $query;
		/**
		 * Nếu use_slave
		 */
		if ($use_slave == "USE_SLAVE") {
			/**
			 * Kết nối đến Slave server
			 */
			if ($this->links = @mysqli_connect($dbinit->slave_server, $dbinit->slave_username, $dbinit->slave_password)) {
				$connect_successful = true;
			}
			else {
				/**
				 * Gặp lỗi thì log lại
				 */
				$filename = DIR_IPSTORE . $dbinit->slave_server . "_error.cfn";
				$handle   = @fopen($filename, "a");
				if (!$handle) $handle = @fopen("../" . $filename, "a");
				if (!$handle) exit("IPstore not found");
				//fwrite($handle, date("d/m/Y h:i:s A") . " (SLAVE: " . $dbinit->slave_server . ") " . $_SERVER['REMOTE_ADDR'] . " " . $_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
				fwrite($handle, date("d/m/Y h:i:s A") . "\n");
				fclose($handle);
			}
		}
		
		$error_filename = DIR_IPSTORE . "errorconect.cfn";
		
		/**
		 * Kiểm tra connection với Master Database
		 */
		if (!$connect_successful) {
			if (!$this->links = @mysqli_connect($dbinit->server, $dbinit->username, $dbinit->password)){
				/**
				 * Thông báo lỗi khi không connect được database
				*/
				echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
				echo '<meta name="revisit-after" content="1 days">';
				echo "<div style='text-align: center'>";
				echo "Chào bạn, trang web bạn yêu cầu hiện chưa thể thực hiện được. <br>";
				echo "Xin bạn vui lòng đợi vài giây rồi ấn <b>F5 để Refresh</b> lại trang web <br>";
				echo "Chúng tôi xin trân trọng cảm ơn.";
				echo "</div>";
				
				/**
				 * Log lai loi ket noi
				 */
				$handle = @fopen($error_filename, 'a');
				if (!$handle) $handle = @fopen("../" . $error_filename, 'a');
				if (!$handle) exit();
				fwrite($handle, date("d/m/Y h:i:s A") . " " . $_SERVER['REMOTE_ADDR'] . " " . $_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
				fclose($handle);
				
				exit();
			}
			
		}
		
		if (!$db_select = @mysqli_select_db($this->links, $dbinit->database)) {
			echo("Cannot select database !");
			exit();
		}
		
		@mysqli_query($this->links, "SET NAMES 'utf8'");
		$this->result = @mysqli_query($this->links, $query . " \n" . "/* " . @$_SERVER['REMOTE_ADDR'] . " - " . @base64_encode(@$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'] . " - F:" . $file_call . " - L:" . $file_line) . " */ ");
		
		unset($dbinit);
		
		if (!$this->result) {
			
			$error = mysqli_error($this->links);
			echo $error;
			@mysqli_close($this->links);
			
			/**
			 * Ghi log lỗi
			 */
			$filename = DIR_IPSTORE . "errorsql.cfn";
			$handle   = @fopen($filename, 'a');
			if (!$handle) $handle = @fopen("../" . $filename, 'a');
			if (!$handle) exit();
			
			@fwrite($handle, date("d/m/Y h:i:s A") . " " . @$_SERVER['REMOTE_ADDR'] . " " . @$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
			@fwrite($handle, $query . "\n -----***---- \n");
			@fclose($handle);
			//-------------
			
			die("Error in query string " . $error);
		}
	}
	
	
	function close()
	{
		@mysqli_close($this->links);
	}
	
}

/**
 * Class db_execute
 */
class db_execute
{
	var $links;
	var $row_affect = 0;
	
	/**
	 * db_execute constructor.
	 *
	 * @param $query
	 * @param int $get_row_affect
	 */
	function __construct($query, $get_row_affect = 0)
	{
		$dbinit = new db_init();
		
		$this->links = @mysqli_connect($dbinit->server, $dbinit->username, $dbinit->password);
		@mysqli_select_db($this->links, $dbinit->database);
		
		unset($dbinit);
		
		@mysqli_query($this->links,"SET NAMES 'utf8'");
		@mysqli_query($this->links, $query);
		if ($get_row_affect == 1) $this->row_affect = @mysqli_affected_rows($this->links);
		
		@mysqli_close($this->links);
		
	}
}

/**
 * Class db_execute_return
 */
class db_execute_return
{
	var $links;
	var $result;
	var $last_id = 0;
	
	/**
	 * db_execute_return constructor.
	 *
	 * @param $query
	 */
	function __construct($query)
	{
		$dbinit = new db_init();
		$row = "";
		$this->links = @mysqli_connect($dbinit->server, $dbinit->username, $dbinit->password);
		@mysqli_select_db($this->links, $dbinit->database);
		
		unset($dbinit);
		@mysqli_query($this->links,"SET NAMES 'utf8'");
		@mysqli_query($this->links, $query);
		$this->result = @mysqli_query($this->links,"SELECT LAST_INSERT_ID() AS last_id");
		if ($row = @mysqli_fetch_assoc($this->result)) {
			$this->last_id = $row["last_id"];

		}
		@mysqli_close($this->links);
		
		
	}
}

?>