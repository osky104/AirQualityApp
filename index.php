<?php

require 'database.php';

$apiKey = "870dfb630a2c71f5bda65766d9f48bca"; // Quella che trovi nel tuo profilo
$lat = "45.4642"; // Latitudine di Milano
$lon = "9.1900";  // Longitudine di Milano

$url = "http://api.openweathermap.org/data/2.5/air_pollution?lat=$lat&lon=$lon&appid=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);

// Esempio: prendiamo il PM10
$pm10 = $data['list'][0]['components']['pm10'];

echo "Il livello di PM10 a Milano è: " . $pm10 . " μg/m3";
?>