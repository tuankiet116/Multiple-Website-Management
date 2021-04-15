<?php
if(!defined('DEBUG_BACKTRACE_IGNORE_ARGS')) define('DEBUG_BACKTRACE_IGNORE_ARGS',2);
/**
* CURL client PHP
* @author <diepcd@gmail.com>
*/

/**
 * Client Interface
 *
 * All clients must implement this interface
 *
 * The 4 http functions just need to return the raw data from the API
 */
interface ClientInterface {

    function get( $url, array $data = array() );
    function post( $url, array $data = array() );
    function put( $url, array $data = array() );
    function delete( $url, array $data = array() );

}

/**
 * Curl Client
 *
 * Uses curl to access the API
 */
class CurlClient implements ClientInterface {

		/**
		* Curl Resource
		*
		* @var curl resource
		*/
		protected $curl = null;
		/**
		* Thoi gian bat dau xu ly curl
		*/
		protected $start_generate_time   = 0;
		protected $timeOutConnect			= 2; //thoi gian mac dinh timeout la 1 giay
		protected $messageToIdVG			= array();
		protected $arrayStructMessage		= array("subject" => ""
															 ,"content" => ""
															 ,"data"		=> ""
															 ,"users"	=> ""
															 );
		
		/**
		* Constructor
		*
		* Initializes the curl object
		*/
		function __construct($timeOut = 1){
		  $this->timeOutConnect = $timeOut;
		  $this->initializeCurl();
		}
		
		/**
		* SET authen digest
		*
		* @param string $username ten tk dang nhap authen
		* @param string $password mat khau
		* @access public
		*/
		
		function setAuthenDigest($username, $password){
			curl_setopt($this->curl, CURLOPT_USERPWD, $username . ":" . $password);
			curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
		}
		
		/**
		 * Ham truyen api_key va secret len
		 */
	 	function setApiSecretKey($api_id, $secret_key){
	 		$nonce     = rand(0, 99999999);
			$timestamp = time();
			$api_key   	= $api_id;
			$api_secret   = $secret_key;
			$hash      = md5("$nonce:$api_key:$api_secret:$timestamp");
			$digest    = "$nonce:$api_key:$timestamp:$hash";
	 		curl_setopt($this->curl,CURLOPT_HTTPHEADER,array('X-Spreaker-Auth: ' . $digest));
	 	}
		
		
		/**
		* GET
		*
		* @param string $url URL to send get request to
		* @param array $data GET data
		* @return Response
		* @access public
		*/
		public function get( $url, array $data = array() ){
		  curl_setopt( $this->curl, CURLOPT_CUSTOMREQUEST, 'GET' );
		  if(empty($data)){
		  		curl_setopt( $this->curl, CURLOPT_URL, $url);
		  }else{
		  		curl_setopt( $this->curl, CURLOPT_URL, sprintf( "%s?%s", $url, http_build_query( $data ) ) );
		  }
		  $data = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		  $data = array_shift($data);
		  return $this->fetch($data);
		}
		
