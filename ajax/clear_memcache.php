<?
require_once("../classes/memcached_store.php");

$ms           = new memcached_store();
$ms->flush();
unset($ms);