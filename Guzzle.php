<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

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


// echo '<pre>' . var_export($response->getBody()->getContents(), true) . '</pre>';

$result = json_decode($response->getBody()->getContents(), true);

echo '<table>';

foreach($result as $values)
{
  if(is_array($values))
  {
    foreach($values as $value)
    {
      if(is_array($value))
      {
        foreach($value as $key => $val)
        {
          $shipOption = '<tr><td style="text-transform: capitalize">'. $key .'</td><td>'. $val .'</td></tr>';
          echo $shipOption;
        }
      }
    }
  }
}
echo '</table>';
// echo '<pre>';
// print_r($result);
// echo '</pre>';


// foreach ($decode as $key => $value) {
//   echo $value;
// }