		/**
		* POST
		*
		* @param string $url URL to send post request to
		* @param array $data POST data
		* @return Response
		* @access public
		*/
		public function post( $url, array $data = array() ) {
		  curl_setopt( $this->curl, CURLOPT_CUSTOMREQUEST, 'POST' );
		  curl_setopt( $this->curl, CURLOPT_URL, $url );
		  curl_setopt( $this->curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
		  $data = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		  $data = array_shift($data);
		  return $this->fetch($data);
		}
		
		/**
		* POST
		*
		* @param string $url URL to send message to fb
		* @param array $data POST data {
		*	"subject": Tiêu đề của tin,
		*    "content": nội dung tin,
		*    "data": dữ liệu đi kèm tin (là mảng/dictionary),
		*    "link": link của tin,
		*    "users": "Các user_id nhận được thông báo, ngăn cách bởi ; hoặc ,",
		*    "link": "Link của tin, được sử dụng trong một số protocol như Facebook ...",
		}
		* @return Response
		* @access public
		*/
		public function addMessageFaceBook($subject, $content, $data, $link, $users) {
			$this->messageToIdVG["subject"]	=	$subject;
			$this->messageToIdVG["content"]	=	$content;
			$this->messageToIdVG["data"]		=	$data;
			$this->messageToIdVG["link"]		=	$link;
			$this->messageToIdVG["users"]		=	$users;
			$this->messageToIdVG["messengers"]["fbpns"]	= array();
		}
		
		/**
		* POST to id.vatgia.com
		*/
		public function SendMessage() {
		  $data_string = json_encode( $this->messageToIdVG );
		  echo $data_string .'<hr>';
		  curl_setopt( $this->curl, CURLOPT_CUSTOMREQUEST, 'POST' );
		  curl_setopt( $this->curl, CURLOPT_URL, "http://services.vnpid.com/api/notification/message/" );
		  curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(                                                                          
																	    'Content-Type: application/json',                                                                                
																	    'Content-Length: ' . strlen($data_string))                                                                       
																	);     
		  curl_setopt( $this->curl, CURLOPT_POSTFIELDS, $data_string );
		  $data = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		  $data = array_shift($data);
		  return $this->fetch($data);
		}
		
		
		/**
		* POST
		*
		* @param string $phone_number so dien thoai hoac array so dien thoai
		* @param array $content noi dung SMS 
		* @return Response
		* @access public
		*/
		public function sendSMSToPhone($phone_number, $content, $is_viber = 0) {
			$str_phone = '';
			if(is_array($phone_number)){
				foreach($phone_number as $key => $phone){
					$phone = preg_replace("/[^0-9]/","",$phone);	
					if(strlen($phone) > 9 && strlen($phone) < 13){
						$str_phone .= $phone . ";";
					}
				}
			}else{
				$phone_number = preg_replace("/[^0-9]/","",$phone_number);	
				if(strlen($phone_number) > 9 && strlen($phone_number) < 13){
					$str_phone = $phone_number;
				}
			}
			
			if($str_phone == '') return 0;
			
			$data_send_sms = array(
									    "phone_number" => $str_phone,
									    "sms" => $content,
									    "username" => SMS_USERNAME,
									    "password" => md5(SMS_PASSWORD)
									);
			if($is_viber == 1){
				$data_send_sms["send_vb"]	= 1;
			}						
			return $this->post(SMS_URL_API, $data_send_sms);
		}
		
		
		/**
		* PUT
		*
		* @param string $url URL to send put request to
		* @param array $data PUT data
		* @return Response
		* @access public
		*/
		public function put( $url, array $data = array()  ){
		  curl_setopt( $this->curl, CURLOPT_CUSTOMREQUEST, 'PUT' );
		}
		
		/**
		* DELETE
		*
		* @param string $url URL to send delete request to
		* @param array $data DELETE data
		* @return Response
		* @access public
		*/
		public function delete( $url, array $data = array()  ){
		  curl_setopt( $this->curl, CURLOPT_URL, sprintf( "%s?%s", $url, http_build_query( $data ) ) );
		  curl_setopt( $this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE' );
		  $data = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		  $data = array_shift($data);
		  return $this->fetch($data);
		}
		
		/**
		* Initialize curl
		*
		* Sets initial parameters on the curl object
		*
		* @access protected
		*/
		protected function initializeCurl() {
			$this->start_generate_time = $this->microtime_float();
			$this->curl = curl_init();
			curl_setopt( $this->curl, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $this->curl, CURLOPT_SSL_VERIFYPEER, false );
			//thoi gian mac dinh cho phep connect
			curl_setopt( $this->curl, CURLOPT_TIMEOUT, $this->timeOutConnect);
			curl_setopt( $this->curl, CURLOPT_FOLLOWLOCATION, true);
		}
		
		/**
		* Fetch
		*
		* Execute the curl object
		*
		* @return StdClass
		* @access protected
		* @throws ApiException
		*/
		protected function fetch($debug_backtrace) {
		  $raw_response = curl_exec( $this->curl );
		  $error = curl_error( $this->curl );
		  $code 	= curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
		  $url 	= curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL );
		  $debug_backtrace["code"]		= $code;
		  $debug_backtrace["url"]		= $url;
		  $debug_backtrace["error"]	= $error;
		  if ( $error ) {
		      //bat dau ghi log loi vao file
				$this->saveLog("curlclient_error.cfn", $debug_backtrace);
		  }
		  //curl_close($this->curl);
		  //bat dau tinh thoi gian xu ly
		  $time_request = $this->microtime_float() - $this->start_generate_time;
		  //sau day tiep tuc gan lai thoi gian de xu ly tiep
		  $this->start_generate_time = $this->microtime_float();
		  //kiem tra xem time request co bi slow qua ko

		  return $raw_response;
		}
		
		
		protected function saveLog($fileName, $arrayData){
	 		$dirname = dirname(__FILE__);
	 		$dirname	= 		str_replace('classes',"", $dirname);
	 		$dirname	= 		str_replace('classes',"", $dirname);
	 		$dirname .=		"../logs/";
	 		@file_put_contents($dirname . $fileName,json_encode($arrayData) . "\n", FILE_APPEND);
	 	}
	 	
	 	/**
		 * Ham lay moc thoi gian de do toc do xu ly
		 */
		function microtime_float(){
		   list($usec, $sec) = explode(" ", microtime());
		   return ((float)$usec + (float)$sec);
		}
    
}