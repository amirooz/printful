<?php

require 'vendor/autoload.php';
require 'CacheInterface.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class ShipRate
{
  private $cache;
  public function __construct(CacheInterface $cache)
  {
    $this->cache = $cache;
  }

  public function set(){
    $authorization = base64_encode('77qn9aax-qrrm-idki:lnh0-fm2nhmp0yca7');
    $client = new GuzzleHttp\Client([
      'verify' => false,
      'base_uri' => 'https://api.printful.com/',
      'headers' => [
        'Content-Type' => 'application/json; charset=utf-8',
        'Accept' => 'application/json',
        'Authorization' => 'Basic '.$authorization
      ]
    ]);

    $url = 'shipping/rates';
    $data=json_encode([
      'recipient'=> [
        'country_code' => 'US',
        'address1' => '11025 Westlake Dr',
        'city' => 'Charlotte',
        'state_code' => 'North Carolina',
        'zip' => 28273
      ],
      'items' => [
        [
        'quantity' => 2,
        'variant_id' => 7679
        ]
      ]
    ]);
    $response = $client->post($url, [
      'body' => $data
    ]
    );

   $shipMethod = $response->getBody()->getContents();
   $this->cache->set('shiprate',$shipMethod,300);
  }

  public function get()
  {
    echo $this->cache->get('shiprate');
  }

}
