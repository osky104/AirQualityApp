<?php

require 'database.php';

$apiKey = "870dfb630a2c71f5bda65766d9f48bca"; 
$lat = "45.4642"; // Milan
$lon = "9.1900";  // Milan

$url = "http://api.openweathermap.org/data/2.5/air_pollution?lat=$lat&lon=$lon&appid=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);

//take data
$co = $data['list'][0]['components']['co'];
$no = $data['list'][0]['components']['no'];
$no2 = $data['list'][0]['components']['no2'];
$o3 = $data['list'][0]['components']['o3'];
$so2 = $data['list'][0]['components']['so2'];
$pm10 = $data['list'][0]['components']['pm10'];
$pm2_5 = $data['list'][0]['components']['pm2_5'];
$nh3 = $data['list'][0]['components']['nh3'];
$currentDate = $data['list'][0]['dt'];

//time is in Unix Timestamp and we need to convert it 
$currentDate = date('d/m/Y H:i', $currentDate); // Risultato: 12/02/2026 09:14 (circa)

echo "Il livello di PM10 a Milano è: " . $pm10 . " μg/m3 il giorno $currentDate";

?>