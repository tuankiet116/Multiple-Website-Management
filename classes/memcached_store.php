<?php

if (!defined('MEMCACHED_SERVER')) define('MEMCACHED_SERVER', '127.0.0.1');
if (!defined('MEMCACHED_PORT')) define('MEMCACHED_PORT', 11211);

/**
 * Class memcached_store
 */
class memcached_store
{
	var $memcache;
	var $connect_successful = false;
	
	/**
	 * memcached_store constructor.
	 */
	function __construct()
	{
		
		/**
		 * Nếu MEMCACHED_SERVER là none thì return luôn
		 */
		if (MEMCACHED_SERVER == "none") {
			return;
		}
		
		if (!class_exists("Memcached")) {
			return;
		}
		
		$this->memcache = new Memcached;
		
		/**
		 * Bẻ ra nhiều server
		 */
		$array_memcached = explode(",", MEMCACHED_SERVER);
		
		/**
		 * Loop để add memcached server
		 */
		$link_connect   = false;
		foreach ($array_memcached as $m_key => $m_value) {
			$link_connect = @$this->memcache->addServer(trim($m_value), MEMCACHED_PORT);
		}
		
		/**
		 * Nếu kết nối thành công thì cho biến connect_successful là true
		 */
		if ($link_connect) {
			$this->connect_successful = true;
		}
	}
	
	/**
	 * @param $key
	 *
	 * @return mixed|null
	 */
	function get($key)
	{
		if ($this->connect_successful) return @$this->memcache->get($key);
		else return NULL;
	}
	
	/**
	 * set key, value, mặc định timeout là 3600s (1h)
	 * @param $key
	 * @param $value
	 * @param int $timeout
	 *
	 * @return bool|null
	 */
	function set($key, $value, $timeout = 3600)
	{
		if ($this->connect_successful) return @$this->memcache->set($key, $value, $timeout);
		else return NULL;
	}
	
	/**
	 * Xoa 1 key memcache
	 * @param $key
	 *
	 * @return bool
	 */
	function delete($key)
	{
		/**
		 * Bẻ ra nhiều server
		 */
		$array_memcached = explode(",", MEMCACHED_SERVER);
		
		/**
		 * Loop để add memcached server
		 */
		foreach ($array_memcached as $m_key => $m_value) {
			$memcache     = new Memcache;
			$link_connect = @$memcache->addServer(trim($m_value), MEMCACHED_PORT, false);
			if ($link_connect) {
				@$memcache->delete($key);
				@$memcache->close();
			}
			unset($memcache, $link_connect);
		}
		return true;
	}
	
	/**
	 * @return null
	 */
	function getStats()
	{
		if ($this->connect_successful) return $this->memcache->getStats();
		else return NULL;
	}
	
	/**
	 * @return null
	 */
	function flush()
	{
		if ($this->connect_successful) return $this->memcache->flush();
		else return NULL;
	}
	
	
}
?>