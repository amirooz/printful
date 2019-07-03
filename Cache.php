<?php

require 'CacheInterface.php';
// use Printful\CacheInterface;

class Cache implements CacheInterface {
  public function set(string $key, $value, $duration)
  {
    apc_store($key, $value, $duration);
  }

  public function get(string $key)
  {
       $data = apc_fetch($key);
       if($data)
       {
         return $data;
       }
  }
}

$cache = new Cache();
$cg = $cache->get('shiprate');
print_r($cg);
?>
