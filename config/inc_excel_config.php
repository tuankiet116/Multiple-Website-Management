<?
$file_name		= dirname(__FILE__);
$file_name		= str_replace("includes", "classes", $file_name);
require_once($file_name . "/PHPExcel.php");
require_once($file_name . "/PHPExcel/IOFactory.php");
$cacheMethod 	= PHPExcel_CachedObjectStorageFactory::cache_to_memcache;
$cacheSettings = array( 'memcacheServer'  => '192.168.1.203',
                        'memcachePort'    => 11211,
                        'cacheTime'       => 600
                      );
$config_max_record		= 60000;//Số lượng bản nghi tối đa lấy ra
?>