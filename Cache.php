<?php

require 'CacheInterface.php';
// use Printful\CacheInterface;

class Cache implements CacheInterface {

  // $memcache = new Memcache;
  // $memcache->connect('127.0.0.1', 11211) or die ("Unable to connect to Memcached");

  public function set(string $key, $value,int $duration)
  {
    // apc_store($key, $value, $duration);
    $memcache = new Memcache;
    $memcache->connect('127.0.0.1', 11211) or die ("Unable to connect to Memcached");
    $memcache->set($key, $value, false, 300);
  }

  public function get(string $key)
  {
    $memcache = new Memcache;
    $memcache->connect('127.0.0.1', 11211) or die ("Unable to connect to Memcached");
    $data = $memcache->get($key);
    return $data;
     // $data = apc_fetch($key);
  }
}

?>
